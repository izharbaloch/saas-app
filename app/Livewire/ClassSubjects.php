<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasCrudForm;
use App\Models\ClassSection;
use App\Models\ClassSubject;
use App\Models\Subject;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ClassSubjects extends Component
{
    use HasCrudForm;

    public $class_section_id = '';
    public $subject_ids = [];
    public $assignRecordId = null;

    public function rules(): array
    {
        $tenantId = Tenant::current()?->id;

        return [
            'class_section_id' => ['required', Rule::exists('class_sections', 'id')->where('tenant_id', $tenantId)],
            'subject_ids' => 'required|array|min:1',
            'subject_ids.*' => Rule::exists('subjects', 'id')->where('tenant_id', $tenantId),
        ];
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            foreach ($this->subject_ids as $subjectId) {
                ClassSubject::firstOrCreate([
                    'class_section_id' => $this->class_section_id,
                    'subject_id' => $subjectId,
                ]);
            }
        });
        $this->flashSuccess('Save Record Successfully!');
        $this->resetForm();
        $this->showForm = false;
    }

    public function edit($id)
    {
        $record = ClassSubject::findOrFail($id);

        $records = ClassSubject::where('class_section_id', $record->class_section_id)->get();
        $this->assignRecordId = $record->class_section_id;
        $this->class_section_id = $record->class_section_id;
        $this->subject_ids = $records->pluck('subject_id')->unique()->toArray();

        $this->showForm = true;
    }

    public function update()
    {
        $this->validate();
        DB::transaction(function () {
            ClassSubject::where('class_section_id', $this->assignRecordId)->delete();

            foreach ($this->subject_ids as $subjectId) {
                ClassSubject::create([
                    'class_section_id' => $this->class_section_id,
                    'subject_id'       => $subjectId,
                ]);
            }

        });

        $this->flashSuccess('Update Record Successfully!');
        $this->resetForm();
        $this->showForm = false;
    }

    public function destroy($id)
    {
        $classSubject = ClassSubject::findOrFail($id);
        ClassSubject::where('class_section_id', $classSubject->class_section_id)->delete();
        $this->flashSuccess('Assignment deleted successfully!');
    }

    public function resetForm()
    {
        $this->reset(['class_section_id', 'subject_ids', 'assignRecordId']);
    }
    public function render()
    {
        return view('livewire.class-subjects', [
            'classSections' => ClassSection::with(['schoolClass', 'section'])->get(),
            'subjects' => Subject::all(),
            'classSubjects' => ClassSubject::with(['subject', 'classSection'])->get()->groupBy('class_section_id'),
        ]);
    }
}
