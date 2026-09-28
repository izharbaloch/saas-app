<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasCrudForm;
use App\Models\ClassSection;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Students extends Component
{
    use HasCrudForm, WithFileUploads, WithPagination;

    public string $roll_no = '';
    public string $admission_no = '';
    public string $name = '';
    public string $father_name = '';
    public string $gender = '';
    public string $dob = '';
    public $b_form_no = null;
    public $religion = null;
    public $blood_group = null;
    public $nationality = null;
    public $previous_school = null;
    public $father_occupation = null;
    public string $father_contact_numer = '';
    public $mother_name = null;
    public $mother_contact_numer = null;
    public $guardian_name = null;
    public $guardian_relation = null;
    public $guardian_contact_numer = null;
    public $guardian_email = null;
    public string $address = '';
    public $city = null;
    public $postal_code = null;
    public string $admission_date = '';
    public $class_section_id = null;
    public string $admission_type = '';
    public $previous_class = null;
    public $transport_required = null;
    public $emergency_contact_name = null;
    public $emergency_contact_number = null;
    public $medical_conditions = null;

    // Attachments
    public $b_form;
    public $birth_certificate;
    public $leaving_certificate;
    public $guardian_cnic;
    public $student_profile_photo;
    public $other_documents = [];

    public $studentId = null;
    public $studenAttachments = [];
    protected function rules(): array
    {
        return [
            'name' => 'required',
            'father_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'father_contact_numer' => 'required',
            'address' => 'required',
            'admission_date' => 'required',
            'admission_type' => 'required',
            'b_form' => 'nullable|file|max:5120',
            'birth_certificate' => 'nullable|file|max:5120',
            'leaving_certificate' => 'nullable|file|max:5120',
            'guardian_cnic' => 'nullable|file|max:5120',
            'other_documents.*' => 'nullable|file|max:5120',
        ];
    }

    public function generateRollNo()
    {
        $lastRollNo = Student::where('class_section_id', $this->class_section_id)->orderByDesc('id')->value('id');

        $number = $lastRollNo ? $lastRollNo + 1 : 1;

        $this->roll_no = 'RN-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    public function generateAdmissionNo()
    {
        $lastAdmissionNo = Student::orderByDesc('id')->value('id');

        $number = $lastAdmissionNo ? $lastAdmissionNo + 1 : 1;

        $this->admission_no = 'ADM-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    public function save()
    {
        $this->validate();

        $this->generateRollNo();
        $this->generateAdmissionNo();

        $student = Student::create([
            'roll_no' => $this->roll_no,
            'admission_no' => $this->admission_no,
            'name' => $this->name,
            'father_name' => $this->father_name,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'b_form_no' => $this->b_form_no,
            'religion' => $this->religion,
            'blood_group' => $this->blood_group,
            'nationality' => $this->nationality,
            'previous_school' => $this->previous_school,
            'father_occupation' => $this->father_occupation,
            'father_contact_numer' => $this->father_contact_numer,
            'mother_name' => $this->mother_name,
            'mother_contact_numer' => $this->mother_contact_numer,
            'guardian_name' => $this->guardian_name,
            'guardian_relation' => $this->guardian_relation,
            'guardian_contact_numer' => $this->guardian_contact_numer,
            'guardian_email' => $this->guardian_email,
            'address' => $this->address,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'admission_date' => $this->admission_date,
            'class_section_id' => $this->class_section_id,
            'admission_type' => $this->admission_type,
            'transport_required' => $this->transport_required,
            'emergency_contact_name' => $this->emergency_contact_name,
            'emergency_contact_number' => $this->emergency_contact_number,
            'medical_conditions' => $this->medical_conditions,
        ]);

        $attachments = [
            'b_form' => $this->b_form,
            'birth_certificate' => $this->birth_certificate,
            'leaving_certificate' => $this->leaving_certificate,
            'guardian_cnic' => $this->guardian_cnic,
            'student_profile_photo' => $this->student_profile_photo,
        ];

        foreach ($attachments as $category => $file) {

            if (!$file) {
                continue;
            }
            $path = $file->store('attachments/students', 'public');

            $student->attachments()->create([
                'category' => $category,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }

        if ($this->other_documents) {

            foreach ($this->other_documents as $file) {

                if (!$file) {
                    continue;
                }

                $path = $file->store('attachments/students', 'public');

                $student->attachments()->create([
                    'category' => 'other_documents',
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        $this->flashSuccess('Student Created Successfully!');

        $this->showForm = false;
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $data = $student->only(
            'roll_no',
            'admission_no',
            'name',
            'father_name',
            'gender',
            'dob',
            'b_form_no',
            'religion',
            'blood_group',
            'nationality',
            'previous_school',
            'father_occupation',
            'father_contact_numer',
            'mother_name',
            'mother_contact_numer',
            'guardian_name',
            'guardian_relation',
            'guardian_contact_numer',
            'guardian_email',
            'address',
            'city',
            'postal_code',
            'admission_date',
            'class_section_id',
            'admission_type',
            'previous_class',
            'transport_required',
            'emergency_contact_name',
            'emergency_contact_number',
            'medical_conditions',
        );

        $this->fill($data);

        $this->studenAttachments = $student->attachments;
        $this->studentId = $student->id;
        $this->showForm = true;
    }

    public function update()
    {
        $student = Student::findOrFail($this->studentId);

        $student->update([
            'name' => $this->name,
            'father_name' => $this->father_name,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'b_form_no' => $this->b_form_no,
            'religion' => $this->religion,
            'blood_group' => $this->blood_group,
            'nationality' => $this->nationality,
            'previous_school' => $this->previous_school,
            'father_occupation' => $this->father_occupation,
            'father_contact_numer' => $this->father_contact_numer,
            'mother_name' => $this->mother_name,
            'mother_contact_numer' => $this->mother_contact_numer,
            'guardian_name' => $this->guardian_name,
            'guardian_relation' => $this->guardian_relation,
            'guardian_contact_numer' => $this->guardian_contact_numer,
            'guardian_email' => $this->guardian_email,
            'address' => $this->address,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'admission_date' => $this->admission_date,
            'class_section_id' => $this->class_section_id,
            'admission_type' => $this->admission_type,
            'transport_required' => $this->transport_required,
            'emergency_contact_name' => $this->emergency_contact_name,
            'emergency_contact_number' => $this->emergency_contact_number,
            'medical_conditions' => $this->medical_conditions,
        ]);

        $attachments = [
            'b_form' => $this->b_form,
            'birth_certificate' => $this->birth_certificate,
            'leaving_certificate' => $this->leaving_certificate,
            'guardian_cnic' => $this->guardian_cnic,
            'student_profile_photo' => $this->student_profile_photo,
        ];

        foreach ($attachments as $category => $file) {

            if (!$file) {
                continue;
            }

            $oldFile = $student->attachments->where('category', $category)->first();
            if ($oldFile) {
                if ($oldFile->file_path && Storage::disk('public')->exists($oldFile->file_path)) {
                    Storage::disk('public')->delete($oldFile->file_path);
                }
                $oldFile->delete();
            }

            $path = $file->store('attachments/students', 'public');

            $student->attachments()->create([
                'category' => $category,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }

        if ($this->other_documents) {

            foreach ($this->other_documents as $file) {

                if (!$file) {
                    continue;
                }

                $path = $file->store('attachments/students', 'public');

                $student->attachments()->create([
                    'category' => 'other_documents',
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        $this->flashSuccess('Student Update Successfully!');
        $this->showForm = false;
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        foreach ($student->attachments as $attachment) {
            if ($attachment->file_path && Storage::disk('public')->exists($attachment->file_path)) {
                Storage::disk('public')->delete($attachment->file_path);
            }

            $attachment->delete();
        }

        $student->delete();

        $this->flashSuccess('Student Delete Successfully!');

        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->reset([
            'roll_no',
            'admission_no',
            'name',
            'father_name',
            'gender',
            'dob',
            'b_form_no',
            'religion',
            'blood_group',
            'nationality',
            'previous_school',
            'father_occupation',
            'father_contact_numer',
            'mother_name',
            'mother_contact_numer',
            'guardian_name',
            'guardian_relation',
            'guardian_contact_numer',
            'guardian_email',
            'address',
            'city',
            'postal_code',
            'admission_date',
            'class_section_id',
            'admission_type',
            'previous_class',
            'transport_required',
            'emergency_contact_name',
            'emergency_contact_number',
            'medical_conditions',
            'b_form',
            'birth_certificate',
            'leaving_certificate',
            'guardian_cnic',
            'student_profile_photo',
            'other_documents',
        ]);
    }

    public function render()
    {
        return view('livewire.students', [
            'classSections' => ClassSection::with('schoolClass', 'section', 'academicYear')->get(),
            'students' => Student::with(['classSection', 'attachments'])->paginate(10),
        ]);
    }
}
