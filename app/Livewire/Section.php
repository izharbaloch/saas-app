<?php

namespace App\Livewire;

use App\Models\Section as ModelsSection;
use Livewire\Component;
use Livewire\WithPagination;

class Section extends Component
{
    use WithPagination;
    public $name = '';
    public $status = 1;
    public $showForm = false;
    public $sectionId = null;

    public function rules(): array
    {
        return [
            'name'   => 'required|string|max:255',
            'status' => 'required|boolean',
        ];
    }

    public function save()
    {
        $data = $this->validate();
        ModelsSection::updateOrCreate(['id' => $this->sectionId], $data);
        session()->flash('success', $this->sectionId ? 'Section Update successfully!' : 'Section created successfully!');

        $this->resetForm();
    }

    public function edit($id)
    {
        $section = ModelsSection::find($id);
        $this->fill($section->only('name', 'status'));
        $this->sectionId = $section->id;

        $this->showForm = true;
        $this->resetValidation();
    }

    public function openForm()
    {
        $this->showForm = true;
    }


    public function destroy($id)
    {
        $section = ModelsSection::findOrFail($id);
        $section->delete();

        session()->flash('success', 'Section Delete successfully!');
        $this->resetValidation();

    }

    public function resetForm()
    {
        $this->reset(['name', 'status', 'sectionId', 'showForm']);
        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.section', [
            'sections' => ModelsSection::currentSchool()->latest()->paginate(10),
        ]);
    }
}
