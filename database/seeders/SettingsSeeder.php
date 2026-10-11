<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\ClassSection;
use App\Models\ClassSubject;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $year = AcademicYear::firstOrCreate(
            ['name' => '2025-2026'],
            ['start_date' => '2025-04-01', 'end_date' => '2026-03-31', 'is_current' => 1, 'status' => 1]
        );

        $classes = [];
        foreach (range(1, 10) as $n) {
            $classes[] = SchoolClass::firstOrCreate(
                ['name' => "Class $n"],
                ['grade' => (string) $n, 'status' => 1]
            );
        }

        $sections = [];
        foreach (['Boys', 'Girls'] as $name) {
            $sections[] = Section::firstOrCreate(['name' => $name], ['status' => 1]);
        }

        $subjects = [];
        $list = [
            ['English', 'ENG', 'Core'],
            ['Urdu', 'URD', 'Core'],
            ['Mathematics', 'MATH', 'Core'],
            ['Science', 'SCI', 'Core'],
            ['Islamiat', 'ISL', 'Core'],
            ['Computer', 'COMP', 'Optional'],
        ];
        foreach ($list as [$name, $code, $type]) {
            $subjects[] = Subject::firstOrCreate(
                ['name' => $name],
                ['code' => $code, 'type' => $type, 'status' => 1]
            );
        }

        foreach ($classes as $class) {
            foreach ($sections as $section) {
                $cs = ClassSection::firstOrCreate([
                    'class_id' => $class->id,
                    'section_id' => $section->id,
                    'academic_year_id' => $year->id,
                ]);

                foreach ($subjects as $subject) {
                    ClassSubject::firstOrCreate([
                        'class_section_id' => $cs->id,
                        'subject_id' => $subject->id,
                    ]);
                }
            }
        }
    }
}
