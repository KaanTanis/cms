@extends('admin.master')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto grid">

            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                <span style="float: left">{{ $page['name'] }}</span>
            </h2>

            @if(session()->has('info'))
                @if(is_array(session('info')))
                    @foreach(session('info') as $info)
                        <div class="bg-purple-600 rounded px-5 py-4 text-white mb-6">
                            {{ $info }}
                        </div>
                    @endforeach
                @else
                    <div class="bg-purple-600 rounded px-5 py-4 text-white mb-6">
                        {{ session('info') }}
                    </div>
                @endif
            @endif

            @foreach($fields as $field)
                {{--    Get card title--}}
                <x-admin.card :title="$field['title']">
                    {{--        Get forms--}}
                    @foreach($field['form'] as $form)
                        <x-admin.form :url="$form['url']" :method="$form['method']">
                            {{--                Get form fields--}}
                            @foreach($form['fields'] as $formField)
                                @switch($formField->component)
                                    @case('text-field')
                                    <x-admin.input :label="$formField->label" :name="$formField->name" :placeholder="$formField->placeholder"
                                                   :value="old('$formField->name') ?? $data[$formField->name]"></x-admin.input>
                                    @break

                                    @case('file-field')
                                    <x-admin.file :label="$formField->label" :name="$formField->name"
                                                  :value="old('$formField->name') ?? $data[$formField->name]"></x-admin.file>
                                    @break

                                    @case('textarea-field')
                                    <x-admin.textarea :label="$formField->label" :rows="$formField->rows" :name="$formField->name" :placeholder="$formField->placeholder"
                                                      :value="old('$formField->name') ?? $data[$formField->name]"></x-admin.textarea>
                                    @break

                                    @case('tinymce-field')
                                    <x-admin.tinymce :label="$formField->label" :rows="$formField->rows" :name="$formField->name" :placeholder="$formField->placeholder"
                                                     :value="old('$formField->name') ?? $data[$formField->name]"></x-admin.tinymce>
                                    @break

                                    @case('button-field')
                                    <x-admin.button :label="request()->id ? $formField->onEdit ??  $formField->label : $formField->label" :type="$formField->type"></x-admin.button>
                                    @break

                                @endswitch
                            @endforeach
                        </x-admin.form>
                    @endforeach
                </x-admin.card>
            @endforeach
        </div>

    </main>
@endsection

