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
            + Add New Student
        </button>
    @endunless

    @if ($showForm)
        {{-- Student Form --}}
        <form wire:submit="save">
            <div class="space-y-6">

                {{-- ========================================================= --}}
                {{-- Personal Information --}}
                {{-- ========================================================= --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5">
                        <h2 class="text-xl font-bold text-slate-800">Personal Information</h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Enter the student's basic personal information.
                        </p>
                    </div>

                    <div class="grid gap-6 p-6 md:grid-cols-2">

                        {{-- Student Photo --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Student Photo
                            </label>
                            <input type="file" accept="image/*"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Full Name --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="name" placeholder="Enter full name"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                            focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                            @error('name')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Student ID --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Student ID / Admission No.
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="admission_no" placeholder="Enter admission number"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                            focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                            @error('admission_no')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Roll Number --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Roll Number
                            </label>
                            <input type="text" wire:model="roll_no" placeholder="Enter roll number"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Father Name --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Father Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="father_name" placeholder="Enter father name"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                            @error('father_name')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Gender --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Gender <span class="text-red-500">*</span>
                            </label>
                            <select wire:model="gender"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            @error('gender')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Date of Birth --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Date of Birth <span class="text-red-500">*</span>
                            </label>
                            <input type="date" wire:model="dob"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                            @error('dob')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- B-Form / CNIC --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                B-Form / CNIC Number
                            </label>
                            <input type="text" wire:model="b_form_no" placeholder="Enter B-Form / CNIC number"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Religion --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Religion
                            </label>
                            <select wire:model="religion"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                <option value="">Select Religion</option>
                                <option value="muslim">Muslim</option>
                                <option value="christian">Christian</option>
                                <option value="hindu">Hindu</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        {{-- Blood Group --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Blood Group
                            </label>
                            <select wire:model="blood_group"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                <option value="">Select Blood Group</option>
                                <option>A+</option>
                                <option>A-</option>
                                <option>B+</option>
                                <option>B-</option>
                                <option>AB+</option>
                                <option>AB-</option>
                                <option>O+</option>
                                <option>O-</option>
                            </select>
                        </div>

                        {{-- Nationality --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Nationality
                            </label>
                            <input type="text" wire:model="nationality" placeholder="Enter nationality"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Previous School --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Previous School
                            </label>
                            <input type="text" wire:model="previous_school" placeholder="Enter previous school name"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                    </div>
                </div>


                {{-- ========================================================= --}}
                {{-- Parent / Guardian Information --}}
                {{-- ========================================================= --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5">
                        <h2 class="text-xl font-bold text-slate-800">
                            Parent / Guardian Information
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Enter parent or guardian contact details.
                        </p>
                    </div>

                    <div class="grid gap-6 p-6 md:grid-cols-2">

                        {{-- Father Occupation --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Father's Occupation
                            </label>
                            <input type="text" wire:model="father_occupation"
                                placeholder="Enter father's occupation"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Father Contact --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Father's Contact Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="father_contact_numer"
                                placeholder="Enter contact number"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                            @error('father_contact_numer')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Mother Name --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Mother's Name
                            </label>
                            <input type="text" wire:model="mother_name" placeholder="Enter mother's name"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Mother Contact --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Mother's Contact Number
                            </label>
                            <input type="text" wire:model="mother_contact_numer"
                                placeholder="Enter mother's contact number"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Guardian Name --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Guardian Name
                            </label>
                            <input type="text" wire:model="guardian_name" placeholder="Enter guardian name"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Guardian Relation --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Guardian Relation
                            </label>
                            <select wire:model="guardian_relation"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                <option value="">Select Relation</option>
                                <option>Father</option>
                                <option>Mother</option>
                                <option>Brother</option>
                                <option>Sister</option>
                                <option>Uncle</option>
                                <option>Aunt</option>
                                <option>Other</option>
                            </select>
                        </div>

                        {{-- Guardian Contact --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Guardian Contact Number
                            </label>
                            <input type="text" wire:model="guardian_contact_numer"
                                placeholder="Enter guardian contact"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Parent Email --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Parent / Guardian Email
                            </label>
                            <input type="email" wire:model="guardian_email" placeholder="Enter email address"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                    </div>
                </div>


                {{-- ========================================================= --}}
                {{-- Address Information --}}
                {{-- ========================================================= --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5">
                        <h2 class="text-xl font-bold text-slate-800">Address Information</h2>
                    </div>

                    <div class="grid gap-6 p-6 md:grid-cols-2">

                        {{-- Address --}}
                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Residential Address <span class="text-red-500">*</span>
                            </label>
                            <textarea rows="3" wire:model="address" placeholder="Enter complete address"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"></textarea>
                            @error('address')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- City --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                City
                            </label>
                            <input type="text" wire:model="city" placeholder="Enter city"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Postal Code --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Postal Code
                            </label>
                            <input type="text" wire:model="postal_code" placeholder="Enter postal code"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                    </div>
                </div>


                {{-- ========================================================= --}}
                {{-- Academic / Admission Information --}}
                {{-- ========================================================= --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5">
                        <h2 class="text-xl font-bold text-slate-800">
                            Academic & Admission Information
                        </h2>
                    </div>

                    <div class="grid gap-6 p-6 md:grid-cols-2">

                        {{-- Admission Date --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Admission Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" wire:model="admission_date"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                            @error('admission_date')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Section --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Section
                            </label>
                            <select wire:model="class_section_id"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                <option value="">Select Section</option>
                                @foreach ($classSections as $classSection)
                                    <option value="{{ $classSection->id }}">
                                        {{ $classSection->schoolClass->name }}-{{ $classSection->section->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Admission Type --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Admission Type <span class="text-red-500">*</span>
                            </label>
                            <select wire:model="admission_type"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                <option value="">Select Admission Type</option>
                                <option>New Admission</option>
                                <option>Transfer</option>
                                <option>Re-Admission</option>
                            </select>
                            @error('admission_type')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Previous Class --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Previous Class
                            </label>
                            <input type="text" wire:model="previous_class" placeholder="Enter previous class"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Previous School --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Previous School
                            </label>
                            <input type="text" wire:model="previous_school" placeholder="Enter previous school"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Transport --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Transport Required
                            </label>
                            <select wire:model="transport_required"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                    </div>
                </div>


                {{-- ========================================================= --}}
                {{-- Emergency & Medical Information --}}
                {{-- ========================================================= --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5">
                        <h2 class="text-xl font-bold text-slate-800">
                            Emergency & Medical Information
                        </h2>
                    </div>

                    <div class="grid gap-6 p-6 md:grid-cols-2">

                        {{-- Emergency Contact --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Emergency Contact Name
                            </label>
                            <input type="text" wire:model="emergency_contact_name"
                                placeholder="Enter emergency contact name"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Emergency Phone --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Emergency Contact Number
                            </label>
                            <input type="text" wire:model="emergency_contact_number"
                                placeholder="Enter emergency contact number"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Medical Conditions --}}
                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Medical Conditions / Allergies
                            </label>
                            <textarea rows="3" wire:model="medical_conditions"
                                placeholder="Enter any medical condition, allergy or important medical information"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"></textarea>
                        </div>

                    </div>
                </div>


                {{-- ========================================================= --}}
                {{-- Attachments / Documents --}}
                {{-- ========================================================= --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5">
                        <h2 class="text-xl font-bold text-slate-800">
                            Attachments & Documents
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Upload the required student documents.
                        </p>
                    </div>

                    <div class="grid gap-6 p-6 md:grid-cols-2">

                        {{-- B-Form --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                B-Form / CNIC Copy
                            </label>
                            <input type="file" accept=".jpg,.jpeg,.png,.pdf"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Birth Certificate --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Birth Certificate
                            </label>
                            <input type="file" accept=".jpg,.jpeg,.png,.pdf"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Previous School Certificate --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Previous School / Leaving Certificate
                            </label>
                            <input type="file" accept=".jpg,.jpeg,.png,.pdf"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Student Photo --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Student Photograph
                            </label>
                            <input type="file" accept="image/*"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Other Documents --}}
                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Other Documents
                            </label>
                            <input type="file" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">

                            <p class="mt-2 text-xs text-slate-500">
                                You can upload multiple documents. Supported formats:
                                JPG, PNG, PDF, DOC, DOCX.
                            </p>
                        </div>

                    </div>
                </div>


                {{-- ========================================================= --}}
                {{-- Buttons --}}
                {{-- ========================================================= --}}
                <div
                    class="flex justify-end gap-3 rounded-2xl border border-slate-200
                    bg-white px-6 py-4 shadow-sm">

                    <button type="reset"
                        class="rounded-xl border border-slate-300 px-5 py-2.5 text-sm
                        font-medium text-slate-700 hover:bg-slate-100">
                        Reset
                    </button>

                    <button type="submit"
                        class="rounded-xl bg-indigo-600 px-6 py-2.5 text-sm
                        font-semibold text-white hover:bg-indigo-700">
                        Save Student
                    </button>

                </div>

            </div>
        </form>
    @endif


    {{-- Students Listing --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm mt-5">

        <div class="border-b border-slate-100 px-6 py-4">
            <h3 class="font-semibold text-slate-700">
                Students List
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Roll
                            Number</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Admission
                            Number</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Class</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Section
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Father Name
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase text-slate-500">Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($students ?? [] as $student)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-medium text-slate-800">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-medium text-slate-800">{{ $student->name }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $student->roll_no }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $student->admission_no }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $student->classSection->schoolClass->name }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $student->classSection->section->name }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $student->father_name }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <button class="rounded-lg p-2 text-amber-600 hover:bg-amber-50">
                                        ✏️
                                    </button>
                                    <button class="rounded-lg p-2 text-red-600 hover:bg-red-50">
                                        🗑️
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-sm text-slate-500">
                                No students found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
