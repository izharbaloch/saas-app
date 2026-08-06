<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasCrudForm;
use App\Models\SchoolClass;
use Livewire\Component;
use Livewire\WithPagination;

class SchoolClasses extends Component
{
    use WithPagination;
    use HasCrudForm;

    public string $name = '';
    public string $grade = '';
    public bool $status = true;

    public ?int $classId = null;

    protected function rules(): array
    {
        return [
            'name'   => 'required|string|max:255',
            'grade'  => 'required|string|max:255',
            'status' => 'required|boolean',
        ];
    }

    public function save()
    {
        $data = $this->validate();

        SchoolClass::updateOrCreate(['id' => $this->classId], $data);

        $this->flashSuccess($this->classId ? 'Class updated successfully!' : 'Class created successfully!');

        $this->resetForm();
    }

    public function edit(int $id)
    {
        $class = SchoolClass::findOrFail($id);

        $this->fill($class->only('name', 'grade', 'status'));
        $this->classId = $class->id;
        $this->showForm = true;
        $this->resetValidation();
    }

    public function destroy($id)
    {
        $class = SchoolClass::findOrFail($id);
        $class->delete();

        $this->flashSuccess('Class deleted successfully!');
        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->reset(['name', 'grade', 'status', 'classId', 'showForm']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.school-classes', [
            'classes' => SchoolClass::latest()->paginate(10),
        ]);
    }
}
