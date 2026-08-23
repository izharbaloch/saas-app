<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasCrudForm;
use App\Models\ClassSection;
use App\Models\ClassSubject;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ClassSubjects extends Component
{
    use HasCrudForm;

    public $class_section_id = '';
    public $subject_ids = [];
    public $teacher_id = '';
    public $assignRecordId = null;

    public function rules(): array
    {
        return [
            'class_section_id' => 'required',
            'subject_ids' => 'required|array',
            'teacher_id' => 'nullable'
        ];
    }

    public function save()
    {
        $data = $this->validate();
        DB::transaction(function () {
            foreach ($this->subject_ids as $subjectId) {
                ClassSubject::create([
                    'class_section_id' => $this->class_section_id,
                    'subject_id' => $subjectId
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
            $records = ClassSubject::where('class_section_id', $this->assignRecordId)->delete();

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
