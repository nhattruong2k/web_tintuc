<option {{ $parent_danhmucs->id==$danhmuctintuc->parent_id ? 'selected' : '' }} value="{{ $parent_danhmucs->id }}">{{$text}}{{ $parent_danhmucs->tendanhmuc }}</option> 
    @if($parent_danhmucs->children)
        @foreach($parent_danhmucs->children as $childCategory)
            @include('admin.danhmuc.edit_category', 
            [
                'parent_danhmucs'=> $childCategory,
                'text' =>'|--'.$text    
            ])
        @endforeach
    @endif
