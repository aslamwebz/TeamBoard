<div class="bg-white dark:bg-zinc-950 font-sans selection:bg-indigo-500 selection:text-white"
     x-data="{ 
         theme: localStorage.getItem('theme') || 'system',
         scrolled: false, 
         activeFeature: 0,
         init() {
            this.applyTheme(this.theme);
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 20;
            });
         },
         applyTheme(val) {
            this.theme = val;
            localStorage.setItem('theme', val);
            if (val === 'dark' || (val === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
         },
         toggleTheme() {
            const modes = ['light', 'dark', 'system'];
            const next = modes[(modes.indexOf(this.theme) + 1) % modes.length];
            this.applyTheme(next);
         }
     }">
    
    <!-- Custom Scroll Styles -->
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        .fade-mask {
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }
        
        [x-cloak] { display: none !important; }
    </style>

    <!-- Sticky Header (Glassmorphism) -->
    <header class="fixed inset-x-0 top-0 z-50 transition-all duration-500 border-b border-transparent" 
            :class="{ 'bg-white/80 dark:bg-zinc-950/80 backdrop-blur-xl border-zinc-200/50 dark:border-zinc-800/50': scrolled }">
        <nav class="flex items-center justify-between p-6 lg:px-8 max-w-7xl mx-auto" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5 flex items-center gap-x-2 group">
                    <div class="h-8 w-8 rounded-lg bg-indigo-600 flex items-center justify-center transition-transform group-hover:scale-110 group-hover:rotate-3 shadow-lg shadow-indigo-500/30">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-zinc-900 dark:text-white">TeamBoard</span>
                </a>
            </div>
            <div class="hidden lg:flex lg:gap-x-8">
                <a href="#customers" class="text-sm font-semibold leading-6 text-zinc-900 dark:text-zinc-100 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Customers</a>
                <a href="#pricing" class="text-sm font-semibold leading-6 text-zinc-900 dark:text-zinc-100 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Pricing</a>
                <a href="#company" class="text-sm font-semibold leading-6 text-zinc-900 dark:text-zinc-100 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Company</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end lg:gap-x-4 items-center">
                 <!-- Theme Toggle -->
                <button
                    @click="toggleTheme()"
                    class="relative p-2 text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-200 focus:outline-none transition-colors duration-200"
                    title="Toggle theme">
                    <svg x-show="theme === 'light'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg x-show="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="theme === 'system'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </button>

                <div class="h-6 w-px bg-zinc-200 dark:bg-zinc-800 mx-2"></div>

                <a href="/login" class="text-sm font-semibold leading-6 text-zinc-900 dark:text-white my-auto px-2 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Log in</a>
                <a href="/register" class="rounded-full bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 hover:bg-indigo-500 hover:shadow-indigo-500/40 hover:-translate-y-0.5 transition-all duration-300">Get started</a>
            </div>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <div class="relative isolate pt-32 pb-24 sm:pt-40 sm:pb-32 overflow-hidden">
             <!-- Abstract Background -->
             <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-indigo-500 to-purple-500 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
            </div>

            <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
                <!-- Badge -->
                <div class="inline-flex items-center rounded-full border border-indigo-200 dark:border-indigo-800 bg-indigo-50 dark:bg-indigo-950/30 px-3 py-1 text-sm font-medium text-indigo-600 dark:text-indigo-300 mb-8 backdrop-blur-sm animate-fade-in-up">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600 mr-2 animate-pulse"></span>
                    Now with AI-Powered Insights
                </div>
                
                <h1 class="mx-auto max-w-5xl text-5xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-7xl animate-fade-in-up delay-100 leading-[1.1]">
                    Orchestrate your entire <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">business ecosystem.</span>
                </h1>
                
                <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-zinc-600 dark:text-zinc-400 animate-fade-in-up delay-200">
                    Connect projects, vendors, and teams in one unified operating system. 
                    Stop managing chaos and start managing value.
                </p>

                <div class="mt-10 flex items-center justify-center gap-x-6 animate-fade-in-up delay-300">
                    <a href="/register" class="rounded-full bg-zinc-900 dark:bg-white px-8 py-3.5 text-sm font-semibold text-white dark:text-zinc-900 shadow-xl hover:bg-zinc-800 dark:hover:bg-zinc-200 hover:-translate-y-1 transition-all duration-300">Start free trial</a>
                    <a href="#" class="text-sm font-semibold leading-6 text-zinc-900 dark:text-white hover:text-indigo-600 transition flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" /></svg>
                        Watch the film <span class="text-zinc-400 ml-1">2:14</span>
                    </a>
                </div>

                <!-- Hero Visual (Parallax/Tilt effect) -->
                <div class="mt-20 flow-root sm:mt-24 perspective-1000 animate-fade-in-up delay-300" 
                     x-data="{ x: 0, y: 0 }" 
                     @mousemove.window="x = ($event.clientX - window.innerWidth / 2) / 50; y = ($event.clientY - window.innerHeight / 2) / 50"
                     :style="`transform: rotateX(${-y}deg) rotateY(${x}deg)`">
                    <div class="-m-2 rounded-xl bg-zinc-900/5 p-2 ring-1 ring-inset ring-zinc-900/10 dark:bg-white/5 dark:ring-white/10 lg:-m-4 lg:rounded-2xl lg:p-4 transition-transform duration-75 ease-out">
                         <div class="relative rounded-lg shadow-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden aspect-[16/9] sm:aspect-[21/9] flex flex-col group">
                             <!-- Header -->
                             <div class="h-12 border-b border-zinc-200 dark:border-zinc-800 flex items-center px-4 justify-between bg-white dark:bg-zinc-900">
                                 <div class="flex items-center gap-2">
                                     <div class="h-3 w-3 rounded-full bg-red-400"></div>
                                     <div class="h-3 w-3 rounded-full bg-amber-400"></div>
                                     <div class="h-3 w-3 rounded-full bg-green-400"></div>
                                 </div>
                                 <div class="h-6 w-1/3 bg-zinc-100 dark:bg-zinc-800 rounded-md mx-auto flex items-center justify-center text-xs text-zinc-400 font-mono">teamboard.app/dashboard</div>
                                 <div class="flex gap-3">
                                     <div class="h-8 w-8 rounded-full bg-zinc-200 dark:bg-zinc-800"></div>
                                 </div>
                             </div>
                             <!-- Body -->
                             <div class="flex-1 flex overflow-hidden">
                                 <!-- Sidebar -->
                                 <div class="w-64 border-r border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900/50 p-4 hidden md:block">
                                     <div class="space-y-4">
                                         <div class="h-8 w-full bg-zinc-200 dark:bg-zinc-800 rounded-lg"></div>
                                         <div class="space-y-2 pt-4">
                                            <div class="h-4 w-full bg-zinc-100 dark:bg-zinc-800/50 rounded-md"></div>
                                            <div class="h-4 w-3/4 bg-zinc-100 dark:bg-zinc-800/50 rounded-md"></div>
                                            <div class="h-4 w-5/6 bg-zinc-100 dark:bg-zinc-800/50 rounded-md"></div>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- Content -->
                                 <div class="flex-1 p-8 bg-white dark:bg-zinc-950 relative overflow-hidden">
                                     <div class="absolute inset-0 bg-gradient-to-tr from-indigo-50/50 to-purple-50/50 dark:from-indigo-900/10 dark:to-purple-900/10 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                                     <!-- Dashboard Grid -->
                                     <div class="grid grid-cols-3 gap-6 h-full relative z-10">
                                         <!-- Card 1 -->
                                         <div class="col-span-2 bg-gradient-to-br from-white to-zinc-50 dark:from-zinc-900 dark:to-zinc-900/50 rounded-xl p-6 border border-zinc-100 dark:border-zinc-800 shadow-sm">
                                             <div class="flex justify-between items-center mb-6">
                                                 <div class="h-5 w-32 bg-zinc-200 dark:bg-zinc-800 rounded"></div>
                                                 <div class="h-8 w-24 bg-indigo-600 rounded-lg shadow-lg shadow-indigo-500/20"></div>
                                             </div>
                                             <div class="space-y-4">
                                                 <div class="h-24 w-full bg-zinc-100 dark:bg-zinc-800 rounded-lg animate-pulse"></div>
                                                 <div class="h-24 w-full bg-zinc-100 dark:bg-zinc-800 rounded-lg animate-pulse delay-75"></div>
                                             </div>
                                         </div>
                                          <!-- Card 2 -->
                                         <div class="bg-gradient-to-br from-white to-zinc-50 dark:from-zinc-900 dark:to-zinc-900/50 rounded-xl p-6 border border-zinc-100 dark:border-zinc-800 shadow-sm flex flex-col items-center justify-center text-center">
                                             <div class="h-24 w-24 rounded-full border-4 border-emerald-500/20 border-t-emerald-500 mb-4"></div>
                                              <div class="h-4 w-16 bg-zinc-200 dark:bg-zinc-700 rounded mb-2"></div>
                                              <div class="h-8 w-24 bg-zinc-100 dark:bg-zinc-800 rounded"></div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
            
             <!-- Trusted By Marquee -->
            <div class="mt-24 sm:mt-32 fade-mask relative" id="customers">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                     <div class="mt-10 overflow-hidden flex gap-12 select-none" style="mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);">
                         <div class="flex gap-12 min-w-full animate-[marquee_30s_linear_infinite] items-center">
                             <!-- Transistor -->
                             <svg class="h-12 w-auto opacity-60 hover:opacity-100 transition-all duration-500 text-zinc-900 dark:text-white" viewBox="0 0 158 48" fill="currentColor">
                                 <path d="M0 24.3c0-2.6 2.1-4.7 4.7-4.7h9.5c8.3 0 11.8 5.7 13.5 11.2l.2.8c1 3.2 1.4 4.5 3.3 4.5 1.8 0 2.3-1.3 3.3-4.5l.2-.8C36.4 25.3 40 19.6 48.3 19.6H153.3c2.6 0 4.7 2.1 4.7 4.7s-2.1 4.7-4.7 4.7H48.3c-1.8 0-2.3 1.3-3.3 4.5l-.2.8c-1.7 5.5-5.2 11.2-13.5 11.2-8.3 0-11.8-5.7-13.5-11.2l-.2-.8c-1-3.2-1.4-4.5-3.3-4.5-1.8 0-2.3 1.3-3.3 4.5l-.2.8c-1.7 5.5-5.2 11.2-13.5 11.2H4.7C2.1 40.3 0 38.2 0 35.6v-11.3z"/>
                             </svg>
                             <!-- Reform -->
                             <svg class="h-10 w-auto opacity-60 hover:opacity-100 transition-all duration-500 text-zinc-900 dark:text-white" viewBox="0 0 148 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M51.921 16.518C50.29 11.378 45.47 7.647 39.805 7.647c-7.394 0-13.388 6.36-13.388 14.205 0 7.846 5.994 14.206 13.388 14.206 5.665 0 10.485-3.731 12.116-8.871H39.805c-2.358 0-4.27-2.062-4.27-4.606 0-2.544 1.912-4.606 4.27-4.606h12.116z" fill="currentColor"/>
                                 <path d="M14.588 7.647h-5.47v28.412h5.47V25.34c0-3.376 2.585-6.115 5.774-6.115 1.055 0 1.986.302 2.76.817V13.88c-.966-.525-2.071-.823-3.242-.823-3.41 0-6.172 3.018-6.172 6.74v-6.693h.88zm81.47-5.59v5.59h-5.47v17.693 c0 3.377-2.585 6.115-5.773 6.115-1.055 0-1.987-.302-2.761-.817v6.16c.966.526 2.072.824 3.242.824 5.95 0 10.772-5.266 10.772-11.765V2.058h-.01zm29.824 34.001h5.47V7.645h-5.47v28.411z" fill="currentColor"/>
                             </svg>
                             <!-- Tuple -->
                             <svg class="h-10 w-auto opacity-60 hover:opacity-100 transition-all duration-500 text-zinc-900 dark:text-white" viewBox="0 0 138 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M43.987 11.78a6.565 6.565 0 00-9.284 0l-5.656 5.656-5.657-5.657a6.565 6.565 0 10-9.284 9.285l5.657 5.656-5.657 5.657a6.565 6.565 0 009.284 9.284l5.657-5.656 5.656 5.657a6.565 6.565 0 009.284-9.284l-5.657-5.657 5.657-5.657a6.563 6.563 0 000-9.284z" fill="currentColor"/>
                             </svg>
                             <!-- SavvyCal -->
                             <svg class="h-10 w-auto opacity-60 hover:opacity-100 transition-all duration-500 text-zinc-900 dark:text-white" viewBox="0 0 168 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M14.588 22.059c0-2.31 1.76-4.14 4.076-4.382l.06-.006H33.09v-5.47H18.724a9.853 9.853 0 00-6.726 17.065l13.623 13.064c1.155 1.108.971 3.037-.48 3.037l-15.688-.002v5.47h15.688c5.44 0 9.853-4.413 9.853-9.853 0-2.31-1.76-4.14-4.076-4.382l-.06-.006H14.588v-14.54z" fill="currentColor"/>
                             </svg>
                             <!-- Statamic -->
                             <svg class="h-10 w-auto opacity-60 hover:opacity-100 transition-all duration-500 text-zinc-900 dark:text-white" viewBox="0 0 178 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M21.529 14.204v5.47h-11.47v17.412h11.47v5.47H4.588V14.204h16.941zM66.412 14.204v5.47h-6.794v23.161h-5.47V19.674h-6.795v-5.47h19.059zm43.585 0v28.632h-5.47v-2.736c-1.636 2.01-4.116 3.283-6.852 3.283-5.264 0-9.529-4.72-9.529-10.543 0-5.823 4.265-10.543 9.53-10.543 2.735 0 5.215 1.272 6.852 3.283v-11.376h5.47zm32.176 9.846v5.47h-6.794v13.316h-5.47V29.52h-6.794v-5.47h19.058zm-72.298 2.057c-2.39-1.32-5.424-1.32-7.815 0l2.735 4.738c.846-.467 1.918-.467 2.765 0 .846.467 1.382 1.396 1.382 2.395v1.376h-5.47c-4.529 0-8.235 4.1-8.235 9.11 0 5.013 3.706 9.112 8.235 9.112 2.738 0 5.22-1.275 6.853-3.287v2.737h5.47v-16.78c0-4.634-2.486-8.234-5.92-9.401zm72.71 8.812c-.848-.467-1.383-1.396-1.383-2.395 0-1 1-1.928 2.4-1.928h5.835v4.92h-6.852v-.6zm-41.53 5.47v-3.826h3.647c1.37 0 2.403-.681 2.403-1.85 0-.585-.256-1.127-.706-1.493-1.077-.872-3.14-.381-3.647 1.26l-4.706-1.926c1.177-3.687 5.727-4.225 8.353-2.096 1.706 1.384 2.176 3.195 2.176 4.67 0 3.32-2.912 4.102-4.144 4.19.827.604 1.367 1.406 1.367 2.308 0 1.09-.765 2.023-1.747 2.48l1.747 3.03h5.753l-3.226-5.594c1.915-.656 3.226-2.528 3.226-4.659h-5.47c0 1.288-1.559 1.83-2.618 1.83-1.059 0-2.617-.466-2.617-1.755 0-.742.508-1.369 1.109-1.637l2.1-.01v5.278h-.002z" fill="currentColor"/>
                             </svg>
                             <!-- Repeat for loop -->
                             <svg class="h-12 w-auto opacity-60 hover:opacity-100 transition-all duration-500 text-zinc-900 dark:text-white" viewBox="0 0 158 48" fill="currentColor">
                                 <path d="M0 24.3c0-2.6 2.1-4.7 4.7-4.7h9.5c8.3 0 11.8 5.7 13.5 11.2l.2.8c1 3.2 1.4 4.5 3.3 4.5 1.8 0 2.3-1.3 3.3-4.5l.2-.8C36.4 25.3 40 19.6 48.3 19.6H153.3c2.6 0 4.7 2.1 4.7 4.7s-2.1 4.7-4.7 4.7H48.3c-1.8 0-2.3 1.3-3.3 4.5l-.2.8c-1.7 5.5-5.2 11.2-13.5 11.2-8.3 0-11.8-5.7-13.5-11.2l-.2-.8c-1-3.2-1.4-4.5-3.3-4.5-1.8 0-2.3 1.3-3.3 4.5l-.2.8c-1.7 5.5-5.2 11.2-13.5 11.2H4.7C2.1 40.3 0 38.2 0 35.6v-11.3z"/>
                             </svg>
                             <svg class="h-10 w-auto opacity-60 hover:opacity-100 transition-all duration-500 text-zinc-900 dark:text-white" viewBox="0 0 148 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M51.921 16.518C50.29 11.378 45.47 7.647 39.805 7.647c-7.394 0-13.388 6.36-13.388 14.205 0 7.846 5.994 14.206 13.388 14.206 5.665 0 10.485-3.731 12.116-8.871H39.805c-2.358 0-4.27-2.062-4.27-4.606 0-2.544 1.912-4.606 4.27-4.606h12.116z" fill="currentColor"/>
                                <path d="M14.588 7.647h-5.47v28.412h5.47V25.34c0-3.376 2.585-6.115 5.774-6.115 1.055 0 1.986.302 2.76.817V13.88c-.966-.525-2.071-.823-3.242-.823-3.41 0-6.172 3.018-6.172 6.74v-6.693h.88zm81.47-5.59v5.59h-5.47v17.693 c0 3.377-2.585 6.115-5.773 6.115-1.055 0-1.987-.302-2.761-.817v6.16c.966.526 2.072.824 3.242.824 5.95 0 10.772-5.266 10.772-11.765V2.058h-.01zm29.824 34.001h5.47V7.645h-5.47v28.411z" fill="currentColor"/>
                            </svg>
                         </div>
                     </div>
                </div>
            </div>
        </div>

        <!-- Scroll-Telling Section -->
        <div class="bg-zinc-50 dark:bg-zinc-900 py-24 sm:py-32 relative overflow-hidden">
             <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05]" style="background-image: radial-gradient(#6366f1 1px, transparent 1px); background-size: 32px 32px;"></div>

             <div class="mx-auto max-w-7xl px-6 lg:px-8 relative">
                 <div class="mx-auto max-w-2xl lg:text-center mb-16">
                    <h2 class="text-base font-semibold leading-7 text-indigo-600 dark:text-indigo-400">Streamlined Workflow</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-5xl">From request to revenue</p>
                </div>
                
                <div class="lg:flex gap-16 items-start relative">
                    <!-- Sticky Text Sidebar -->
                    <div class="lg:w-1/3 lg:sticky lg:top-32 space-y-8">
                         <!-- Step 1 -->
                         <div class="group cursor-pointer p-6 rounded-2xl transition-all duration-300" 
                              @mouseenter="activeFeature = 0" 
                              :class="{ 'bg-white dark:bg-zinc-800 shadow-xl ring-1 ring-zinc-900/5 dark:ring-white/10 scale-105': activeFeature === 0, 'opacity-60 hover:opacity-100': activeFeature !== 0 }">
                             <div class="flex items-center gap-4 mb-4">
                                 <div class="h-10 w-10 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold">1</div>
                                 <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Ingest</h3>
                             </div>
                             <p class="text-zinc-600 dark:text-zinc-400">Capture requests from email, Slack, and forms automatically. Centralize demand in one inbox.</p>
                         </div>

                         <!-- Step 2 -->
                         <div class="group cursor-pointer p-6 rounded-2xl transition-all duration-300" 
                              @mouseenter="activeFeature = 1" 
                              :class="{ 'bg-white dark:bg-zinc-800 shadow-xl ring-1 ring-zinc-900/5 dark:ring-white/10 scale-105': activeFeature === 1, 'opacity-60 hover:opacity-100': activeFeature !== 1 }">
                             <div class="flex items-center gap-4 mb-4">
                                 <div class="h-10 w-10 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold">2</div>
                                 <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Plan</h3>
                             </div>
                             <p class="text-zinc-600 dark:text-zinc-400">Assign resources, set dependencies, and visualize timelines with drag-and-drop Gantt charts.</p>
                         </div>

                         <!-- Step 3 -->
                         <div class="group cursor-pointer p-6 rounded-2xl transition-all duration-300" 
                              @mouseenter="activeFeature = 2" 
                              :class="{ 'bg-white dark:bg-zinc-800 shadow-xl ring-1 ring-zinc-900/5 dark:ring-white/10 scale-105': activeFeature === 2, 'opacity-60 hover:opacity-100': activeFeature !== 2 }">
                             <div class="flex items-center gap-4 mb-4">
                                 <div class="h-10 w-10 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold">3</div>
                                 <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Settle</h3>
                             </div>
                             <p class="text-zinc-600 dark:text-zinc-400">Automate invoicing and payments upon milestone completion. Keep vendors happy and paid.</p>
                         </div>
                    </div>

                    <!-- Dynamic Visual Side -->
                    <div class="lg:w-2/3 mt-12 lg:mt-0 sticky top-32">
                         <div class="aspect-[4/3] w-full rounded-3xl bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 shadow-2xl overflow-hidden relative" x-cloak>
                             
                             <!-- Visual 1: Ingest -->
                             <div x-show="activeFeature === 0" 
                                  x-transition:enter="transition ease-out duration-500 transform"
                                  x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                                  x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                  x-transition:leave="transition ease-in duration-300 transform"
                                  x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                  x-transition:leave-end="opacity-0 scale-95 -translate-y-4"
                                  class="absolute inset-0 p-12 flex items-center justify-center bg-zinc-50/50 dark:bg-zinc-900/50">
                                  <div class="w-full max-w-lg space-y-6">
                                      <!-- Message Item -->
                                      <div class="bg-white dark:bg-zinc-800 p-6 rounded-2xl shadow-lg border border-zinc-100 dark:border-zinc-700 flex gap-4 items-start transform translate-x-8 opacity-80 scale-95">
                                          <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xl">📧</div>
                                          <div class="flex-1">
                                              <div class="flex justify-between items-center mb-2">
                                                  <div class="h-4 w-32 bg-zinc-200 dark:bg-zinc-600 rounded"></div>
                                                  <div class="h-3 w-12 bg-zinc-100 dark:bg-zinc-700 rounded"></div>
                                              </div>
                                              <div class="h-3 w-full bg-zinc-100 dark:bg-zinc-700 rounded mb-2"></div>
                                              <div class="h-3 w-4/6 bg-zinc-100 dark:bg-zinc-700 rounded"></div>
                                          </div>
                                      </div>
                                      <!-- Active Message Item -->
                                      <div class="bg-white dark:bg-zinc-800 p-6 rounded-2xl shadow-xl border-l-4 border-l-indigo-500 border-y border-r border-zinc-100 dark:border-zinc-700 flex gap-4 items-start transform scale-105 z-10 relative">
                                          <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl">⚡</div>
                                          <div class="flex-1">
                                              <div class="flex justify-between items-center mb-2">
                                                  <div class="h-4 w-40 bg-zinc-900 dark:bg-zinc-400 rounded"></div>
                                                  <div class="px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold">NEW</div>
                                              </div>
                                              <div class="h-3 w-full bg-zinc-200 dark:bg-zinc-600 rounded mb-2"></div>
                                              <div class="h-3 w-5/6 bg-zinc-200 dark:bg-zinc-600 rounded"></div>
                                              <div class="mt-4 flex gap-2">
                                                  <div class="px-3 py-1 rounded-md bg-zinc-100 dark:bg-zinc-700 text-xs font-semibold">Project A</div>
                                                  <div class="px-3 py-1 rounded-md bg-zinc-100 dark:bg-zinc-700 text-xs font-semibold">Urgent</div>
                                              </div>
                                          </div>
                                      </div>
                                       <!-- Message Item -->
                                      <div class="bg-white dark:bg-zinc-800 p-6 rounded-2xl shadow-lg border border-zinc-100 dark:border-zinc-700 flex gap-4 items-start transform translate-x-4 opacity-80 scale-95">
                                          <div class="h-10 w-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xl">💬</div>
                                          <div class="flex-1">
                                              <div class="flex justify-between items-center mb-2">
                                                  <div class="h-4 w-24 bg-zinc-200 dark:bg-zinc-600 rounded"></div>
                                                  <div class="h-3 w-12 bg-zinc-100 dark:bg-zinc-700 rounded"></div>
                                              </div>
                                              <div class="h-3 w-5/6 bg-zinc-100 dark:bg-zinc-700 rounded"></div>
                                          </div>
                                      </div>
                                  </div>
                             </div>
                              <!-- Visual 2: Plan -->
                             <div x-show="activeFeature === 1"
                                  x-transition:enter="transition ease-out duration-500 transform"
                                  x-transition:enter-start="opacity-0 translate-y-8"
                                  x-transition:enter-end="opacity-100 translate-y-0"
                                  x-transition:leave="transition ease-in duration-300 transform"
                                  x-transition:leave-start="opacity-100 translate-y-0"
                                  x-transition:leave-end="opacity-0 -translate-y-8"
                                  class="absolute inset-0 p-8 flex flex-col justify-center bg-[#f8fafc] dark:bg-[#09090b]">
                                   <!-- Complex Gantt UI -->
                                   <div class="w-full bg-white dark:bg-zinc-900 rounded-xl shadow-xl border border-zinc-200 dark:border-zinc-800 overflow-hidden">
                                       <div class="h-10 border-b border-zinc-200 dark:border-zinc-800 flex items-center px-4 bg-zinc-50 dark:bg-zinc-800/50">
                                           <div class="flex gap-4 text-xs font-semibold text-zinc-400">
                                               <span>NOV</span>
                                               <span>DEC</span>
                                               <span>JAN</span>
                                               <span>FEB</span>
                                           </div>
                                       </div>
                                       <div class="p-4 space-y-6 relative">
                                           <!-- Grid Lines -->
                                           <div class="absolute inset-0 flex justify-between px-4 pointer-events-none opacity-10">
                                               <div class="w-px h-full bg-zinc-900"></div><div class="w-px h-full bg-zinc-900"></div><div class="w-px h-full bg-zinc-900"></div><div class="w-px h-full bg-zinc-900"></div>
                                           </div>

                                           <div class="flex items-center gap-4 group">
                                               <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-xs font-bold text-indigo-700">EM</div>
                                               <div class="flex-1 h-2 bg-zinc-100 dark:bg-zinc-800 rounded-full relative overflow-hidden">
                                                   <div class="absolute inset-y-0 left-0 w-2/3 bg-indigo-500 rounded-full group-hover:w-3/4 transition-all duration-700"></div>
                                               </div>
                                           </div>
                                           <div class="flex items-center gap-4 pl-8 group">
                                               <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-xs font-bold text-purple-700">JD</div>
                                               <div class="flex-1 h-2 bg-zinc-100 dark:bg-zinc-800 rounded-full relative overflow-hidden">
                                                   <div class="absolute inset-y-0 left-1/3 w-1/3 bg-purple-500 rounded-full group-hover:left-1/4 group-hover:w-1/2 transition-all duration-700"></div>
                                               </div>
                                           </div>
                                            <div class="flex items-center gap-4 pl-4 group">
                                               <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-xs font-bold text-emerald-700">AS</div>
                                               <div class="flex-1 h-2 bg-zinc-100 dark:bg-zinc-800 rounded-full relative overflow-hidden">
                                                   <div class="absolute inset-y-0 right-0 w-1/4 bg-emerald-500 rounded-full group-hover:w-1/2 transition-all duration-700"></div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                             </div>
                         </div>
                    </div>
                </div>
             </div>
        </div>

        <!-- Customer Stories (Spotlight) -->
        <div class="bg-zinc-900 dark:bg-black py-24 sm:py-32 relative overflow-hidden">
             <!-- Decor -->
             <div class="absolute top-0 right-0 -mr-24 -mt-24 w-96 h-96 rounded-full bg-indigo-600 blur-[128px] opacity-20"></div>
             <div class="absolute bottom-0 left-0 -ml-24 -mb-24 w-96 h-96 rounded-full bg-purple-600 blur-[128px] opacity-20"></div>

             <div class="mx-auto max-w-7xl px-6 lg:px-8 relative z-10">
                 <h2 class="text-3xl font-bold tracking-tight text-white mb-16">Customer Spotlight</h2>
                 
                 <div class="grid lg:grid-cols-2 gap-12 items-center rounded-3xl bg-white/5 border border-white/10 p-8 lg:p-12 backdrop-blur-sm hover:bg-white/10 transition-colors cursor-pointer group">
                     <div>
                         <svg class="h-8 mb-8 text-white" viewBox="0 0 138 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path d="M43.987 11.78a6.565 6.565 0 00-9.284 0l-5.656 5.656-5.657-5.657a6.565 6.565 0 10-9.284 9.285l5.657 5.656-5.657 5.657a6.565 6.565 0 009.284 9.284l5.657-5.656 5.656 5.657a6.565 6.565 0 009.284-9.284l-5.657-5.657 5.657-5.657a6.563 6.563 0 000-9.284z" fill="currentColor"/>
                             <path d="M60 12h-4v24h20v-4H60V12zm26 0h-4v24h20v-4H86V12z" fill="currentColor"/>
                         </svg>
                         <blockquote class="text-xl font-medium leading-8 text-white">
                            "TeamBoard transformed how we handle vendor contracts. We went from email chaos to a streamlined, automated workflow in less than a week."
                        </blockquote>
                        <div class="mt-8 flex items-center gap-4">
                            <img class="h-12 w-12 rounded-full ring-2 ring-indigo-500" src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="CEO">
                            <div>
                                <div class="font-semibold text-white">Michael Foster</div>
                                <div class="text-zinc-400 text-sm">CTO of Tuple</div>
                            </div>
                        </div>
                     </div>
                     <div class="relative h-64 lg:h-full min-h-[300px] rounded-2xl overflow-hidden shadow-2xl">
                         <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1770&q=80" 
                              class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Office working">
                         <div class="absolute inset-0 bg-indigo-900/20 group-hover:bg-transparent transition-colors duration-500"></div>
                     </div>
                 </div>
             </div>
        </div>

        <!-- Bento Grid "Everything you need" -->
        <div class="bg-white dark:bg-zinc-950 py-24 sm:py-32">
             <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center mb-16">
                    <h2 class="text-base font-semibold leading-7 text-indigo-600 dark:text-indigo-400">All-in-One Platform</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-5xl">Building blocks for success</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 auto-rows-[300px]">
                    <!-- Large Card -->
                    <div class="lg:col-span-2 group relative overflow-hidden rounded-3xl bg-zinc-50 dark:bg-zinc-900 p-8 border border-zinc-200 dark:border-zinc-800 transition-all hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-1">
                        <div class="relative z-10">
                            <h3 class="text-2xl font-bold text-zinc-900 dark:text-white">Project Intelligence</h3>
                            <p class="mt-2 text-zinc-600 dark:text-zinc-400 max-w-md">Real-time dashboards that show exactly where your resources are allocated and when.</p>
                        </div>
                        <div class="absolute right-0 bottom-0 top-16 w-2/3 bg-white dark:bg-zinc-950 rounded-tl-2xl border-l border-t border-zinc-200 dark:border-zinc-800 shadow-2xl transition-transform group-hover:scale-105 group-hover:-translate-x-2 group-hover:-translate-y-2 p-4">
                             <!-- Mock Chart -->
                             <div class="flex items-end gap-2 h-full pb-4 px-4">
                                 <div class="w-full bg-indigo-100 dark:bg-indigo-900/20 h-[40%] rounded-t-lg relative group-hover:h-[60%] transition-all duration-700"></div>
                                 <div class="w-full bg-purple-100 dark:bg-purple-900/20 h-[70%] rounded-t-lg relative group-hover:h-[80%] transition-all duration-700 delay-100"></div>
                                 <div class="w-full bg-indigo-500 h-[50%] rounded-t-lg relative group-hover:h-[90%] transition-all duration-700 delay-200 shadow-lg shadow-indigo-500/30"></div>
                             </div>
                        </div>
                    </div>

                    <!-- Small Card -->
                    <div class="group relative overflow-hidden rounded-3xl bg-zinc-900 dark:bg-white p-8 border border-zinc-800 dark:border-zinc-200 transition-all hover:shadow-xl hover:-translate-y-1">
                         <div class="relative z-10">
                            <h3 class="text-2xl font-bold text-white dark:text-zinc-900">Team Sync</h3>
                            <p class="mt-2 text-zinc-400 dark:text-zinc-600">Keep everyone aligned with zero friction.</p>
                        </div>
                        <div class="absolute -right-10 -bottom-10 h-40 w-40 rounded-full bg-indigo-500 blur-3xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    </div>

                    <!-- Small Card -->
                    <div class="group relative overflow-hidden rounded-3xl bg-indigo-600 p-8 border border-indigo-500 transition-all hover:shadow-xl hover:-translate-y-1">
                         <div class="relative z-10">
                            <h3 class="text-2xl font-bold text-white">Vendor Portal</h3>
                            <p class="mt-2 text-indigo-100">Secure access for external partners.</p>
                        </div>
                         <div class="absolute right-4 bottom-4">
                            <svg class="h-24 w-24 text-indigo-400/30 rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                        </div>
                    </div>

                     <!-- Large Card -->
                    <div class="lg:col-span-2 group relative overflow-hidden rounded-3xl bg-white dark:bg-zinc-900 p-8 border border-zinc-200 dark:border-zinc-800 transition-all hover:shadow-2xl hover:shadow-purple-500/10 hover:-translate-y-1">
                         <div class="relative z-10">
                            <h3 class="text-2xl font-bold text-zinc-900 dark:text-white">Smart Financials</h3>
                            <p class="mt-2 text-zinc-600 dark:text-zinc-400">Automate approvals and track spend in real-time.</p>
                        </div>
                        <div class="mt-8 grid grid-cols-2 gap-4">
                            <div class="bg-zinc-50 dark:bg-zinc-800 p-4 rounded-xl">
                                <div class="text-sm text-zinc-500">Total Spend</div>
                                <div class="text-2xl font-bold text-zinc-900 dark:text-white mt-1">$124,500</div>
                                <div class="text-xs text-green-600 mt-2 flex items-center">
                                    <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                                    +12% vs last month
                                </div>
                            </div>
                             <div class="bg-zinc-50 dark:bg-zinc-800 p-4 rounded-xl">
                                <div class="text-sm text-zinc-500">Outstanding</div>
                                <div class="text-2xl font-bold text-zinc-900 dark:text-white mt-1">$8,230</div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>

        <!-- CTA Section -->
        <div class="relative isolate overflow-hidden bg-zinc-900 dark:bg-black py-24 sm:py-32">
            <svg viewBox="0 0 1024 1024" class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-x-1/2 [mask-image:radial-gradient(closest-side,white,transparent)]" aria-hidden="true">
                <circle cx="512" cy="512" r="512" fill="url(#8d958450-c69f-4251-94bc-4e091a323369)" fill-opacity="0.7" />
                <defs>
                    <radialGradient id="8d958450-c69f-4251-94bc-4e091a323369">
                        <stop stop-color="#7775D6" />
                        <stop offset="1" stop-color="#E935C1" />
                    </radialGradient>
                </defs>
            </svg>
             <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
                 <h2 class="text-3xl font-bold tracking-tight text-white sm:text-5xl">Ready to transform your business?</h2>
                 <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-zinc-300">Join thousands of high-performing teams using TeamBoard.</p>
                 <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="/register" class="rounded-full bg-white px-8 py-3.5 text-sm font-semibold text-zinc-900 shadow-sm hover:bg-zinc-100 hover:scale-105 transition-transform duration-200">Get started today</a>
                </div>
             </div>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="bg-zinc-50 dark:bg-black border-t border-zinc-200 dark:border-zinc-800" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-32">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8">
                    <span class="text-2xl font-bold text-zinc-900 dark:text-white">TeamBoard</span>
                    <p class="text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                        Making business management effortless for teams of all sizes.
                    </p>
                    <div class="flex space-x-6">
                         <a href="#" class="text-zinc-400 hover:text-zinc-500">
                             <span class="sr-only">Twitter</span>
                             <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                         </a>
                         <a href="#" class="text-zinc-400 hover:text-zinc-500">
                             <span class="sr-only">GitHub</span>
                             <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                         </a>
                    </div>
                </div>
                <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6 text-zinc-900 dark:text-white">Solutions</h3>
                             <ul role="list" class="mt-6 space-y-4">
                                <li><a href="#" class="text-sm leading-6 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">Project Management</a></li>
                                <li><a href="#" class="text-sm leading-6 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">Vendor Portal</a></li>
                                <li><a href="#" class="text-sm leading-6 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">HR & Time</a></li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-sm font-semibold leading-6 text-zinc-900 dark:text-white">Support</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="#" class="text-sm leading-6 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">Documentation</a></li>
                                <li><a href="#" class="text-sm leading-6 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">Guides</a></li>
                                <li><a href="#" class="text-sm leading-6 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">API Status</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6 text-zinc-900 dark:text-white">Company</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="#" class="text-sm leading-6 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">About</a></li>
                                <li><a href="#" class="text-sm leading-6 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">Blog</a></li>
                                <li><a href="#" class="text-sm leading-6 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">Jobs</a></li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-sm font-semibold leading-6 text-zinc-900 dark:text-white">Legal</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="#" class="text-sm leading-6 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">Privacy</a></li>
                                <li><a href="#" class="text-sm leading-6 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">Terms</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-16 border-t border-zinc-900/10 dark:border-white/10 pt-8 sm:mt-20 lg:mt-24">
                 <p class="text-xs leading-5 text-zinc-500 text-center">&copy; 2026 TeamBoard Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div>
