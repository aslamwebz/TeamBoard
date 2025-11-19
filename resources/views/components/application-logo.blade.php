<div class="flex items-center">
    @if(function_exists('tenant') && tenant() && (tenant()->logo_url ?? null))
        <img src="{{ tenant()->logo_url }}" alt="{{ tenant()->getCompanyName() ?? config('app.name') }}" class="h-8 w-auto" />
    @elseif(function_exists('tenant') && tenant() && (tenant()->legal_name ?? null))
        <div class="flex items-center justify-center h-8 w-8 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium text-sm">
            {{ strtoupper(substr(tenant()->legal_name, 0, 1)) }}
        </div>
        <span class="ml-2 text-xl font-bold">{{ tenant()->getCompanyName() ?? config('app.name') }}</span>
    @else
        <svg class="h-8 w-8 text-gray-800 dark:text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="ml-2 text-xl font-bold">{{ config('app.name') }}</span>
    @endif
</div>
