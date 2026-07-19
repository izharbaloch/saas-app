<?php

namespace App\Livewire;

use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;

class Subjects extends Component
{
    use WithPagination;

    public $name = '';
    public $code = '';
    public $type = 'Core';
    public $status = 1;
    public $showForm = false;
    public $subjectId = null;

    public function rules(): array
    {
        return [
            'name'   => 'required|string|max:255',
            'code'   => 'nullable|string|max:50',
            'type'   => 'required|in:Core,Optional',
            'status' => 'required|boolean',
        ];
    }

    public function save()
    {
        $data = $this->validate();
        Subject::updateOrCreate(['id' => $this->subjectId], $data);
        session()->flash('success', $this->subjectId ? 'Subject updated successfully!' : 'Subject created successfully!');

        $this->resetForm();
    }

    public function edit($id)
    {
        $subject = Subject::find($id);
        $this->fill($subject->only('name', 'code', 'type', 'status'));
        $this->subjectId = $subject->id;

        $this->showForm = true;
        $this->resetValidation();
    }

    public function openForm()
    {
        $this->showForm = true;
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        session()->flash('success', 'Subject deleted successfully!');
        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->reset(['name', 'code', 'type', 'status', 'subjectId', 'showForm']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.subjects', [
            'subjects' => Subject::latest()->paginate(10),
        ]);
    }
}
