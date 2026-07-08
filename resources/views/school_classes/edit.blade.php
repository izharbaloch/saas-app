@extends('layouts.app')

@section('title', 'Create Class')
@section('page-title', 'Create Class')

@section('topbar-actions')
    <a href="{{ route('classes.index') }}"
        class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
        Back to Classes
    </a>
@endsection

@section('content')

    <div class="mx-auto max-w-3xl">

        {{-- Page heading --}}
        <div class="mb-6">
            <h2 class="font-jakarta text-xl font-bold text-slate-900">New Class</h2>
            <p class="mt-1 text-sm text-slate-500">Fill in the details below to create a new class section.</p>
        </div>

        <form action="{{ route('classes.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- ── Section 1: Basic Info ─────────────────────────────── --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 bg-slate-50 px-6 py-4">
                    <h3 class="text-sm font-semibold text-slate-700">Basic Information</h3>
                </div>
                <div class="grid grid-cols-1 gap-5 px-6 py-5 sm:grid-cols-2">

                    {{-- Class Name --}}
                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Class Name <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            placeholder="e.g. Grade 10 — Section A" required
                            class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400
                               focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400
                               @error('name') border-rose-400 bg-rose-50 focus:border-rose-400 focus:ring-rose-400 @enderror">
                        @error('name')
                            <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Section / Group --}}
                    <div>
                        <label for="section" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Section <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="section" id="section" value="{{ old('section') }}"
                            placeholder="e.g. A, B, C" required
                            class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400
                               focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400
                               @error('section') border-rose-400 bg-rose-50 @enderror">
                        @error('section')
                            <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Grade / Level --}}
                    <div>
                        <label for="grade" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Grade / Level <span class="text-rose-500">*</span>
                        </label>
                        <select name="grade" id="grade" required
                            class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900
                               focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400
                               @error('grade') border-rose-400 bg-rose-50 @enderror">
                            <option value="" disabled {{ old('grade') ? '' : 'selected' }}>Select grade…</option>
                            @foreach (range(1, 12) as $g)
                                <option value="{{ $g }}" {{ old('grade') == $g ? 'selected' : '' }}>Grade
                                    {{ $g }}</option>
                            @endforeach
                        </select>
                        @error('grade')
                            <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Academic Year --}}
                    <div>
                        <label for="academic_year_id" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Academic Year <span class="text-rose-500">*</span>
                        </label>
                        <select name="academic_year_id" id="academic_year_id" required
                            class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900
                               focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400
                               @error('academic_year_id') border-rose-400 bg-rose-50 @enderror">
                            <option value="" disabled selected>Select year…</option>
                            @foreach ($academicYears ?? [] as $year)
                                <option value="{{ $year->id }}"
                                    {{ old('academic_year_id') == $year->id ? 'selected' : '' }}>
                                    {{ $year->name }}
                                </option>
                            @endforeach
                            {{-- fallback for demo --}}
                            @if (empty($academicYears))
                                <option value="1" selected>2024 – 2025</option>
                                <option value="2">2025 – 2026</option>
                            @endif
                        </select>
                        @error('academic_year_id')
                            <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- ── Section 2: Capacity & Teacher ───────────────────────── --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 bg-slate-50 px-6 py-4">
                    <h3 class="text-sm font-semibold text-slate-700">Capacity & Assignment</h3>
                </div>
                <div class="grid grid-cols-1 gap-5 px-6 py-5 sm:grid-cols-2">

                    {{-- Class Teacher --}}
                    <div>
                        <label for="teacher_id" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Class Teacher
                        </label>
                        <select name="teacher_id" id="teacher_id"
                            class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900
                               focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400
                               @error('teacher_id') border-rose-400 bg-rose-50 @enderror">
                            <option value="">— Assign later —</option>
                            @foreach ($teachers ?? [] as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                            {{-- demo fallback --}}
                            @if (empty($teachers))
                                <option value="1">Mr. Ahmed Raza</option>
                                <option value="2">Ms. Sana Malik</option>
                                <option value="3">Mr. Tariq Hussain</option>
                            @endif
                        </select>
                        @error('teacher_id')
                            <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Max Capacity --}}
                    <div>
                        <label for="capacity" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Max Students <span class="text-rose-500">*</span>
                        </label>
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity', 40) }}"
                            min="1" max="200" placeholder="40" required
                            class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400
                               focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400
                               @error('capacity') border-rose-400 bg-rose-50 @enderror">
                        @error('capacity')
                            <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Room Number --}}
                    <div>
                        <label for="room" class="mb-1.5 block text-sm font-medium text-slate-700">Room Number</label>
                        <input type="text" name="room" id="room" value="{{ old('room') }}"
                            placeholder="e.g. B-204"
                            class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400
                               focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="mb-1.5 block text-sm font-medium text-slate-700">Status</label>
                        <select name="status" id="status"
                            class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900
                               focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>

                </div>
            </div>

            {{-- ── Section 3: Subjects ──────────────────────────────────── --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 bg-slate-50 px-6 py-4">
                    <h3 class="text-sm font-semibold text-slate-700">Subjects</h3>
                    <p class="mt-0.5 text-xs text-slate-400">Select all subjects taught in this class.</p>
                </div>
                <div class="px-6 py-5">
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4">
                        @php
                            $subjects = $subjects ?? [
                                'Mathematics',
                                'English',
                                'Urdu',
                                'Science',
                                'Physics',
                                'Chemistry',
                                'Biology',
                                'Computer',
                                'History',
                                'Geography',
                                'Islamiat',
                                'Arts',
                            ];
                        @endphp
                        @foreach ($subjects as $subject)
                            @php
                                $subjectId = is_object($subject)
                                    ? $subject->id
                                    : \Illuminate\Support\Str::slug($subject);
                                $subjectName = is_object($subject) ? $subject->name : $subject;
                                $checked = in_array($subjectId, old('subjects', []));
                            @endphp
                            <label
                                class="flex cursor-pointer items-center gap-2.5 rounded-xl border border-slate-200 px-3 py-2.5 hover:border-indigo-300 hover:bg-indigo-50 transition-colors has-[:checked]:border-indigo-400 has-[:checked]:bg-indigo-50">
                                <input type="checkbox" name="subjects[]" value="{{ $subjectId }}"
                                    {{ $checked ? 'checked' : '' }}
                                    class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="text-sm text-slate-700">{{ $subjectName }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('subjects')
                        <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- ── Section 4: Notes ────────────────────────────────────── --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 bg-slate-50 px-6 py-4">
                    <h3 class="text-sm font-semibold text-slate-700">Additional Notes</h3>
                </div>
                <div class="px-6 py-5">
                    <textarea name="notes" id="notes" rows="3"
                        placeholder="Any special instructions or remarks about this class…"
                        class="block w-full resize-none rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400
                           focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- ── Form Actions ────────────────────────────────────────── --}}
            <div class="flex items-center justify-end gap-3 pb-4">
                <a href="{{ route('classes.index') }}"
                    class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    Cancel
                </a>
                <button type="reset"
                    class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    Reset
                </button>
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm shadow-indigo-500/20 hover:bg-indigo-700 active:scale-[.98] transition-all">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create Class
                </button>
            </div>

        </form>
    </div>

@endsection
