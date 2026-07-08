<div>
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
