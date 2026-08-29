@extends('layouts.app')

@section('title', 'Students')
@section('page-title', 'Students')

@section('content')

    <div class="mx-auto max-w-6xl space-y-8">

        {{-- Page heading --}}
        <div class="mb-2">
            <h2 class="font-jakarta text-xl font-bold text-slate-900">Students</h2>
            <p class="mt-1 text-sm text-slate-500">Add a new student and view the list of enrolled students.</p>
        </div>

        {{-- Student Form --}}
        <form>
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="text-xl font-bold text-slate-800">
                        New Student
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Fill in the details below to add a new student.
                    </p>
                </div>

                <div class="grid gap-6 p-6 md:grid-cols-2">

                    {{-- Full Name --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" placeholder="Enter full name"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    {{-- Roll Number --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Roll Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" placeholder="Enter roll number"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    {{-- Father Name --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Father Name
                        </label>
                        <input type="text" placeholder="Enter father name"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    {{-- Gender --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Gender
                        </label>
                        <select
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    {{-- Date of Birth --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Date of Birth
                        </label>
                        <input type="date"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    {{-- Class --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Class <span class="text-red-500">*</span>
                        </label>
                        <select
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                            <option value="">Select Class</option>
                        </select>
                    </div>

                    {{-- Section --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Section
                        </label>
                        <select
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                            <option value="">Select Section</option>
                        </select>
                    </div>

                    {{-- Contact Number --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Contact Number
                        </label>
                        <input type="text" placeholder="Enter contact number"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    {{-- Address --}}
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Address
                        </label>
                        <textarea rows="3" placeholder="Enter address"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="flex justify-end gap-3 border-t border-slate-100 px-6 py-4">

                    <button type="reset"
                        class="rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100">
                        Reset
                    </button>

                    <button type="submit"
                        class="rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                        Save Student
                    </button>

                </div>

            </div>
        </form>

        {{-- Students Listing --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

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
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Class</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Section
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Contact
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
                                <td class="px-6 py-4 text-slate-600">{{ $student->roll_number }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $student->class_name }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $student->section_name }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $student->contact }}</td>
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

@endsection
