<div class="bg-white dark:bg-zinc-900 font-sans" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
    
    <style>
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
    </style>

    <!-- Sticky Header -->
    <header class="fixed inset-x-0 top-0 z-50 transition-all duration-300 ease-in-out" :class="{ 'bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md shadow-sm': scrolled, 'bg-transparent': !scrolled }">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5 flex items-center gap-x-2">
                    <span class="sr-only">TeamBoard</span>
                    <!-- Logo Icon -->
                    <div class="h-8 w-8 rounded-lg bg-indigo-600 flex items-center justify-center">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-zinc-900 dark:text-white">TeamBoard</span>
                </a>
            </div>
            <div class="flex lg:hidden">
                <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-zinc-700 dark:text-zinc-200">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <a href="#features" class="text-sm font-semibold leading-6 text-zinc-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition">Features</a>
                <a href="#pricing" class="text-sm font-semibold leading-6 text-zinc-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition">Pricing</a>
                <a href="#company" class="text-sm font-semibold leading-6 text-zinc-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition">Company</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end lg:gap-x-4">
                <a href="/login" class="text-sm font-semibold leading-6 text-zinc-900 dark:text-white my-auto px-4">Log in</a>
                <a href="/register" class="rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all hover:scale-105">Get started</a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <div class="relative isolate pt-14">
        <!-- Background decorative elements -->
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>

        <div class="py-24 sm:py-32 lg:pb-40">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-6xl animate-fade-in-up">
                        Business <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-purple-500">management</span>, simplified.
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-300 animate-fade-in-up delay-100">
                        One platform to manage projects, coordinate with vendors, and track your team's success. Stop switching apps and start shipping work.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6 animate-fade-in-up delay-200">
                        <a href="/register" class="rounded-full bg-indigo-600 px-8 py-3.5 text-sm font-semibold text-white shadow-xl hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all hover:scale-105 active:scale-95">Start for free</a>
                        <a href="#features" class="text-sm font-semibold leading-6 text-zinc-900 dark:text-white flex items-center gap-x-1 group">
                            Learn more <span aria-hidden="true" class="group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                </div>
                
                <!-- Hero Mockup (CSS Only for robustness) -->
                <div class="mt-16 flow-root sm:mt-24 animate-fade-in-up delay-300">
                    <div class="-m-2 rounded-xl bg-zinc-900/5 p-2 ring-1 ring-inset ring-zinc-900/10 dark:bg-white/5 dark:ring-white/10 lg:-m-4 lg:rounded-2xl lg:p-4">
                        <div class="relative rounded-md shadow-2xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 overflow-hidden aspect-[16/9] flex flex-col">
                            <!-- Fake Browser Header -->
                            <div class="h-10 bg-zinc-100 dark:bg-zinc-800 border-b border-zinc-200 dark:border-zinc-700 flex items-center px-4 space-x-2">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                                <div class="ml-4 h-6 w-96 bg-zinc-200 dark:bg-zinc-700 rounded-md opacity-50"></div>
                            </div>
                            <!-- Fake UI Body -->
                            <div class="flex-1 flex font-sans">
                                <!-- Sidebar -->
                                <div class="w-64 border-r border-zinc-200 dark:border-zinc-700 p-4 space-y-4 hidden md:block">
                                    <div class="h-8 w-3/4 bg-zinc-100 dark:bg-zinc-700 rounded animate-pulse"></div>
                                    <div class="space-y-2">
                                         <div class="h-4 w-full bg-zinc-50 dark:bg-zinc-700/50 rounded"></div>
                                         <div class="h-4 w-5/6 bg-zinc-50 dark:bg-zinc-700/50 rounded"></div>
                                         <div class="h-4 w-4/6 bg-zinc-50 dark:bg-zinc-700/50 rounded"></div>
                                    </div>
                                    <div class="pt-8 space-y-2">
                                         <div class="h-4 w-full bg-zinc-50 dark:bg-zinc-700/50 rounded"></div>
                                         <div class="h-4 w-5/6 bg-zinc-50 dark:bg-zinc-700/50 rounded"></div>
                                    </div>
                                </div>
                                <!-- Main Content -->
                                <div class="flex-1 p-6 md:p-8 bg-zinc-50 dark:bg-zinc-900/50">
                                    <div class="flex justify-between items-center mb-8">
                                        <div class="h-8 w-1/3 bg-zinc-200 dark:bg-zinc-700 rounded"></div>
                                        <div class="h-8 w-24 bg-indigo-600 rounded"></div>
                                    </div>
                                    <!-- Kanban/Grid -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <!-- Column 1 -->
                                        <div class="bg-zinc-100 dark:bg-zinc-800/80 rounded-lg p-4 space-y-4">
                                            <div class="h-4 w-24 bg-zinc-300 dark:bg-zinc-600 rounded mb-2"></div>
                                            <div class="bg-white dark:bg-zinc-700 p-3 rounded shadow-sm h-24"></div>
                                            <div class="bg-white dark:bg-zinc-700 p-3 rounded shadow-sm h-20"></div>
                                            <div class="bg-white dark:bg-zinc-700 p-3 rounded shadow-sm h-24"></div>
                                        </div>
                                         <!-- Column 2 -->
                                        <div class="bg-zinc-100 dark:bg-zinc-800/80 rounded-lg p-4 space-y-4">
                                            <div class="h-4 w-24 bg-zinc-300 dark:bg-zinc-600 rounded mb-2"></div>
                                            <div class="bg-white dark:bg-zinc-700 p-3 rounded shadow-sm h-32"></div>
                                            <div class="bg-white dark:bg-zinc-700 p-3 rounded shadow-sm h-16"></div>
                                        </div>
                                         <!-- Column 3 -->
                                        <div class="bg-zinc-100 dark:bg-zinc-800/80 rounded-lg p-4 space-y-4">
                                            <div class="h-4 w-24 bg-zinc-300 dark:bg-zinc-600 rounded mb-2"></div>
                                            <div class="bg-white dark:bg-zinc-700 p-3 rounded shadow-sm h-24"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decor -->
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
             <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
    </div>

    <!-- Feature Section (Alternating) -->
    <div id="features" class="overflow-hidden bg-white py-24 sm:py-32 dark:bg-zinc-900">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2 lg:items-center">
                <div class="lg:pr-8 lg:pt-4">
                    <div class="lg:max-w-lg">
                        <h2 class="text-base font-semibold leading-7 text-indigo-600 dark:text-indigo-400 uppercase tracking-wide">Optimization</h2>
                         <p class="mt-2 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">Work smarter, not harder</p>
                        <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                            TeamBoard brings all your operational data into one view. Track deliverables, monitor vendor performance, and approve invoices without email chains.
                        </p>
                        <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-zinc-600 dark:text-zinc-400">
                            <div class="relative pl-9">
                                <dt class="inline font-semibold text-zinc-900 dark:text-white">
                                    <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600 dark:text-indigo-400" viewBox="0 0 20 20" fill="currentColor"><path d="M4.632 3.533A2 2 0 016.577 2h6.846a2 2 0 011.945 1.533l1.976 8.234A3.489 3.489 0 0016 11.5H4c-.476 0-.93.095-1.344.267l1.976-8.234z" /><path fill-rule="evenodd" d="M4 13a2 2 0 100 4h12a2 2 0 100-4H4zm11.24 2a.75.75 0 01.75-.75H16a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75h-.01a.75.75 0 01-.75-.75V15zm-2.25-.75a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75H13a.75.75 0 00.75-.75V15a.75.75 0 00-.75-.75h-.01z" clip-rule="evenodd" /></svg>
                                    Automated Invoices.
                                </dt>
                                <dd class="inline">Generate invoices from approved timesheets instantly.</dd>
                            </div>
                            <div class="relative pl-9">
                                <dt class="inline font-semibold text-zinc-900 dark:text-white">
                                    <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600 dark:text-indigo-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 001 5.5V6h18v-.5A1.5 1.5 0 0017.5 4h-15zM19 8.5H1v6A1.5 1.5 0 002.5 16h15a1.5 1.5 0 001.5-1.5v-6zM3 13.25a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zm4.75-.75a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5h-1.5z" clip-rule="evenodd" /></svg>
                                    Cost Tracking.
                                </dt>
                                <dd class="inline">See where every dollar goes in real-time.</dd>
                            </div>
                        </dl>
                        <div class="mt-10">
                             <a href="#" class="text-sm font-semibold leading-6 text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">Explore modules <span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </div>
                 <!-- CSS-only Abstract Representation of "Work" -->
                 <div class="relative flex items-center justify-center p-8 lg:p-0">
                    <div class="w-full max-w-lg bg-white dark:bg-zinc-800 rounded-2xl shadow-2xl p-6 ring-1 ring-zinc-200 dark:ring-zinc-700">
                        <!-- Header -->
                        <div class="flex justify-between items-center mb-6">
                            <div class="space-y-1">
                                <div class="h-5 w-32 bg-zinc-200 dark:bg-zinc-600 rounded"></div>
                                <div class="h-3 w-20 bg-zinc-100 dark:bg-zinc-700 rounded"></div>
                            </div>
                            <div class="h-10 w-10 bg-indigo-100 dark:bg-indigo-900/50 rounded-full flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                        </div>
                        <!-- List Items -->
                        <div class="space-y-4">
                            <!-- Item 1 -->
                            <div class="flex items-center justify-between p-3 bg-zinc-50 dark:bg-zinc-700/30 rounded-lg border border-zinc-100 dark:border-zinc-700/50">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 bg-green-100 dark:bg-green-900/30 text-green-600 rounded-md flex items-center justify-center">
                                         <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    <div>
                                        <div class="h-3 w-24 bg-zinc-200 dark:bg-zinc-600 rounded mb-1"></div>
                                        <div class="h-2 w-16 bg-zinc-100 dark:bg-zinc-700 rounded"></div>
                                    </div>
                                </div>
                                <div class="h-3 w-12 bg-zinc-200 dark:bg-zinc-600 rounded"></div>
                            </div>
                             <!-- Item 2 -->
                             <div class="flex items-center justify-between p-3 bg-zinc-50 dark:bg-zinc-700/30 rounded-lg border border-zinc-100 dark:border-zinc-700/50">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 bg-amber-100 dark:bg-amber-900/30 text-amber-600 rounded-md flex items-center justify-center">
                                         <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <div>
                                        <div class="h-3 w-32 bg-zinc-200 dark:bg-zinc-600 rounded mb-1"></div>
                                        <div class="h-2 w-20 bg-zinc-100 dark:bg-zinc-700 rounded"></div>
                                    </div>
                                </div>
                                <div class="h-3 w-12 bg-zinc-200 dark:bg-zinc-600 rounded"></div>
                            </div>
                             <!-- Item 3 -->
                             <div class="flex items-center justify-between p-3 bg-zinc-50 dark:bg-zinc-700/30 rounded-lg border border-zinc-100 dark:border-zinc-700/50">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-md flex items-center justify-center">
                                         <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </div>
                                    <div>
                                        <div class="h-3 w-28 bg-zinc-200 dark:bg-zinc-600 rounded mb-1"></div>
                                        <div class="h-2 w-16 bg-zinc-100 dark:bg-zinc-700 rounded"></div>
                                    </div>
                                </div>
                                <div class="h-3 w-12 bg-zinc-200 dark:bg-zinc-600 rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bento Grid Section -->
    <div class="bg-zinc-50 py-24 sm:py-32 dark:bg-zinc-800/50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600 dark:text-indigo-400">Modular Power</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">Everything connected</p>
                <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                    A suite of modules designed to work together seamlessly.
                </p>
            </div>
             <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:grid-rows-2">
                    <!-- Project Card -->
                    <div class="relative lg:col-span-2 lg:row-span-2 rounded-3xl bg-white p-8 shadow-sm ring-1 ring-zinc-200 hover:shadow-lg transition-all duration-300 dark:bg-zinc-900 dark:ring-zinc-800 group overflow-hidden">
                         <div class="absolute top-0 right-0 -mr-6 -mt-6 h-24 w-24 rounded-full bg-indigo-50 blur-2xl opacity-50 dark:bg-indigo-900/30 group-hover:opacity-100 transition-opacity"></div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600 mb-6 text-white shadow-md group-hover:scale-110 transition-transform">
                             <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" /></svg>
                        </div>
                        <h3 class="text-xl font-bold leading-8 text-zinc-900 dark:text-white">Project Command Center</h3>
                         <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400 max-w-lg">
                            Visualize timelines, manage resources, and track progress across all your initiatives. The command center gives you the big picture and the small details.
                        </p>
                         <!-- Mock Project UI -->
                         <div class="mt-8 rounded-xl bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 h-64 p-4 relative overflow-hidden">
                             <div class="absolute top-4 left-4 right-4 h-6 bg-zinc-200 dark:bg-zinc-700 rounded-full w-1/3"></div>
                             <div class="absolute top-14 left-4 right-4 space-y-3">
                                 <div class="h-12 bg-white dark:bg-zinc-700/50 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-600 flex items-center px-4 gap-4">
                                     <div class="h-2 w-24 bg-indigo-400 rounded-full"></div>
                                     <div class="h-2 w-full bg-zinc-100 dark:bg-zinc-600 rounded-full overflow-hidden"><div class="h-full w-2/3 bg-indigo-500"></div></div>
                                 </div>
                                  <div class="h-12 bg-white dark:bg-zinc-700/50 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-600 flex items-center px-4 gap-4 ml-6">
                                     <div class="h-2 w-20 bg-emerald-400 rounded-full"></div>
                                     <div class="h-2 w-full bg-zinc-100 dark:bg-zinc-600 rounded-full overflow-hidden"><div class="h-full w-full bg-emerald-500"></div></div>
                                 </div>
                                  <div class="h-12 bg-white dark:bg-zinc-700/50 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-600 flex items-center px-4 gap-4">
                                     <div class="h-2 w-28 bg-amber-400 rounded-full"></div>
                                     <div class="h-2 w-full bg-zinc-100 dark:bg-zinc-600 rounded-full overflow-hidden"><div class="h-full w-1/4 bg-amber-500"></div></div>
                                 </div>
                             </div>
                         </div>
                    </div>
                     <!-- Vendor Card -->
                    <div class="relative rounded-3xl bg-white p-8 shadow-sm ring-1 ring-zinc-200 hover:shadow-md transition-all duration-300 dark:bg-zinc-900 dark:ring-zinc-800">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600 mb-6 text-white">
                             <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <h3 class="text-lg font-bold leading-8 text-zinc-900 dark:text-white">Vendor Portal</h3>
                        <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                            Streamlined onboarding and management for all external partners.
                        </p>
                    </div>
                     <!-- HR Card -->
                    <div class="relative rounded-3xl bg-white p-8 shadow-sm ring-1 ring-zinc-200 hover:shadow-md transition-all duration-300 dark:bg-zinc-900 dark:ring-zinc-800">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600 mb-6 text-white">
                             <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <h3 class="text-lg font-bold leading-8 text-zinc-900 dark:text-white">Team & HR</h3>
                        <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                            Manage profiles, skills, and certifications in one secure vault.
                        </p>
                    </div>
                </div>
             </div>
        </div>
    </div>
    
    <!-- Pricing Section -->
    <div id="pricing" class="bg-white py-24 sm:py-32 dark:bg-zinc-900">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
             <div class="mx-auto max-w-2xl sm:text-center">
                <h2 class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">Pricing</h2>
                <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">Transparent costs. No hidden fees.</p>
            </div>
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-y-16 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                 <!-- Starter -->
                <div class="flex flex-col justify-between rounded-3xl bg-white p-8 ring-1 ring-zinc-200 xl:p-10 dark:bg-zinc-900 dark:ring-zinc-800 hover:ring-indigo-600/50 transition-all cursor-pointer">
                    <div>
                        <h3 class="text-lg font-semibold leading-8 text-zinc-900 dark:text-white">Starter</h3>
                        <p class="mt-4 text-sm leading-6 text-zinc-600 dark:text-zinc-400">Essential tools for small teams.</p>
                        <p class="mt-6 flex items-baseline gap-x-1">
                            <span class="text-4xl font-bold tracking-tight text-zinc-900 dark:text-white">$29</span>
                            <span class="text-sm font-semibold leading-6 text-zinc-600 dark:text-zinc-400">/mo</span>
                        </p>
                        <ul class="mt-8 space-y-3 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                            <li class="flex gap-x-3"><span class="text-indigo-600">✓</span> 5 Users</li>
                            <li class="flex gap-x-3"><span class="text-indigo-600">✓</span> Basic Projects</li>
                        </ul>
                    </div>
                    <a href="/register?plan=starter" class="mt-8 block rounded-md bg-indigo-50 px-3 py-2 text-center text-sm font-semibold leading-6 text-indigo-600 hover:bg-indigo-100 dark:bg-indigo-900/20 dark:text-indigo-400 transition-colors">Start Trial</a>
                </div>
                 <!-- Growth (Highlighted) -->
                <div class="flex flex-col justify-between rounded-3xl bg-zinc-900 p-8 ring-1 ring-zinc-900 xl:p-10 dark:bg-zinc-800 dark:ring-zinc-700 shadow-xl scale-105 z-10">
                    <div>
                         <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold leading-8 text-white">Growth</h3>
                             <span class="rounded-full bg-indigo-500/10 px-2.5 py-1 text-xs font-semibold leading-5 text-indigo-400 ring-1 ring-inset ring-indigo-500/20">Popular</span>
                         </div>
                        <p class="mt-4 text-sm leading-6 text-zinc-300">Scale your operations securely.</p>
                        <p class="mt-6 flex items-baseline gap-x-1">
                            <span class="text-4xl font-bold tracking-tight text-white">$79</span>
                            <span class="text-sm font-semibold leading-6 text-zinc-300">/mo</span>
                        </p>
                        <ul class="mt-8 space-y-3 text-sm leading-6 text-zinc-300">
                            <li class="flex gap-x-3"><span class="text-indigo-400">✓</span> 20 Users</li>
                            <li class="flex gap-x-3"><span class="text-indigo-400">✓</span> Vendor Portal</li>
                            <li class="flex gap-x-3"><span class="text-indigo-400">✓</span> Financials</li>
                        </ul>
                    </div>
                    <a href="/register?plan=growth" class="mt-8 block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold leading-6 text-white hover:bg-indigo-500 shadow-md transition-colors">Get Started</a>
                </div>
                 <!-- Enterprise -->
                <div class="flex flex-col justify-between rounded-3xl bg-white p-8 ring-1 ring-zinc-200 xl:p-10 dark:bg-zinc-900 dark:ring-zinc-800 hover:ring-indigo-600/50 transition-all cursor-pointer">
                    <div>
                        <h3 class="text-lg font-semibold leading-8 text-zinc-900 dark:text-white">Enterprise</h3>
                        <p class="mt-4 text-sm leading-6 text-zinc-600 dark:text-zinc-400">Custom solutions for big orgs.</p>
                        <p class="mt-6 flex items-baseline gap-x-1">
                            <span class="text-4xl font-bold tracking-tight text-zinc-900 dark:text-white">$199</span>
                            <span class="text-sm font-semibold leading-6 text-zinc-600 dark:text-zinc-400">/mo</span>
                        </p>
                        <ul class="mt-8 space-y-3 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                            <li class="flex gap-x-3"><span class="text-indigo-600">✓</span> Unlimited Users</li>
                            <li class="flex gap-x-3"><span class="text-indigo-600">✓</span> 24/7 Support</li>
                        </ul>
                    </div>
                    <a href="/contact" class="mt-8 block rounded-md bg-indigo-50 px-3 py-2 text-center text-sm font-semibold leading-6 text-indigo-600 hover:bg-indigo-100 dark:bg-indigo-900/20 dark:text-indigo-400 transition-colors">Contact Sales</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="bg-white py-24 sm:py-32 dark:bg-zinc-900">
         <div class="mx-auto max-w-7xl px-6 lg:px-8">
             <div class="mx-auto max-w-2xl bg-zinc-50 dark:bg-zinc-800/50 rounded-3xl p-8 sm:p-16 ring-1 ring-zinc-200 dark:ring-zinc-700">
                  <div class="text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">Join the waiting list</h2>
                    <p class="mt-4 text-lg leading-8 text-zinc-600 dark:text-zinc-400">Get early access to new features.</p>
                  </div>
                 <form class="mt-10 max-w-md mx-auto">
                     <div class="flex gap-x-4">
                         <label for="email-address" class="sr-only">Email address</label>
                         <input id="email-address" name="email" type="email" autocomplete="email" required class="min-w-0 flex-auto rounded-md border-0 bg-white dark:bg-zinc-700 px-3.5 py-2 text-zinc-900 dark:text-white shadow-sm ring-1 ring-inset ring-zinc-300 dark:ring-zinc-600 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Enter your email">
                         <button type="submit" class="flex-none rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Subscribe</button>
                     </div>
                 </form>
             </div>
         </div>
    </div>

    <!-- Simple Footer -->
    <footer class="bg-white dark:bg-zinc-900 border-t border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
            <div class="mt-8 md:order-1 md:mt-0">
                <p class="text-center text-xs leading-5 text-zinc-500 dark:text-zinc-400">&copy; 2026 TeamBoard Inc. All rights reserved.</p>
            </div>
             <div class="flex justify-center space-x-6 md:order-2">
                <a href="#" class="text-zinc-400 hover:text-zinc-500">
                    <span class="sr-only">GitHub</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                </a>
            </div>
        </div>
    </footer>
</div>