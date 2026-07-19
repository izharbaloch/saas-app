@extends('layouts.app')

@section('title', 'Create Academic Year')
@section('page-title', 'Create Academic Year')

@section('topbar-actions')
    <a href="{{ route('classes.index') }}"
        class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
        Back to Academic Years
    </a>
@endsection

@section('content')

    <div class="mx-auto max-w-3xl">

        {{-- Page heading --}}
        <div class="mb-6">
            <h2 class="font-jakarta text-xl font-bold text-slate-900">New Academic Years</h2>
            <p class="mt-1 text-sm text-slate-500">Fill in the details below to create a new Academic Years.</p>
        </div>


        <livewire:academic-years />

    </div>

@endsection
