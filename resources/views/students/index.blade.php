@extends('layouts.app')

@section('title', 'Students')
@section('page-title', 'Students')

@section('content')

    <div class="mx-auto max-w-6xl space-y-8">

        {{-- Page heading --}}
        <div class="mb-2">
            <h2 class="font-jakarta text-xl font-bold text-slate-900">Students</h2>
            <p class="mt-1 text-sm text-slate-500">Add a new student and view the list of enrolled students.</p>
        </div>

        <livewire:students />

    </div>

@endsection
