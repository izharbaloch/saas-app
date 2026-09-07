<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use BelongsToTenant;
    protected $fillable = [
        'tenant_id',
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
    ];

    public function classSection() : BelongsTo
    {
        return $this->belongsTo(ClassSection::class, 'class_section_id');
    }
}
