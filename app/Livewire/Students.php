<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasCrudForm;
use App\Models\ClassSection;
use App\Models\Student;
use Livewire\Component;

class Students extends Component
{
    use HasCrudForm;

    // public string $roll_no = '';
    public string $admission_no = '';
    public string $name = '';
    public string $father_name = '';
    public string $gender = '';
    public string $dob = '';
    public string $b_form_no = '';
    public string $religion = '';
    public string $blood_group = '';
    public string $nationality = '';
    public string $previous_school = '';
    public string $father_occupation = '';
    public string $father_contact_numer = '';
    public string $mother_name = '';
    public string $mother_contact_numer = '';
    public string $guardian_name = '';
    public string $guardian_relation = '';
    public string $guardian_contact_numer = '';
    public string $guardian_email = '';
    public string $address = '';
    public string $city = '';
    public string $postal_code = '';
    public string $admission_date = '';
    public string $class_section_id = '';
    public string $admission_type = '';
    public string $previous_class = '';
    public string $transport_required = '';
    public string $emergency_contact_name = '';
    public string $emergency_contact_number = '';
    public string $medical_conditions = '';

    protected function rules(): array
    {
        return [
            'name' => 'required',
            'admission_no' => 'required',
            'father_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'father_contact_numer' => 'required',
            'address' => 'required',
            'admission_date' => 'required',
            'admission_type' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        Student::create([
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

        $this->flashSuccess('Student Created Successfully!');

        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.students', [
            'classSections' => ClassSection::with('schoolClass', 'section', 'academicYear')->get(),
            'students' => Student::with(['classSection'])->get(),
        ]);
    }
}
