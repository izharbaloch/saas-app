@extends('layouts.app')

@section('title', 'Classes')
@section('page-title', 'Classes')

@section('content')

    <div class="mx-auto max-w-6xl space-y-8">

        {{-- Page heading --}}
        <div class="mb-2">
            <h2 class="font-jakarta text-xl font-bold text-slate-900">Classes</h2>
            <p class="mt-1 text-sm text-slate-500">Create and manage school classes.</p>
        </div>

        <livewire:school-classes />

    </div>

@endsection
