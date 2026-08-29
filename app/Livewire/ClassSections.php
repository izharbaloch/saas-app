<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasCrudForm;
use App\Models\AcademicYear;
use App\Models\ClassSection;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ClassSections extends Component
{
    use HasCrudForm;

    public $class_id = null;
    public $section_ids = [];
    public $academic_year_ids = [];

    public $assignRecordId = null;

    protected function rules(): array
    {
        $tenantId = Tenant::current()?->id;

        return [
            'class_id' => ['required', Rule::exists('school_classes', 'id')->where('tenant_id', $tenantId)],
            'section_ids' => 'required|array|min:1',
            'section_ids.*' => Rule::exists('sections', 'id')->where('tenant_id', $tenantId),

            'academic_year_ids' => 'required|array|min:1',
            'academic_year_ids.*' => Rule::exists('academic_years', 'id')->where('tenant_id', $tenantId),
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
        return view('livewire.class-sections', [
            'classes' => SchoolClass::all(),
            'sections' => Section::all(),
            'academicYears' => AcademicYear::all(),
            'classSections' => ClassSection::with(['schoolClass', 'section'])->get()->groupBy('class_id'),
        ]);
    }
}
