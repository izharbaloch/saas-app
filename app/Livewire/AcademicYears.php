<?php

namespace App\Livewire;

use App\Models\AcademicYear;
use Livewire\Component;
use Livewire\WithPagination;

class AcademicYears extends Component
{
    use WithPagination;

    public $showForm = false;
    public $academicYearId = null;

    public $name = '';
    public $start_date = '';
    public $end_date = '';
    public $is_current = 0;
    public $status = 1;

    public function rules(): array
    {
        return [
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'is_current' => 'required',
            'status' => 'required',
        ];
    }

    public function save()
    {
        $data = $this->validate();
        AcademicYear::updateOrCreate(['id' => $this->academicYearId], $data);
        session()->flash('success', $this->academicYearId ? 'Academic Year updated successfully!' : 'Academic Year created successfully!');

        $this->resetForm();
    }

    public function edit($id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        $this->academicYearId = $academicYear->id;

        $this->fill($academicYear->only(['name', 'start_date', 'end_date', 'is_current', 'status']));
        $this->showForm = true;
        $this->resetValidation();
    }

    public function destroy($id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        $academicYear->delete();
        session()->flash('success', 'Academic Year delete successfully!');
    }

    public function openForm()
    {
        $this->showForm = true;
        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->reset(['name', 'start_date', 'end_date', 'is_current', 'status', 'showForm', 'academicYearId']);
        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.academic-years', [
            'academicYears' => AcademicYear::latest()->paginate(10),
        ]);
    }
}
