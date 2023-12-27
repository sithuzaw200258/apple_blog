<a href="{{ $url }}" class="list-group-item list-group-item-action {{ request()->url() === $url ? 'active' : '' }}">
    {{ $slot }}
    {{ $item }}
</a>