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
            + Add New Section
        </button>
    @endunless

    {{-- Form --}}
    @if ($showForm)
        <form wire:submit.prevent="save" class="space-y-6">

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 bg-slate-50 px-6 py-4">
                    <h3 class="text-sm font-semibold text-slate-700">
                        {{ $sectionId ? 'Edit Section' : 'Add Section' }}
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-5 px-6 py-5 md:grid-cols-2">

                    {{-- Section Name --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Section Name <span class="text-red-500">*</span>
                        </label>

                        <input type="text" wire:model="name" placeholder="Enter section name"
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
                    {{ $sectionId ? 'Update Section' : 'Create Section' }}
                </button>
            </div>

        </form>
    @endif

    {{-- Table --}}
    <div class="mt-6 rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">

        <table class="min-w-full divide-y divide-slate-200">

            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                        Section Name
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                        Created At
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

                @forelse($sections as $section)
                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-4 font-medium text-slate-800">
                            {{ $section->name }}
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ $section->created_at->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4">
                            @if ($section->status)
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

                                <button wire:click="edit({{ $section->id }})"
                                    class="rounded-lg p-2 text-amber-600 hover:bg-amber-50">
                                    ✏️
                                </button>

                                <button wire:click="destroy({{ $section->id }})"
                                    wire:confirm="Are you sure you want to delete this section?"
                                    class="rounded-lg p-2 text-red-600 hover:bg-red-50">
                                    🗑️
                                </button>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="py-16 text-center">

                            <h3 class="text-lg font-semibold text-slate-700">
                                No Sections Found
                            </h3>

                            <p class="mt-2 text-sm text-slate-500">
                                Create your first section to get started.
                            </p>

                            <button wire:click="openForm"
                                class="mt-5 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                                + Add Section
                            </button>

                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

        @if (method_exists($sections, 'links'))
            <div class="border-t border-slate-200 p-4">
                {{ $sections->links() }}
            </div>
        @endif

    </div>

</div>
