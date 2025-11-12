<!-- Initialize Alpine.js state for dark mode -->
<div x-data="{
    darkMode: $persist(false).as('dark-mode'),
    mobileMenuOpen: false,
    init() {
        // Set initial dark mode
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        
        // Watch for changes to dark mode
        this.$watch('darkMode', value => {
            if (value) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });
    }
}" x-init="init">

<!-- Main Navigation -->
<x-layouts.main-navbar />

<div class="min-h-screen bg-gradient-to-b from-white to-zinc-50 dark:from-zinc-900 dark:to-zinc-800">
    <!-- Hero Section -->
    <section class=" flex min-h-dvh flex-col items-center justify-center px-4 py-12 text-center">
        <div class="mx-auto max-w-3xl space-y-6">
            <h1 class="text-4xl font-bold text-foreground md:text-6xl">
                Manage your projects <span class="text-blue-600">efficiently</span>
            </h1>
            <p class="text-lg text-zinc-600 dark:text-zinc-300 md:text-xl">
                TeamBoard is a powerful project management platform that helps you organize, track, and collaborate on your projects with your team.
            </p>
            <div class="mt-8 flex flex-col gap-4 sm:flex-row sm:justify-center">
                <a href="{{ route('register') }}" wire:navigate class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-3 text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                    {{ __('Get Started') }}
                </a>
                <a href="{{ route('login') }}" wire:navigate class="inline-flex items-center justify-center rounded-lg border border-zinc-300 px-6 py-3 text-foreground transition-colors hover:bg-zinc-100 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 dark:border-zinc-700 dark:hover:bg-zinc-800 dark:focus:ring-offset-zinc-900">
                    {{ __('Sign In') }}
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class=" px-4 py-16">
        <div class="mx-auto max-w-6xl">
            <div class="mb-16 text-center">
                <h2 class="text-3xl font-bold text-foreground md:text-4xl">Powerful Features</h2>
                <p class="mt-4 max-w-2xl text-lg text-zinc-600 dark:text-zinc-300 mx-auto">
                    Everything you need to manage your projects effectively and efficiently
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                            <path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-foreground">Project Management</h3>
                    <p class="text-zinc-600 dark:text-zinc-300">
                        Create and manage your projects with intuitive tools that help you stay organized and on track.
                    </p>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-foreground">Team Collaboration</h3>
                    <p class="text-zinc-600 dark:text-zinc-300">
                        Invite team members, assign tasks, and collaborate in real-time to achieve your goals together.
                    </p>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-foreground">Analytics & Insights</h3>
                    <p class="text-zinc-600 dark:text-zinc-300">
                        Track your progress with detailed analytics and gain insights to improve your project outcomes.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 py-16">
        <div class=" px-4">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="text-3xl font-bold text-white md:text-4xl">
                    Ready to transform your project management?
                </h2>
                <p class="mt-4 text-lg text-blue-100">
                    Join thousands of teams already using TeamBoard to streamline their workflow.
                </p>
                <div class="mt-8">
                    <a href="{{ route('register') }}" wire:navigate class="inline-flex items-center justify-center rounded-lg bg-white px-6 py-3 text-blue-600 transition-colors hover:bg-zinc-100 focus:outline-hidden focus:ring-2 focus:ring-white focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                        Start Your Free Trial
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>