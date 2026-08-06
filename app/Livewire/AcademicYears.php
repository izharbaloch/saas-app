<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasCrudForm;
use App\Models\AcademicYear;
use Livewire\Component;
use Livewire\WithPagination;

class AcademicYears extends Component
{
    use WithPagination;
    use HasCrudForm;

    public $academicYearId = null;

    public $name = '';
    public $start_date = '';
    public $end_date = '';
    public $is_current = 0;
    public $status = 1;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_current' => 'required|boolean',
            'status' => 'required|boolean',
        ];
    }

    public function save()
    {
        $data = $this->validate();
        AcademicYear::updateOrCreate(['id' => $this->academicYearId], $data);
        $this->flashSuccess($this->academicYearId ? 'Academic Year updated successfully!' : 'Academic Year created successfully!');

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
        $this->flashSuccess('Academic Year deleted successfully!');
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
