<?php

namespace App\Livewire;

use App\Models\SchoolClass;
use Livewire\Component;

class SchoolClasses extends Component
{
    public string $name = '';
    public string $grade = '';
    public $status = 1;

    public $showForm = false;
    public $classId  = null;

    public function save()
    {
        $validate = $this->validate([
            'name' => 'required',
            'grade' => 'required',
        ]);

        // dd($validate);

        SchoolClass::create([
            'name' => $this->name,
            'grade' => $this->grade,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Class Created Successfully!');

        $this->reset([
            'name',
            'grade',
            'status'
        ]);

        $this->showForm = false;
    }

    public function edit($id)
    {
        $class = SchoolClass::findOrFail($id);
        $this->classId = $class->id;
        $this->name = $class->name;
        $this->grade = $class->grade;
        $this->status = $class->status;
        $this->showForm = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'grade' => 'required',
        ]);

        $class = SchoolClass::findOrFail($this->classId);

        $class->update([
            'name' => $this->name,
            'grade' => $this->grade,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Class Update Successfully!');

        $this->reset([
            'name',
            'grade',
            'status'
        ]);

        $this->showForm = false;
        $this->classId = null;
    }

    public function openForm()
    {
        $this->showForm = true;
    }
    public function render()
    {
        $classes = SchoolClass::get();
        // dd($classes);
        return view('livewire.school-classes', compact('classes'));
    }
}
