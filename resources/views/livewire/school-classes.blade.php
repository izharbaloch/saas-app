<div class="space-y-6">

    {{-- Success Message --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="flex items-center justify-between rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-3 text-emerald-700">

            <div class="flex items-center gap-3">
                <svg class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>

                <span class="text-sm font-medium">
                    {{ session('success') }}
                </span>
            </div>

            <button @click="show=false" class="text-emerald-600 hover:text-emerald-800">

                ✕
            </button>
        </div>
    @endif

    {{-- Add Button --}}
    @unless ($showForm)
        <div class="flex justify-end">
            <button wire:click="openForm"
                class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">

                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

                Add New Class
            </button>
        </div>
    @endunless

    {{-- Form --}}
    @if ($showForm)

        <form wire:submit.prevent="save" class="space-y-6">

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50 px-6 py-4">

                    <h3 class="text-base font-semibold text-slate-800">

                        {{ $classId ? 'Edit Class' : 'Create Class' }}

                    </h3>

                </div>

                {{-- Body --}}
                <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                    {{-- Class Name --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">

                            Class Name

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" wire:model.defer="name" placeholder="Enter class name"
                            class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        @error('name')
                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Grade --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">

                            Grade

                            <span class="text-red-500">*</span>

                        </label>

                        <select wire:model.defer="grade"
                            class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            <option value="">Select Grade</option>

                            @foreach (range(1, 12) as $grade)
                                <option value="{{ $grade }}">

                                    Grade {{ $grade }}

                                </option>
                            @endforeach

                        </select>

                        @error('grade')
                            <p class="mt-1 text-xs text-red-500">

                                {{ $message }}

                            </p>
                        @enderror

                    </div>

                    {{-- Status --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">

                            Status

                        </label>

                        <select wire:model.defer="status"
                            class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            <option value="1">
                                Active
                            </option>

                            <option value="0">
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div class="flex justify-end gap-3">

                <button type="button" wire:click="resetForm"
                    class="rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50">

                    Cancel

                </button>

                <button type="submit"
                    class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">

                    {{ $classId ? 'Update Class' : 'Create Class' }}

                </button>

            </div>

        </form>

    @endif
    {{-- Table --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 bg-slate-50 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">
                        Classes
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Manage all school classes.
                    </p>
                </div>

                <div class="text-sm text-slate-500">
                    Total:
                    <span class="font-semibold text-slate-700">
                        {{ $classes->count() }}
                    </span>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Class
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Grade
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">

                    @forelse($classes as $class)
                        <tr class="hover:bg-slate-50 transition">

                            {{-- Class --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-600">

                                        {{ $class->grade }}

                                    </div>

                                    <div>

                                        <h4 class="text-sm font-semibold text-slate-800">
                                            {{ $class->name }}
                                        </h4>

                                        <p class="text-xs text-slate-500">
                                            School Class
                                        </p>

                                    </div>

                                </div>

                            </td>

                            {{-- Grade --}}
                            <td class="px-6 py-4 text-sm text-slate-600">

                                Grade {{ $class->grade }}

                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if ($class->status)
                                    <span
                                        class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">

                                        Active

                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700">

                                        Inactive

                                    </span>
                                @endif

                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    {{-- Edit --}}
                                    <button title="Edit" wire:click="edit({{ $class->id }})"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-amber-600 hover:bg-amber-50 transition">

                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />

                                        </svg>

                                    </button>

                                    {{-- Delete --}}
                                    <button title="Delete" wire:click="destroy({{ $class->id }})"
                                        wire:confirm="Are you sure you want to delete this class?"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-rose-600 hover:bg-rose-50 transition">

                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9" />

                                        </svg>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">

                                <div
                                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                                    <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18" />

                                    </svg>
                                </div>

                                <h3 class="mt-4 text-lg font-semibold text-slate-700">
                                    No Classes Found
                                </h3>

                                <p class="mt-2 text-sm text-slate-500">
                                    Create your first class to start managing students.
                                </p>

                                <button type="button" wire:click="openForm"
                                    class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 transition">

                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.5v15m7.5-7.5h-15" />

                                    </svg>

                                    Add New Class

                                </button>

                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if (method_exists($classes, 'links'))
            <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">

                {{ $classes->withQueryString()->links() }}

            </div>
        @else
            <div class="flex items-center justify-between border-t border-slate-200 bg-slate-50 px-6 py-4">

                <p class="text-sm text-slate-500">

                    Showing

                    <span class="font-semibold text-slate-700">

                        {{ $classes->count() }}

                    </span>

                    Classes

                </p>

            </div>
        @endif

    </div>

</div>
