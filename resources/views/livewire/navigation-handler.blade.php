<div>
    @push('head')
        @foreach($this->getNavigationRoutes() as $route)
            <link rel="prefetch" href="{{ $route }}" as="document" />
        @endforeach
    @endpush
</div>
