<?php

namespace App\Livewire;

use App\Models\AcademicYear;
use App\Models\ClassSection;
use App\Models\SchoolClass;
use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class ClassSections extends Component
{
    use WithPagination;

    public $class_id = null;
    public $section_ids = [];
    public $academic_year_ids = [];
    public $teacher_id = null;

    public $showForm = false;
    public $assignRecorId = null;

    protected function rules()
    {
        return [
            'class_id' => 'required|exists:school_classes,id',
            'section_ids' => 'required|array|min:1',
            'section_ids.*' => 'exists:sections,id',

            'academic_year_ids' => 'required|array|min:1',
            'academic_year_ids.*' => 'exists:academic_years,id',

            // 'teacher_ids' => 'required|array|min:1',
            // 'teacher_ids.*' => 'exists:users,id',
        ];
    }

    public function save()
    {
        // dd("yes her save");

        $data = $this->validate();

        foreach ($this->section_ids as $sectionId) {
            foreach ($this->academic_year_ids as $academicYearId) {
                ClassSection::create([
                    'class_id' => $this->class_id,
                    'section_id' => $sectionId,
                    'academic_year_id' => $academicYearId,
                ]);
            }
        }

        session()->flash('success', 'Record Save successfully!');

        $this->resetForm();
        $this->showForm = false;
    }

    public function edit($id)
    {
        $record = ClassSection::findOrFail($id);

        $records = ClassSection::where('class_id', $record->class_id)->get();

        $this->assignRecorId = $record->class_id;

        $this->class_id = $record->class_id;

        $this->section_ids = $records->pluck('section_id')->unique()->toArray();

        $this->academic_year_ids = $records->pluck('academic_year_id')->unique()->toArray();

        $this->teacher_id = $record->teacher_id;

        $this->showForm = true;
    }

    public function update()
    {
        // dd("yes her update");
        $classSetion = ClassSection::where('class_id', $this->assignRecorId)->delete();
        $data = $this->validate();

        foreach ($this->section_ids as $sectionId) {
            foreach ($this->academic_year_ids as $academicYearId) {
                ClassSection::create([
                    'class_id' => $this->class_id,
                    'section_id' => $sectionId,
                    'academic_year_id' => $academicYearId,
                ]);
            }
        }

        session()->flash('success', 'Record update successfully!');

        $this->resetForm();
        $this->showForm = false;
    }

    public function openForm()
    {
        $this->showForm = true;
    }

    public function resetForm()
    {
        $this->reset(['class_id', 'section_ids', 'academic_year_ids', 'teacher_id']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.class-sections', [
            'classes' => SchoolClass::all(),
            'sections' => Section::all(),
            'academicYears' => AcademicYear::all(),
            'classSections' => ClassSection::with(['schoolClass', 'section'])->get()->groupBy('class_id'),
        ]);
    }
}
