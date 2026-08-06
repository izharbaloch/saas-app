<div class="space-y-6">
    {{-- Success Message --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="mb-4 flex items-center justify-between rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>

                <span class="text-sm font-medium">
                    {{ session('success') }}
                </span>
            </div>

            <button @click="show = false" class="text-emerald-600 hover:text-emerald-800">
                ✕
            </button>
        </div>
    @endif

    {{-- Add Button --}}
    @unless ($showForm)
        <button wire:click="openForm"
            class="mb-5 inline-flex items-center rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 transition">
            + Assign New Sections
        </button>
    @endunless

    @if ($showForm)
        {{-- Header --}}
        <form wire:submit.prevent={{ $assignRecordId ? 'update' : 'save' }}>

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="text-xl font-bold text-slate-800">
                        {{ $assignRecordId ? 'Edit Assign Class Details' : 'Assign Class Details' }}
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Assign Sections, Academic Years and Teachers to a Class.
                    </p>
                </div>

                <div class="p-6">

                    {{-- Class --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Select Class <span class="text-red-500">*</span>
                        </label>

                        <select wire:model="class_id"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">

                            <option value="">Select Class</option>

                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">
                                    Grade-{{ $class->grade }} - {{ $class->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('class_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                </div>
            </div>

            {{-- Assign Boxes --}}
            <div class="grid gap-6 lg:grid-cols-3">

                {{-- Sections --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-5 py-4">
                        <h3 class="font-semibold text-slate-700">
                            Assign Sections
                        </h3>
                    </div>

                    <div class="space-y-3 p-5">

                        @foreach ($sections as $section)
                            <label
                                class="flex items-center gap-3 rounded-lg border p-3 hover:bg-slate-50 cursor-pointer">
                                <input type="checkbox" wire:model="section_ids" value="{{ $section->id }}"
                                    class="rounded border-slate-300 text-indigo-600">

                                <span>{{ $section->name }}</span>
                            </label>
                        @endforeach

                        @error('section_ids')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                </div>

                {{-- Academic Years --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-5 py-4">
                        <h3 class="font-semibold text-slate-700">
                            Assign Academic Years
                        </h3>
                    </div>

                    <div class="space-y-3 p-5">

                        @foreach ($academicYears as $academicYear)
                            <label
                                class="flex items-center gap-3 rounded-lg border p-3 hover:bg-slate-50 cursor-pointer">
                                <input type="checkbox" wire:model="academic_year_ids"
                                    value="{{ $academicYear->id }}" class="rounded border-slate-300 text-indigo-600">

                                <span>{{ $academicYear->name }}</span>
                            </label>
                        @endforeach

                        @error('academic_year_ids')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                </div>

                {{-- Teachers --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-5 py-4">
                        <h3 class="font-semibold text-slate-700">
                            Assign Teachers
                        </h3>
                    </div>

                    {{-- <div class="space-y-3 p-5">

                @foreach ($teachers as $teacher)
                    <label class="flex items-center gap-3 rounded-lg border p-3 hover:bg-slate-50 cursor-pointer">

                        <input type="checkbox" wire:model.live="teacher_ids" value="{{ $teacher->id }}"
                            class="rounded border-slate-300 text-indigo-600">

                        <span>{{ $teacher->name }}</span>

                    </label>
                @endforeach

                @error('teacher_ids')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror

            </div> --}}

                </div>

            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-3">

                <button type="button" wire:click="resetForm"
                    class="rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100">

                    Reset

                </button>

                <button type="submit"
                    class="rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">

                    {{ $assignRecordId ? 'Update Assignment' : 'Assign' }}

                </button>

            </div>

        </form>
    @endif

    {{-- Assigned Records --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-4">
            <h3 class="font-semibold text-slate-700">
                Assigned Records
            </h3>
        </div>

        <table class="min-w-full divide-y divide-slate-200">

            <thead class="bg-slate-50">

                <tr>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                        #
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                        Class
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                        Sections
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                        Academic Years
                    </th>

                    {{-- <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                        Teachers
                    </th>

                    <th class="px-6 py-3 text-center text-xs font-semibold uppercase text-slate-500">
                        Status
                    </th> --}}

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">
                @foreach ($classSections as $sections)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium text-slate-800">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-slate-800">{{ $sections->first()->schoolClass->name }}
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">
                            @foreach ($sections as $item)
                                <span>{{ $item->section->name }}</span>{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">
                            @foreach ($sections->unique('academic_year_id') as $item)
                                <span>{{ $item->academicYear->name }}</span>{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">

                                <button wire:click="edit({{ $sections->first()->id }})"
                                    class="rounded-lg p-2 text-amber-600 hover:bg-amber-50">
                                    ✏️
                                </button>

                                <button wire:click="destroy({{ $sections->first()->id }})"
                                    wire:confirm="Are you sure you want to delete this assignment?"
                                    class="rounded-lg p-2 text-red-600 hover:bg-red-50">
                                    🗑️
                                </button>

                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</div>
