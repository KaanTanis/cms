<form enctype="multipart/form-data" method="{{ $method }}" action="{{ $url }}">
    @csrf

    {{ $slot }}

</form>
