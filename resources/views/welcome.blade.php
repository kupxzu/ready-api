<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Route Explorer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-10">

    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Internal API Reference</h1>
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold uppercase">Method</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase">URI</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase">Controller @ Action</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase">Middleware</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($routes as $route)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                @foreach($route->methods() as $method)
                                    @if($method !== 'HEAD')
                                        <span class="px-2 py-1 rounded text-xs font-bold 
                                            {{ $method === 'GET' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $method === 'POST' ? 'bg-blue-100 text-blue-700' : '' }}
                                            {{ $method === 'PUT' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                            {{ $method === 'DELETE' ? 'bg-red-100 text-red-700' : '' }}">
                                            {{ $method }}
                                        </span>
                                    @endif
                                @endforeach
                            </td>
                            <td class="px-6 py-4 font-mono text-sm text-gray-600">
                                /{{ $route->uri() }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ str_replace('App\Http\Controllers\\', '', $route->getActionName()) }}
                            </td>
                            <td class="px-6 py-4">
                                @foreach($route->gatherMiddleware() as $middleware)
                                    <span class="inline-block bg-gray-100 text-gray-600 text-[10px] px-2 py-0.5 rounded-full mr-1 mb-1 border border-gray-200">
                                        {{ $middleware }}
                                    </span>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>