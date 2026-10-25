<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasCrudForm;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;

class Subjects extends Component
{
    use WithPagination;
    use HasCrudForm;

    public $name = '';
    public $code = '';
    public $type = 'Core';
    public $status = 1;
    public $subjectId = null;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

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
        $this->flashSuccess($this->subjectId ? 'Subject updated successfully!' : 'Subject created successfully!');

        $this->resetForm();
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $this->fill($subject->only('name', 'code', 'type', 'status'));
        $this->subjectId = $subject->id;

        $this->showForm = true;
        $this->resetValidation();
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        $this->flashSuccess('Subject deleted successfully!');
        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->reset(['name', 'code', 'type', 'status', 'subjectId', 'showForm']);
        $this->resetValidation();
    }

    public function render()
    {
        $subjects = Subject::query()->select('id', 'name', 'code', 'type', 'status')->when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->latest()->paginate(10);
        return view('livewire.subjects', [
            'subjects' => $subjects,
        ]);
    }
}
