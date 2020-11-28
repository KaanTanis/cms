@extends('admin.master')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                <span style="float: left">{{ $page['nameIndex'] }}</span>

                <span style="float: right">
                <a href="{{ route('create', request()->resource) }}" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colorsduration-150 bg-purple-600 border border-transparent
                                rounded-md active:bg-purple-600hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    {{ __('addNew', ['type' => $page['name']]) }}
                </a>
                </span>
            </h2>

            @if(session()->has('info'))
                <div class="bg-purple-600 rounded px-5 py-4 text-white mb-6">{{ session('info') }}</div>
            @endif

             <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            @foreach($labels as $label)
                            <th class="px-4 py-3">{{ $label }}</th>
                            @endforeach
                            <th class="px-4 py-3">{{ __('edit') }}</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse($data as $datum)
                        <tr class="text-gray-700 dark:text-gray-400">
                            @foreach($names as $name)
                            <td class="px-4 py-3 text-sm">{{ $datum->$name }}</td>
                            @endforeach
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('edit', [request()->resource, $datum->id]) }}" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colorsduration-150 bg-purple-600 border border-transparent
                                rounded-md active:bg-purple-600hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    {{ __('Edit') }}
                                </a>
                            </td>
                        </tr>
                        @empty
                            <div class="bg-purple-600 rounded px-5 py-4 text-white mb-6">{{ __('There is nothing here!') }}</div>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
@endsection

