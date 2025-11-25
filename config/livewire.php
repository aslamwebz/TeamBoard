<?php

use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;

return [
    /*
     * |--------------------------------------------------------------------------
     * | Livewire Loading Indicator
     * |--------------------------------------------------------------------------
     * |
     * | This option controls the default Livewire loading indicator that appears
     * | when a component is being loaded. You can customize this view to add
     * | your own loading indicator or animation.
     * |
     */
    'loading_indicator' => false,

    /*
     * |--------------------------------------------------------------------------
     * | Navigation Preloading
     * |--------------------------------------------------------------------------
     * |
     * | These options control the behavior of Livewire's navigation preloading.
     * |
     */
    'navigation' => [
        // Preload pages on hover (true) or only on click (false)
        'preload_on_hover' => true,
        // Show a loading indicator during navigation
        'show_loading_indicator' => true,
        // Time in milliseconds to wait before showing the loading indicator
        'loading_indicator_delay' => 100,
        // Time in milliseconds to wait before considering navigation failed
        'navigation_timeout' => 10000,
    ],

    /*
     * |--------------------------------------------------------------------------
     * | Livewire Component Namespaces
     * |--------------------------------------------------------------------------
     * |
     * | This value sets the root namespace for Livewire component classes in
     * | your application. This value affects component auto-discovery. This
     * | setting will be overridden by any component that has a custom
     * | namespace set via the `#[Layout]` attribute.
     * |
     */
    'class_namespace' => 'App\Livewire',

    /*
     * |--------------------------------------------------------------------------
     * | Livewire View Path
     * |--------------------------------------------------------------------------
     * |
     * | This value sets the path for Livewire component views. This value
     * | affects how Livewire components are auto-discovered. This setting
     * | will be overridden by any component that has a custom view path.
     * |
     */
    'view_path' => resource_path('views/livewire'),

    /*
     * |--------------------------------------------------------------------------
     * | Livewire Asset URL
     * |--------------------------------------------------------------------------
     * |
     * | This value sets the path to Livewire JavaScript assets, for cases where
     * | your app's domain root is not the correct path. By default, Livewire
     * | will load its JavaScript assets from the site's "root".
     * |
     */
    'asset_url' => null,

    /*
     * |--------------------------------------------------------------------------
     * | Livewire App URL
     * |--------------------------------------------------------------------------
     * |
     * | This value should be used if the domain of your application differs
     * | from the domain where your assets are served (like in a subdomain
     * | setup). This is used by Livewire's JavaScript to make requests.
     * |
     */
    'app_url' => null,

    /*
     * |--------------------------------------------------------------------------
     * | Livewire Middleware Group
     * |--------------------------------------------------------------------------
     * |
     * | This value sets the middleware group that will be applied to the main
     * | Livewire request endpoint. You can add your own middleware to this
     * | group to customize Livewire's behavior.
     * |
     */
    'middleware_group' => [
        'web',
        'universal',
        InitializeTenancyBySubdomain::class,  // or whatever tenancy middleware you use
    ],

    /*
     * |--------------------------------------------------------------------------
     * | Livewire Temporary File Uploads
     * |--------------------------------------------------------------------------
     * |
     * | Livewire handles file uploads by storing uploads in a temporary directory
     * | before the file is stored permanently. All file uploads are directed to
     * | a global endpoint for temporary storage. You may configure this below.
     * |
     */
    'temporary_file_upload' => [
        'disk' => 'livewire-tmp',
        'rules' => ['file', 'max:10240', 'mimes:jpeg,png,gif,webp,svg,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,zip,rar,7z'],
        'directory' => null,
        'middleware' => null,
        'preview_mimes' => [  // Supported file types for preview
            'png',
            'gif',
            'bmp',
            'svg',
            'wav',
            'mp4',
            'mov',
            'avi',
            'wmv',
            'mp3',
            'm4a',
            'jpg',
            'jpeg',
            'mpga',
            'mp4',
            'm4v',
            'pdf',
            'xls',
            'xlsx',
            'doc',
            'docx',
        ],
        'max_upload_time' => 5,  // Max duration (in minutes) before an upload is considered failed
    ],

    /*
     * |--------------------------------------------------------------------------
     * | Livewire Manifest File Path
     * |--------------------------------------------------------------------------
     * |
     * | This value sets the path to the Livewire manifest file.
     * | The default should work for most cases (unless in a custom build setup).
     * |
     */
    'manifest_path' => null,

    /*
     * |--------------------------------------------------------------------------
     * | Back Button Cache
     * |--------------------------------------------------------------------------
     * |
     * | This value determines whether Livewire will use the browser's cache
     * | when navigating back to a page. When set to true, Livewire will
     * | restore the previous component state from the browser's cache.
     * |
     */
    'back_button_cache' => true,

    /*
     * |--------------------------------------------------------------------------
     * | Render On Redirect
     * |--------------------------------------------------------------------------
     * |
     * | This value determines whether Livewire should render the component
     * | before performing a redirect. When set to true, Livewire will
     * | render the component before redirecting, which can be useful for
     * | showing a loading state before the redirect occurs.
     * |
     */
    'render_on_redirect' => true,
];
