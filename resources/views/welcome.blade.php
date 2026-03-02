<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Route Explorer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 antialiased font-sans">

<div class="max-w-7xl mx-auto px-4 py-8">
    <header class="mb-10 border-b border-slate-200 pb-6">
        <h1 class="text-3xl font-extrabold text-slate-900">API Documentation</h1>
        <p class="text-slate-500 mt-1">Responsive route mapping grouped by role permissions.</p>
    </header>

    @php
        // Defining sections to loop through
        $sections = [
            ['title' => 'Admin Functions', 'routes' => $admin, 'border' => 'border-indigo-500', 'text' => 'text-indigo-600'],
            ['title' => 'Client Functions', 'routes' => $client, 'border' => 'border-emerald-500', 'text' => 'text-emerald-600'],
            ['title' => 'Common Endpoints', 'routes' => $common, 'border' => 'border-slate-400', 'text' => 'text-slate-600']
        ];
    @endphp

    @foreach($sections as $section)
        @if($section['routes']->count() > 0)
            <div class="mb-12">
                <h2 class="flex items-center text-xl font-bold {{ $section['text'] }} mb-4">
                    <span class="w-1.5 h-6 {{ str_replace('text', 'bg', $section['text']) }} rounded-full mr-3"></span>
                    {{ $section['title'] }}
                </h2>

                {{-- Desktop View --}}
                <div class="hidden md:block overflow-hidden bg-white rounded-xl shadow-sm border border-slate-200">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Method</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Route</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Controller</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($section['routes'] as $route)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        @php $method = $route->methods()[0]; @endphp
                                        <span class="px-2 py-1 rounded text-xs font-bold border 
                                            {{ $method === 'GET' ? 'bg-green-50 border-green-200 text-green-700' : '' }}
                                            {{ $method === 'POST' ? 'bg-blue-50 border-blue-200 text-blue-700' : '' }}
                                            {{ $method === 'PUT' ? 'bg-amber-50 border-amber-200 text-amber-700' : '' }}
                                            {{ $method === 'DELETE' ? 'bg-red-50 border-red-200 text-red-700' : '' }}">
                                            {{ $method }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-sm text-slate-700">/{{ $route->uri() }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ str_replace('App\Http\Controllers\\', '', $route->getActionName()) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile View (Cards) --}}
                <div class="grid grid-cols-1 gap-4 md:hidden">
                    @foreach($section['routes'] as $route)
                        <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Method</span>
                                @php $method = $route->methods()[0]; @endphp
                                <span class="font-bold text-sm {{ $method === 'GET' ? 'text-green-600' : ($method === 'POST' ? 'text-blue-600' : 'text-slate-600') }}">
                                    {{ $method }}
                                </span>
                            </div>
                            <div class="font-mono text-slate-800 font-bold mb-2">/{{ $route->uri() }}</div>
                            <div class="text-xs text-slate-400 truncate">
                                {{ str_replace('App\Http\Controllers\\', '', $route->getActionName()) }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
</div>

</body>
</html>