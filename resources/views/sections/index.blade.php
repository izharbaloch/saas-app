@extends('layouts.app')

@section('title', 'Sections')
@section('page-title', 'Sections')

@section('content')

    <div class="mx-auto max-w-6xl space-y-8">

        {{-- Page heading --}}
        <div class="mb-2">
            <h2 class="font-jakarta text-xl font-bold text-slate-900">Sections</h2>
            <p class="mt-1 text-sm text-slate-500">Create and manage sections (e.g. Boys, Girls).</p>
        </div>

        <livewire:sections />

    </div>

@endsection
