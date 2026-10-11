@extends('layouts.app')

@section('title', 'Assign Sections')
@section('page-title', 'Assign Sections')

@section('content')

    <div class="mx-auto max-w-6xl space-y-8">

        {{-- Page heading --}}
        <div class="mb-2">
            <h2 class="font-jakarta text-xl font-bold text-slate-900">Assign Sections</h2>
            <p class="mt-1 text-sm text-slate-500">Assign sections to classes for an academic year.</p>
        </div>

        <livewire:class-sections />

    </div>

@endsection
