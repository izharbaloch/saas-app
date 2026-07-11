<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if (!$showForm)
        <button wire:click="openForm"
            class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
            Add New Class
        </button>
    @endif
    @if ($showForm)
        <form wire:submit.prevent="{{ $classId ? 'update' : 'save' }}" class="space-y-6">

            {{-- ── Section 1: Basic Info ─────────────────────────────── --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 bg-slate-50 px-6 py-4">
                    <h3 class="text-sm font-semibold text-slate-700">{{ $classId ? 'Edit Class' : 'Add Class' }}</h3>
                </div>
                <div class="grid grid-cols-1 gap-5 px-6 py-5 sm:grid-cols-2">

                    {{-- Class Name --}}
                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Class Name <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" wire:model="name" placeholder="e.g. Grade 10 — Section A"
                            class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400
                               focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400
                               @error('name') border-rose-400 bg-rose-50 focus:border-rose-400 focus:ring-rose-400 @enderror">
                        @error('name')
                            <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Grade / Level --}}
                    <div>
                        <label for="grade" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Grade / Level <span class="text-rose-500">*</span>
                        </label>
                        <select required wire:model="grade"
                            class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900
                               focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400
                               @error('grade') border-rose-400 bg-rose-50 @enderror">
                            <option>Select grade…</option>
                            @foreach (range(1, 12) as $g)
                                <option value="{{ $g }}" {{ old('grade') == $g ? 'selected' : '' }}>Grade
                                    {{ $g }}</option>
                            @endforeach
                        </select>
                        @error('grade')
                            <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Status<span class="text-rose-500">*</span>
                        </label>
                        <select required wire:model="status"
                            class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900
                               focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400
                               @error('status') border-rose-400 bg-rose-50 @enderror">
                            <option value="1">Active</option>
                            <option value="0">inactive</option>
                        </select>
                        @error('status')
                            <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- ── Form Actions ────────────────────────────────────────── --}}
            <div class="flex items-center justify-end gap-3 pb-4">
                <button type="reset"
                    class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    Reset
                </button>
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm shadow-indigo-500/20 hover:bg-indigo-700 active:scale-[.98] transition-all">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    {{ $classId ? 'Update Class' : 'Create Class' }}
                </button>
            </div>

        </form>
    @endif

    {{-- Table --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Class</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Grade</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Status</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 bg-white">

                    @forelse($classes as $class)
                        @php
                            $pct = $class->capacity > 0 ? round(($class->enrolled / $class->capacity) * 100) : 0;
                            $barColor = $pct >= 100 ? 'bg-rose-500' : ($pct >= 80 ? 'bg-amber-400' : 'bg-emerald-500');
                            $statusMap = [
                                'active' => [
                                    'bg-emerald-100 text-emerald-700 ring-emerald-600/20',
                                    'bg-emerald-500',
                                    'Active',
                                ],
                                'inactive' => [
                                    'bg-slate-100 text-slate-600 ring-slate-500/20',
                                    'bg-slate-400',
                                    'Inactive',
                                ],
                                'full' => ['bg-rose-100 text-rose-700 ring-rose-600/20', 'bg-rose-500', 'Full'],
                            ];
                            [$badge, $dot, $label] = $statusMap[$class->status] ?? $statusMap['active'];
                        @endphp
                        <tr class="group hover:bg-slate-50 transition-colors">

                            {{-- Class name + grade badge --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-100 font-jakarta text-sm font-bold text-indigo-700">
                                        {{ $class->grade }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">{{ $class->name }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Teacher --}}
                            <td class="px-5 py-4">
                                <p class="text-sm text-slate-700">{{ $class->grade }}</p>
                            </td>

                            {{-- Status badge --}}
                            <td class="px-5 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset {{ $badge }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $dot }}"></span>
                                    {{ $label }}
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-5 py-4 text-right">
                                <div
                                    class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">

                                    {{-- View --}}
                                    <a href="#" title="View"
                                        class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>

                                    {{-- Edit --}}
                                    <button title="Edit" wire:click="edit({{ $class->id }})"
                                        class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-amber-50 hover:text-amber-600 transition-colors">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>

                                    {{-- Delete --}}
                                    <button title="Delete"
                                        class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-rose-50 hover:text-rose-600 transition-colors">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                                </svg>
                                <p class="mt-3 text-sm font-medium text-slate-500">No classes found</p>
                                <p class="mt-1 text-xs text-slate-400">Try adjusting your filters or create a new
                                    class.</p>
                                <a href="{{ route('classes.create') }}"
                                    class="mt-4 inline-flex items-center gap-1.5 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition-colors">
                                    + Create First Class
                                </a>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if (method_exists($classes, 'links'))
            <div class="border-t border-slate-100 px-5 py-3">
                {{ $classes->withQueryString()->links() }}
            </div>
        @else
            <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3">
                <p class="text-xs text-slate-400">Showing <span
                        class="font-medium text-slate-600">{{ $classes->count() }}</span> classes</p>
            </div>
        @endif
    </div>
</div>
