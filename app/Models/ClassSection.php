<?php

namespace App\Models;

use App\Traits\BelongsToSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassSection extends Model
{
    use BelongsToSchool;
    protected $fillable = [
        'school_id',
        'class_id',
        'section_id',
        'academic_year_id',
        'class_teacher_id',
    ];

    public function schoolClass() : BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function section() : BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function academicYear() : BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
