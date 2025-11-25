<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Preview - {{ $attachment->original_name }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background-color: #0f172a; /* dark slate 900 */
        }
        .preview-container {
            max-height: calc(100vh - 120px);
        }
        .file-header {
            background-color: #1e293b; /* slate 800 */
        }
        .preview-content {
            background-color: #1e293b; /* slate 800 */
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-100">
    <div class="min-h-screen">
        <!-- Header -->
        <div class="file-header border-b border-slate-700 p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-slate-700">
                        @if($attachment->isImage())
                            <i class="fas fa-image text-blue-400"></i>
                        @elseif($attachment->mime_type === 'application/pdf')
                            <i class="fas fa-file-pdf text-red-500"></i>
                        @elseif(Str::contains($attachment->mime_type, 'word'))
                            <i class="fas fa-file-word text-blue-500"></i>
                        @elseif(Str::contains($attachment->mime_type, 'excel'))
                            <i class="fas fa-file-excel text-green-500"></i>
                        @elseif(Str::contains($attachment->mime_type, 'powerpoint'))
                            <i class="fas fa-file-powerpoint text-orange-500"></i>
                        @elseif(Str::contains($attachment->mime_type, 'archive'))
                            <i class="fas fa-file-archive text-orange-400"></i>
                        @elseif(Str::contains($attachment->mime_type, 'text'))
                            <i class="fas fa-file-alt text-slate-400"></i>
                        @else
                            <i class="fas fa-file text-slate-400"></i>
                        @endif
                    </div>
                    <div>
                        <h1 class="text-lg font-semibold truncate max-w-md">{{ $attachment->original_name }}</h1>
                        <p class="text-sm text-slate-400">{{ $attachment->getFormattedSize() }} • {{ $attachment->mime_type }}</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <a href="{{ route('tenant.file.download', ['filename' => $attachment->filename]) }}" 
                       target="_blank"
                       class="flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 rounded-md text-sm transition-colors">
                        <i class="fas fa-download mr-2"></i> Download
                    </a>
                    <a href="javascript:window.close()" 
                       class="flex items-center px-3 py-2 bg-slate-700 hover:bg-slate-600 rounded-md text-sm transition-colors">
                        <i class="fas fa-times mr-2"></i> Close
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Preview Content -->
        <div class="preview-container p-4 flex justify-center items-start">
            @if($attachment->isImage())
                <!-- Image Preview -->
                <div class="flex justify-center">
                    <img src="{{ route('tenant.file.download', ['filename' => $attachment->filename]) }}" 
                         alt="{{ $attachment->original_name }}"
                         class="max-w-full max-h-full object-contain rounded-lg shadow-lg">
                </div>
            @elseif($attachment->mime_type === 'application/pdf')
                <!-- PDF Preview -->
                <div class="w-full max-w-4xl">
                    <iframe 
                        src="{{ route('tenant.file.download', ['filename' => $attachment->filename]) }}" 
                        class="w-full h-[75vh] border border-slate-700 rounded-lg"
                        type="application/pdf"
                        title="PDF Preview">
                        <p class="text-center p-8 text-slate-400">Your browser doesn't support PDF previews. <a href="{{ route('tenant.file.download', ['filename' => $attachment->filename]) }}" class="text-blue-400 hover:underline" target="_blank">Download the PDF</a> to view it.</p>
                    </iframe>
                </div>
            @elseif(in_array($attachment->mime_type, ['text/plain', 'text/csv', 'text/html', 'application/json']))
                <!-- Text File Preview -->
                <div class="w-full max-w-4xl">
                    <div class="bg-slate-800 border border-slate-700 rounded-lg overflow-hidden">
                        <div class="bg-slate-700 px-4 py-2 border-b border-slate-600">
                            <h3 class="font-medium">File Content</h3>
                        </div>
                        <div class="p-4 max-h-[70vh] overflow-auto">
                            <pre class="whitespace-pre-wrap font-mono text-sm">{{ file_get_contents(storage_path('app/public/discussions/' . $attachment->filename)) }}</pre>
                        </div>
                    </div>
                </div>
            @else
                <!-- Generic File Preview -->
                <div class="text-center py-12 max-w-md">
                    <div class="flex justify-center mb-6">
                        <div class="flex items-center justify-center w-24 h-24 rounded-xl bg-slate-800">
                            @if(Str::contains($attachment->mime_type, 'pdf'))
                                <i class="fas fa-file-pdf text-red-500 text-5xl"></i>
                            @elseif(Str::contains($attachment->mime_type, 'word'))
                                <i class="fas fa-file-word text-blue-500 text-5xl"></i>
                            @elseif(Str::contains($attachment->mime_type, 'excel'))
                                <i class="fas fa-file-excel text-green-500 text-5xl"></i>
                            @elseif(Str::contains($attachment->mime_type, 'powerpoint'))
                                <i class="fas fa-file-powerpoint text-orange-500 text-5xl"></i>
                            @elseif(Str::contains($attachment->mime_type, 'archive'))
                                <i class="fas fa-file-archive text-orange-400 text-5xl"></i>
                            @elseif(Str::contains($attachment->mime_type, 'text'))
                                <i class="fas fa-file-alt text-slate-400 text-5xl"></i>
                            @else
                                <i class="fas fa-file text-slate-400 text-5xl"></i>
                            @endif
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">File Preview Not Available</h3>
                    <p class="text-slate-400 mb-6">This file type cannot be previewed in the browser. Please download the file to view its contents.</p>
                    <a href="{{ route('tenant.file.download', ['filename' => $attachment->filename]) }}" 
                       target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md transition-colors">
                        <i class="fas fa-download mr-2"></i> Download File
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>