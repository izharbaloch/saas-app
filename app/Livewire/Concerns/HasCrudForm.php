<?php

namespace App\Livewire\Concerns;

use App\Models\Student;

trait HasCrudForm
{
    public bool $showForm = false;

    public $roll_no = '';

    public function openForm(): void
    {
        // $this->resetForm();
        $this->showForm = true;

        $this->generateRollNo();
    }

    public function generateRollNo()
    {
        $lastRollNo = Student::whereNotNull('roll_no')->orderByDesc('id')->value('id');

        $number = $lastRollNo ? $lastRollNo + 1 : 1;

        $this->roll_no = 'RN-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    protected function flashSuccess(string $message): void
    {
        session()->flash('success', $message);
    }
}
