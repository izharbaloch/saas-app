<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasCrudForm;
use App\Models\AcademicYear;
use App\Models\ClassSection;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ClassSections extends Component
{
    use WithPagination;
    use HasCrudForm;

    public $class_id = null;
    public $section_ids = [];
    public $academic_year_ids = [];

    public $assignRecordId = null;

    protected function rules(): array
    {
        return [
            'class_id' => ['required', Rule::exists('school_classes', 'id')],
            'section_ids' => 'required|array|min:1',
            'section_ids.*' => Rule::exists('sections', 'id'),

            'academic_year_ids' => 'required|array|min:1',
            'academic_year_ids.*' => Rule::exists('academic_years', 'id'),
        ];
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            foreach ($this->section_ids as $sectionId) {
                foreach ($this->academic_year_ids as $academicYearId) {
                    ClassSection::firstOrCreate([
                        'class_id' => $this->class_id,
                        'section_id' => $sectionId,
                        'academic_year_id' => $academicYearId,
                    ]);
                }
            }
        });

        $this->flashSuccess('Record saved successfully!');

        $this->resetForm();
        $this->showForm = false;
    }

    public function edit($id)
    {
        $record = ClassSection::findOrFail($id);

        $records = ClassSection::where('class_id', $record->class_id)->get();

        $this->assignRecordId = $record->class_id;
        $this->class_id = $record->class_id;
        $this->section_ids = $records->pluck('section_id')->unique()->toArray();
        $this->academic_year_ids = $records->pluck('academic_year_id')->unique()->toArray();

        $this->showForm = true;
    }

    public function update()
    {
        $this->validate();

        DB::transaction(function () {
            ClassSection::where('class_id', $this->assignRecordId)->delete();

            foreach ($this->section_ids as $sectionId) {
                foreach ($this->academic_year_ids as $academicYearId) {
                    ClassSection::create([
                        'class_id' => $this->class_id,
                        'section_id' => $sectionId,
                        'academic_year_id' => $academicYearId,
                    ]);
                }
            }
        });

        $this->flashSuccess('Record updated successfully!');

        $this->resetForm();
        $this->showForm = false;
    }

    public function destroy($id)
    {
        $record = ClassSection::findOrFail($id);

        ClassSection::where('class_id', $record->class_id)->delete();

        $this->flashSuccess('Assignment deleted successfully!');
    }

    public function resetForm()
    {
        $this->reset(['class_id', 'section_ids', 'academic_year_ids', 'assignRecordId']);
        $this->resetValidation();
    }

    public function render()
    {
        $pagedClasses = ClassSection::select('class_id')->groupBy('class_id')->orderBy('class_id')->paginate(10);
        $classSections = ClassSection::select('id', 'class_id', 'section_id', 'academic_year_id')
            ->with(['schoolClass:id,name', 'section:id,name', 'academicYear:id,name'])
            ->whereIn('class_id', $pagedClasses->pluck('class_id'))
            ->orderBy('class_id')->orderBy('id')
            ->get()->groupBy('class_id');

        return view('livewire.class-sections', [
            'classes' => SchoolClass::select('id', 'name', 'grade')->get(),
            'sections' => Section::select('id', 'name')->get(),
            'academicYears' => AcademicYear::select('id', 'name')->get(),
            'classSections' => $classSections,
            'pagedClasses' => $pagedClasses,
        ]);
    }
}
