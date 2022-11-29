<div class="container">
            <div class="row">
                 @foreach($danhmuc as $danh)
                <div class="col-sm-3">
                    <ul>
                        <li class="nav-item">
                            <ul >
                                <li class="menu">
                                        <a class="nav-link" href="{{route('category', $danh->slug_danhmuc)}}"><h6 style="color: red">{{$danh->tendanhmuc}}</h6></a>
                                            @foreach($danh->children as $childCategory)
                                                <a style="color:#656363; width:max-content" class="nav-link"href="{{route('category22', ['slug_parent' => $danh->slug_danhmuc, 'slug' => $childCategory->slug_danhmuc])}}">{{ $childCategory->tendanhmuc }}</a>
                                            @endforeach
                                    </li> 
                            </ul>
                        </li>
                    </ul>
                </div>
                @endforeach 
        </div>
</div>


