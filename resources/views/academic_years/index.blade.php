@extends('layouts.app')

@section('title', 'Academic Years')
@section('page-title', 'Academic Years')

@section('content')

    <div class="mx-auto max-w-6xl space-y-8">

        {{-- Page heading --}}
        <div class="mb-2">
            <h2 class="font-jakarta text-xl font-bold text-slate-900">Academic Years</h2>
            <p class="mt-1 text-sm text-slate-500">Create and manage academic years.</p>
        </div>

        <livewire:academic-years />

    </div>

@endsection
