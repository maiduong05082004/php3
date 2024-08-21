<li class="dropdown">
    <a href="/category/{{ $category->id }}">{{ $category->name }}</a>
    @if ($category->children->count() > 0)
        <ul class="dropdown-menu">
            @foreach ($category->children as $child)
                @include('client.partials.category_children', ['category' => $child])
            @endforeach
        </ul>
    @endif
</li>
