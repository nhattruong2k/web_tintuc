<option value="{{ $category->id}}">{{ $text }}{{$category->tendanhmuc}}</option>
@if($category->children)
    @foreach($category->children as $childCategory)
        @include('admin.danhmuc.child_category', 
        [
            'category'=> $childCategory,
            'text' =>'|--'.$text
        ])
    @endforeach
@endif