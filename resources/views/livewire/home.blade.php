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

    <!-- Pricing Section -->
    <section id="pricing" class="py-16 px-4">
        <div class="mx-auto max-w-6xl">
            <div class="mb-16 text-center">
                <h2 class="text-3xl font-bold text-foreground md:text-4xl">Simple, Transparent Pricing</h2>
                <p class="mt-4 max-w-2xl text-lg text-zinc-600 dark:text-zinc-300 mx-auto">
                    Choose the perfect plan for your team's needs
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Free Plan -->
                <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-700 dark:bg-zinc-800">
                    <h3 class="text-xl font-semibold text-foreground">Starter</h3>
                    <div class="my-4">
                        <span class="text-4xl font-bold text-foreground">$0</span>
                        <span class="text-zinc-500 dark:text-zinc-400">/month</span>
                    </div>
                    <p class="mb-6 text-zinc-600 dark:text-zinc-300">Perfect for individuals and small teams getting started.</p>
                    <ul class="mb-8 space-y-3">
                        <li class="flex items-center text-zinc-600 dark:text-zinc-300">
                            <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Up to 3 projects
                        </li>
                        <li class="flex items-center text-zinc-600 dark:text-zinc-300">
                            <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Basic task management
                        </li>
                        <li class="flex items-center text-zinc-600 dark:text-zinc-300">
                            <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            2 team members
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" wire:navigate class="block w-full rounded-lg border border-blue-600 bg-white px-4 py-2 text-center font-medium text-blue-600 transition-colors hover:bg-blue-50 dark:border-blue-500 dark:bg-transparent dark:text-blue-400 dark:hover:bg-blue-900/30">
                        Get Started
                    </a>
                </div>

                <!-- Pro Plan -->
                <div class="relative rounded-xl border-2 border-blue-500 bg-white p-8 shadow-lg dark:border-blue-600 dark:bg-zinc-800">
                    <div class="absolute -top-3 right-4 rounded-full bg-blue-600 px-3 py-1 text-xs font-medium text-white">
                        POPULAR
                    </div>
                    <h3 class="text-xl font-semibold text-foreground">Pro</h3>
                    <div class="my-4">
                        <span class="text-4xl font-bold text-foreground">$9</span>
                        <span class="text-zinc-500 dark:text-zinc-400">/month</span>
                    </div>
                    <p class="mb-6 text-zinc-600 dark:text-zinc-300">Ideal for growing teams that need more power.</p>
                    <ul class="mb-8 space-y-3">
                        <li class="flex items-center text-zinc-600 dark:text-zinc-300">
                            <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Unlimited projects
                        </li>
                        <li class="flex items-center text-zinc-600 dark:text-zinc-300">
                            <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Advanced task management
                        </li>
                        <li class="flex items-center text-zinc-600 dark:text-zinc-300">
                            <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Up to 10 team members
                        </li>
                        <li class="flex items-center text-zinc-600 dark:text-zinc-300">
                            <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Priority support
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" wire:navigate class="block w-full rounded-lg bg-blue-600 px-4 py-2 text-center font-medium text-white transition-colors hover:bg-blue-700">
                        Start Free Trial
                    </a>
                </div>

                <!-- Enterprise Plan -->
                <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-700 dark:bg-zinc-800">
                    <h3 class="text-xl font-semibold text-foreground">Enterprise</h3>
                    <div class="my-4">
                        <span class="text-4xl font-bold text-foreground">Custom</span>
                    </div>
                    <p class="mb-6 text-zinc-600 dark:text-zinc-300">For large organizations with custom needs.</p>
                    <ul class="mb-8 space-y-3">
                        <li class="flex items-center text-zinc-600 dark:text-zinc-300">
                            <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Unlimited everything
                        </li>
                        <li class="flex items-center text-zinc-600 dark:text-zinc-300">
                            <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Custom integrations
                        </li>
                        <li class="flex items-center text-zinc-600 dark:text-zinc-300">
                            <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Dedicated account manager
                        </li>
                        <li class="flex items-center text-zinc-600 dark:text-zinc-300">
                            <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            24/7 priority support
                        </li>
                    </ul>
                    <a href="#contact" class="block w-full rounded-lg border border-zinc-300 bg-white px-4 py-2 text-center font-medium text-foreground transition-colors hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:hover:bg-zinc-700">
                        Contact Sales
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 py-16">
        <div class="px-4">
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

    <!-- Contact Section -->
    <section id="contact" class="bg-white py-16 dark:bg-zinc-900">
        <div class="mx-auto max-w-6xl px-4">
            <div class="grid gap-12 md:grid-cols-2">
                <div>
                    <h2 class="text-3xl font-bold text-foreground md:text-4xl">Get in Touch</h2>
                    <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-300">
                        Have questions or need assistance? Our team is here to help you get the most out of TeamBoard.
                    </p>
                    <div class="mt-8 space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-foreground">Email us</h3>
                                <p class="mt-1 text-zinc-600 dark:text-zinc-300">support@teamboard.app</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-foreground">Call us</h3>
                                <p class="mt-1 text-zinc-600 dark:text-zinc-300">+1 (555) 123-4567</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-foreground">Visit us</h3>
                                <p class="mt-1 text-zinc-600 dark:text-zinc-300">123 Business Ave, Suite 100<br>San Francisco, CA 94107</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
                    <h3 class="text-2xl font-bold text-foreground">Send us a message</h3>
                    <form class="mt-6 space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Name</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Subject</label>
                            <input type="text" id="subject" name="subject" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Message</label>
                            <textarea id="message" name="message" rows="4" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>