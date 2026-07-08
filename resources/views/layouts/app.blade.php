<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — {{ config('app.name', 'EduCore SMS') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        jakarta: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    @stack('styles')
    @livewireStyles
</head>

<body class="h-full bg-slate-50 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <!-- ══════════════════════════════════════════════
         MOBILE BACKDROP
    ══════════════════════════════════════════════ -->
    <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden"></div>

    <!-- ══════════════════════════════════════════════
         SIDEBAR
    ══════════════════════════════════════════════ -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col bg-slate-900 transition-transform duration-300 lg:translate-x-0">
        <!-- Logo -->
        <div class="flex h-16 shrink-0 items-center gap-3 border-b border-slate-700/60 px-5">
            <div
                class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 shadow-lg">
                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>
            </div>
            <span class="font-jakarta text-lg font-bold text-white">EduCore SMS</span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">

            <!-- Group: Main -->
            <p class="mb-1 px-3 text-[10px] font-semibold uppercase tracking-widest text-slate-500">Main</p>

            <a href="{{ route('dashboard') }}"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium
                      {{ request()->routeIs('dashboard') ? 'bg-indigo-600/20 text-indigo-300' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-colors">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Dashboard
            </a>

            <!-- Group: Academic -->
            <p class="mb-1 mt-5 px-3 text-[10px] font-semibold uppercase tracking-widest text-slate-500">Academic</p>

            <!-- Students (expandable) -->
            <div x-data="{ open: {{ request()->routeIs('students.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="group flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium
                           {{ request()->routeIs('students.*') ? 'bg-indigo-600/20 text-indigo-300' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="flex-1 text-left">Students</span>
                    <svg :class="open ? 'rotate-180' : ''" class="h-4 w-4 transition-transform duration-200"
                        fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="ml-4 mt-0.5 space-y-0.5 border-l border-slate-700/60 pl-3">
                    <a href="#"
                        class="block rounded-lg px-3 py-1.5 text-sm {{ request()->routeIs('students.index') ? 'text-indigo-300 font-medium' : 'text-slate-500 hover:text-slate-200' }} transition-colors">All
                        Students</a>
                    <a href="#"
                        class="block rounded-lg px-3 py-1.5 text-sm {{ request()->routeIs('students.create') ? 'text-indigo-300 font-medium' : 'text-slate-500 hover:text-slate-200' }} transition-colors">Enroll
                        Student</a>
                </div>
            </div>

            <a href="#"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium
                      {{ request()->routeIs('teachers.*') ? 'bg-indigo-600/20 text-indigo-300' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-colors">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-3.342" />
                </svg>
                Teachers
            </a>

            <a href="#"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium
                      {{ request()->routeIs('classes.*') ? 'bg-indigo-600/20 text-indigo-300' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-colors">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                </svg>
                Classes
            </a>

            <a href="#"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium
                      {{ request()->routeIs('attendance.*') ? 'bg-indigo-600/20 text-indigo-300' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-colors">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Attendance
            </a>

            <a href="#"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium
                      {{ request()->routeIs('exams.*') ? 'bg-indigo-600/20 text-indigo-300' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-colors">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
                Examinations
            </a>

            <!-- Group: Administration -->
            <p class="mb-1 mt-5 px-3 text-[10px] font-semibold uppercase tracking-widest text-slate-500">Administration
            </p>

            <a href="#"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium
                      {{ request()->routeIs('fees.*') ? 'bg-indigo-600/20 text-indigo-300' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-colors">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
                Fee Management
                <span
                    class="ml-auto rounded-full bg-rose-500/20 px-1.5 py-0.5 text-[10px] font-semibold text-rose-400">3</span>
            </a>

            <a href="#"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium
                      {{ request()->routeIs('library.*') ? 'bg-indigo-600/20 text-indigo-300' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-colors">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>
                Library
            </a>

            <a href="#"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium
                      {{ request()->routeIs('events.*') ? 'bg-indigo-600/20 text-indigo-300' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-colors">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                Events
            </a>

            <a href="#"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium
                      {{ request()->routeIs('reports.*') ? 'bg-indigo-600/20 text-indigo-300' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-colors">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                </svg>
                Reports
            </a>

            <a href="#"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium
                      {{ request()->routeIs('settings.*') ? 'bg-indigo-600/20 text-indigo-300' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-colors">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                Settings
            </a>

        </nav>

        <!-- User profile -->
        <div class="shrink-0 border-t border-slate-700/60 p-3" x-data="{ open: false }">
            <div class="flex items-center gap-3 rounded-xl p-2">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin User') }}&background=6366f1&color=fff&size=80"
                    alt="Avatar" class="h-9 w-9 rounded-full ring-2 ring-indigo-500/40">
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-semibold text-white">{{ auth()->user()->name ?? 'Administrator' }}
                    </p>
                    <p class="truncate text-xs text-slate-400">{{ auth()->user()->email ?? 'admin@school.edu' }}</p>
                </div>
                <div class="relative">
                    <button @click="open = !open"
                        class="flex h-7 w-7 items-center justify-center rounded-lg text-slate-400 hover:text-white transition-colors">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                        </svg>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute bottom-full right-0 mb-2 w-44 rounded-xl bg-slate-800 py-1 shadow-xl ring-1 ring-white/10 z-10">
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            My Profile
                        </a>
                        <div class="my-1 border-t border-slate-700"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex w-full items-center gap-2 px-4 py-2 text-sm text-rose-400 hover:bg-slate-700 hover:text-rose-300 transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- ══════════════════════════════════════════════
         MAIN WRAPPER (offset by sidebar width on lg+)
    ══════════════════════════════════════════════ -->
    <div class="flex min-h-full flex-col lg:pl-64">

        <!-- ══════════════════════════════════════════
             HEADER / TOPBAR
        ══════════════════════════════════════════ -->
        <header
            class="sticky top-0 z-30 flex h-16 items-center gap-4 border-b border-slate-200 bg-white/80 px-4 shadow-sm backdrop-blur-md sm:px-6">

            <!-- Mobile hamburger -->
            <button @click="sidebarOpen = true"
                class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100 lg:hidden">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                </svg>
            </button>

            <!-- Page title (injected per page) -->
            <div class="flex-1">
                <h1 class="font-jakarta text-lg font-bold text-slate-800">@yield('page-title', 'Dashboard')</h1>
            </div>

            <!-- Right side actions -->
            <div class="flex items-center gap-2">

                <!-- Academic year -->
                <span
                    class="hidden items-center gap-1.5 rounded-full border border-indigo-200 bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700 sm:flex">
                    <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-indigo-500"></span>
                    {{ config('school.academic_year', '2024 – 2025') }}
                </span>

                <!-- Notifications -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="relative flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                        <span
                            class="absolute right-1.5 top-1.5 h-2 w-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute right-0 top-full mt-2 w-72 rounded-2xl bg-white shadow-xl ring-1 ring-slate-900/10">
                        <div class="border-b border-slate-100 px-4 py-3">
                            <p class="text-sm font-semibold text-slate-900">Notifications</p>
                        </div>
                        <div class="p-3 text-center">
                            <p class="text-sm text-slate-400 py-4">You're all caught up!</p>
                        </div>
                    </div>
                </div>

                <!-- Extra topbar slot (add buttons per page) -->
                @hasSection('topbar-actions')
                    <div class="flex items-center gap-2 border-l border-slate-200 pl-2">
                        @yield('topbar-actions')
                    </div>
                @endif

            </div>
        </header>

        <!-- ══════════════════════════════════════════
             CONTENT AREA
        ══════════════════════════════════════════ -->
        <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8">

            {{-- Flash: success --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition
                    class="mb-5 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4">
                    <svg class="h-5 w-5 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p class="flex-1 text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                    <button @click="show = false" class="text-emerald-500 hover:opacity-70"><svg class="h-4 w-4"
                            fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg></button>
                </div>
            @endif

            {{-- Flash: error --}}
            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-transition
                    class="mb-5 flex items-center gap-3 rounded-xl border border-rose-200 bg-rose-50 p-4">
                    <svg class="h-5 w-5 shrink-0 text-rose-500" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <p class="flex-1 text-sm font-medium text-rose-800">{{ session('error') }}</p>
                    <button @click="show = false" class="text-rose-500 hover:opacity-70"><svg class="h-4 w-4"
                            fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg></button>
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 p-4">
                    <p class="mb-2 text-sm font-semibold text-rose-800">Please fix the following:</p>
                    <ul class="list-disc pl-5 space-y-0.5 text-sm text-rose-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- PAGE CONTENT --}}
            @yield('content')

        </main>

        <!-- ══════════════════════════════════════════
             FOOTER
        ══════════════════════════════════════════ -->
        <footer class="border-t border-slate-200 bg-white px-4 py-4 sm:px-6">
            <div class="flex flex-col items-center justify-between gap-2 text-xs text-slate-400 sm:flex-row">
                <p>&copy; {{ date('Y') }} <span
                        class="font-medium text-slate-500">{{ config('app.name', 'EduCore SMS') }}</span> — School
                    Management System</p>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:text-slate-600 transition-colors">Help</a>
                    <a href="#" class="hover:text-slate-600 transition-colors">Privacy</a>
                    <a href="#" class="hover:text-slate-600 transition-colors">Terms</a>
                    <span class="text-slate-300">v1.0.0</span>
                </div>
            </div>
        </footer>

    </div><!-- end main wrapper -->

    @stack('scripts')
    @livewireScripts
</body>

</html>
