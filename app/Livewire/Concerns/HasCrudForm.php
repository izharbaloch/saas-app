<?php

namespace App\Livewire\Concerns;

trait HasCrudForm
{
    public bool $showForm = false;

    public function openForm(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    protected function flashSuccess(string $message): void
    {
        session()->flash('success', $message);
    }
}
