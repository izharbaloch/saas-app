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
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'b_form_no' => 'nullable|string|max:50',
            'religion' => 'nullable|in:muslim,christian,hindu,other',
            'blood_group' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'nationality' => 'nullable|string|max:100',
            'previous_school' => 'nullable|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
            'father_contact_numer' => 'required|string|max:30',
            'mother_name' => 'nullable|string|max:255',
            'mother_contact_numer' => 'nullable|string|max:30',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_relation' => 'nullable|string|max:100',
            'guardian_contact_numer' => 'nullable|string|max:30',
            'guardian_email' => 'nullable|email|max:255',
            'address' => 'required|string|max:2000',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'admission_date' => 'required|date',
            'class_section_id' => 'nullable|integer',
            'admission_type' => 'required|in:New Admission,Transfer,Re-Admission',
            'previous_class' => 'nullable|string|max:100',
            'transport_required' => 'nullable|boolean',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:30',
            'medical_conditions' => 'nullable|string|max:2000',

            // These formats match the file types allowed by the form.
            'b_form' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'birth_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'leaving_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'guardian_cnic' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'student_profile_photo' => 'nullable|image|max:5120',
            'other_documents' => 'nullable|array',
            'other_documents.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ];
    }

    /**
     * Generate a roll number based on the highest existing roll number
     * in the selected class/section, rather than using the global student ID.
     */
    public function generateRollNo(): void
    {
        $query = Student::query();

        if ($this->class_section_id) {
            $query->where('class_section_id', $this->class_section_id);
        }

        $lastNumber = $query->pluck('roll_no')
            ->map(function ($rollNo) {
                return preg_match('/^RN-(\d+)$/', (string) $rollNo, $matches)
                    ? (int) $matches[1]
                    : 0;
            })
            ->max() ?? 0;

        $this->roll_no = 'RN-' . str_pad((string) ($lastNumber + 1), 3, '0', STR_PAD_LEFT);
    }

    /**
     * Generate the next admission number from existing admission numbers.
     */
    public function generateAdmissionNo(): void
    {
        $lastNumber = Student::query()
            ->pluck('admission_no')
            ->map(function ($admissionNo) {
                return preg_match('/^ADM-(\d+)$/', (string) $admissionNo, $matches)
                    ? (int) $matches[1]
                    : 0;
            })
            ->max() ?? 0;

        $this->admission_no = 'ADM-' . str_pad((string) ($lastNumber + 1), 3, '0', STR_PAD_LEFT);
    }

    public function save(): void
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
            'previous_class' => $this->previous_class,
            'transport_required' => $this->transport_required,
            'emergency_contact_name' => $this->emergency_contact_name,
            'emergency_contact_number' => $this->emergency_contact_number,
            'medical_conditions' => $this->medical_conditions,
        ]);

        $this->storeAttachments($student);

        $this->flashSuccess('Student Created Successfully!');
        $this->resetForm();
        $this->showForm = false;
    }

    public function edit($id): void
    {
        $student = Student::with('attachments')->findOrFail($id);

        $this->fill($student->only(
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
        ));

        $this->studenAttachments = $student->attachments;
        $this->studentId = $student->id;
        $this->resetValidation();
        $this->showForm = true;
    }

    public function update(): void
    {
        $this->validate();

        $student = Student::with('attachments')->findOrFail($this->studentId);

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
            'previous_class' => $this->previous_class,
            'transport_required' => $this->transport_required,
            'emergency_contact_name' => $this->emergency_contact_name,
            'emergency_contact_number' => $this->emergency_contact_number,
            'medical_conditions' => $this->medical_conditions,
        ]);

        $this->storeAttachments($student, true);

        $this->flashSuccess('Student Updated Successfully!');
        $this->resetForm();
        $this->showForm = false;
    }

    /**
     * Save uploaded files. On update, replace the existing single-file category
     * only after the new file has been stored successfully.
     */
    private function storeAttachments(Student $student, bool $replaceExisting = false): void
    {
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

            if (!$path) {
                throw new \RuntimeException('The uploaded file could not be saved.');
            }

            if ($replaceExisting) {
                $oldAttachment = $student->attachments
                    ->firstWhere('category', $category);

                if ($oldAttachment) {
                    $oldPath = $oldAttachment->file_path;
                    $oldAttachment->delete();

                    if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
            }

            $student->attachments()->create([
                'category' => $category,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }

        foreach ($this->other_documents ?? [] as $file) {
            if (!$file) {
                continue;
            }

            $path = $file->store('attachments/students', 'public');

            if (!$path) {
                throw new \RuntimeException('The uploaded file could not be saved.');
            }

            $student->attachments()->create([
                'category' => 'other_documents',
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }
    }

    public function destroy($id): void
    {
        $student = Student::with('attachments')->findOrFail($id);

        foreach ($student->attachments as $attachment) {
            $path = $attachment->file_path;
            $attachment->delete();

            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $student->delete();

        $this->flashSuccess('Student Deleted Successfully!');
        $this->resetValidation();
    }

    public function resetForm(): void
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
            'studentId',
            'studenAttachments',
        ]);

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.students', [
            'classSections' => ClassSection::with('schoolClass', 'section', 'academicYear')->get(),
            'students' => Student::with([
                'classSection.schoolClass',
                'classSection.section',
                'attachments',
            ])->paginate(10),
        ]);
    }
}
