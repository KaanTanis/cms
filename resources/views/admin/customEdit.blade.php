@extends('admin.master')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto grid">

            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                <span style="float: left">{{ $page['name'] }}</span>


                @if(!$page['withoutTable'])
                    <span style="float: right">
                    <form action="/admin/{{ $page['slug'] }}/delete/{{ $data['id'] }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colorsduration-150 bg-purple-600 border border-transparent
                                        rounded-md active:bg-purple-600hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            {{ __('deleteThis', ['type' => $page['name']]) }}
                        </button>
                    </form>
                </span>
                @endif

            </h2>

            @if(session()->has('info'))
                @if(is_array(session('info')))
                    @foreach(session('info') as $error)
                        <div class="bg-purple-600 rounded px-5 py-4 text-white mb-6">{{ $error }}</div>
                    @endforeach
                    @else
                    <div class="bg-purple-600 rounded px-5 py-4 text-white mb-6">{{ session('info') }}</div>
                @endif
            @endif

            @if($page['translatable'] == true)

                <div class="inline-block mr-4 mb-6">
                    <a href="/admin/{{ $page['slug'] }}/edit/{{ $data['id'] }}"
                       class="{{ request()->lang != null ? 'opacity-50' : null }}
                           px-3 py-1 text-sm font-medium leading-5 text-white transition-colors
                           duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600
                           hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple mr-4">
                        {{ \App\Helpers\Helper::getDefaultLangName() }}
                    </a>
                    @foreach($languages as $lang)
                        @if($lang->display_name != \App\Helpers\Helper::getDefaultLangName())
                            <a href="/admin/{{ $page['slug'] }}/edit/{{ $data['id'] }}/{{ $lang->lang_code }}"
                               class="{{ $lang->lang_code != request()->lang ? 'opacity-50' : null }}
                                   px-3 py-1 text-sm font-medium leading-5 text-white transition-colors
                                   duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600
                                   hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple mr-4">
                                {{ $lang->display_name }}
                            </a>
                        @endif
                    @endforeach
                </div>

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
                                    <x-admin.textarea :label="$formField->label" :rows="$formField->rows" :name="$formField->name" :placeholder="$formField->placeholder"
                                                      :value="old('$formField->name')"></x-admin.textarea>
                                    @break

                                    @case('button-field')
                                    <x-admin.button :label="request()->id ? $formField->onEdit ??  $formField->label : $formField->label" :type="$formField->type"></x-admin.button>
                                    @break

                                @endswitch
                            @endforeach
                            <input type="hidden" name="id" value="{{ $data['id'] ?? null }}">
                        </x-admin.form>
                    @endforeach
                </x-admin.card>
            @endforeach
        </div>

    </main>
@endsection

