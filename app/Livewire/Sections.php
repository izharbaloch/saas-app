<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasCrudForm;
use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class Sections extends Component
{
    use WithPagination;
    use HasCrudForm;

    public $name = '';
    public $status = 1;
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
        Section::updateOrCreate(['id' => $this->sectionId], $data);
        $this->flashSuccess($this->sectionId ? 'Section updated successfully!' : 'Section created successfully!');

        $this->resetForm();
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        $this->fill($section->only('name', 'status'));
        $this->sectionId = $section->id;

        $this->showForm = true;
        $this->resetValidation();
    }

    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();

        $this->flashSuccess('Section deleted successfully!');
        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->reset(['name', 'status', 'sectionId', 'showForm']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.sections', [
            'sections' => Section::latest()->paginate(10),
        ]);
    }
}
