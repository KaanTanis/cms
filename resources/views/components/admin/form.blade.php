<form method="{{ $method }}" action="{{ $url }}">
    @csrf

    {{ $slot }}

</form>
