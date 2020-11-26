@extends('admin.master')
@section('content')
<main class="h-full pb-16 overflow-y-auto">
    <!-- Remove everything INSIDE this div to a really blank page -->
<div class="container px-6 mx-auto grid">
<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ $page['name'] }}</h2>

@if(session()->has('info'))
<div class="bg-purple-600 rounded px-5 py-4 text-white mb-6">{{ session('info') }}</div>
@endif

@foreach($fields as $field)
    <x-admin.form :url="$field['url']" :method="$field['method']">
        @foreach($field['form'] as $form)
            <x-admin.card :title="$form['title']">
                @foreach($form['card'] as $items)
                    @switch($items->component)
                        @case('text-field')
                        <x-admin.input :label="$items->label" :name="$items->name" :placeholder="$items->placeholder"></x-admin.input>
                        @break

                        @case('textarea-field')
                        <x-admin.textarea :label="$items->label" :rows="$items->rows" :name="$items->name" :placeholder="$items->placeholder"></x-admin.textarea>
                        @break

                        @case('button-field')
                        <x-admin.button :label="$items->label" :type="$items->type"></x-admin.button>
                        @break
                    @endswitch

                @endforeach
            </x-admin.card>
        @endforeach
    </x-admin.form>
@endforeach
</div>

</main>
@endsection

