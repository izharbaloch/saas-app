<div>
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
            + Add Academic Year
        </button>
    @endunless

    {{-- Form --}}
    @if ($showForm)
        <form wire:submit.prevent="save" class="space-y-6">

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 bg-slate-50 px-6 py-4">
                    <h3 class="text-sm font-semibold text-slate-700">
                        {{ $academicYearId ? 'Edit Academic Year' : 'Add Academic Year' }}
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-5 px-6 py-5 md:grid-cols-2">

                    {{-- Academic Year Name --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Academic Year <span class="text-red-500">*</span>
                        </label>

                        <input type="text" wire:model="name" placeholder="e.g. 2025-2026"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">

                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Status
                        </label>

                        <select wire:model="status"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>

                        @error('status')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Start Date --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Start Date <span class="text-red-500">*</span>
                        </label>

                        <input type="date" wire:model="start_date"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">

                        @error('start_date')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- End Date --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            End Date <span class="text-red-500">*</span>
                        </label>

                        <input type="date" wire:model="end_date"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">

                        @error('end_date')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Current Academic Year --}}
                    <div class="md:col-span-2">
                        <label class="inline-flex items-center gap-3">
                            <input type="checkbox" wire:model="is_current"
                                class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">

                            <span class="text-sm font-medium text-slate-700">
                                Set as Current Academic Year
                            </span>
                        </label>

                        @error('is_current')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" wire:click="resetForm"
                    class="rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    Cancel
                </button>

                <button type="submit"
                    class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                    {{ $academicYearId ? 'Update Academic Year' : 'Create Academic Year' }}
                </button>
            </div>

        </form>
    @endif

    {{-- Table --}}
    <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full divide-y divide-slate-200">

            <thead class="bg-slate-50">
                <tr>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                        Academic Year
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                        Start Date
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                        End Date
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                        Current
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                        Status
                    </th>

                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase text-slate-500">
                        Actions
                    </th>

                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($academicYears as $academicYear)
                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-4 font-medium text-slate-800">
                            {{ $academicYear->name }}
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ \Carbon\Carbon::parse($academicYear->start_date)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ \Carbon\Carbon::parse($academicYear->end_date)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4">
                            @if ($academicYear->is_current)
                                <span
                                    class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700">
                                    Current
                                </span>
                            @else
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                    No
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            @if ($academicYear->status)
                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    Active
                                </span>
                            @else
                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">

                                <button wire:click="edit({{ $academicYear->id }})"
                                    class="rounded-lg p-2 text-amber-600 hover:bg-amber-50">
                                    ✏️
                                </button>

                                <button wire:click="destroy({{ $academicYear->id }})"
                                    wire:confirm="Are you sure you want to delete this academic year?"
                                    class="rounded-lg p-2 text-red-600 hover:bg-red-50">
                                    🗑️
                                </button>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="py-16 text-center">

                            <h3 class="text-lg font-semibold text-slate-700">
                                No Academic Years Found
                            </h3>

                            <p class="mt-2 text-sm text-slate-500">
                                Create your first academic year to get started.
                            </p>

                            <button wire:click="openForm"
                                class="mt-5 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                                + Add Academic Year
                            </button>

                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

        @if (method_exists($academicYears, 'links'))
            <div class="border-t border-slate-200 p-4">
                {{ $academicYears->links() }}
            </div>
        @endif

    </div>

</div>
