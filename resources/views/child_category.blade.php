
<li>
    <a href="">{{ $child_category->tendanhmuc }}</a>
    @if ($child_category->children)
            @foreach ($child_category->children as $childCategory)
                @include('child_category', ['child_category' => $childCategory])
            @endforeach
    @endif
</li>