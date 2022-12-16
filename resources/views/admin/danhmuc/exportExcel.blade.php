{{-- <h5>Danh Mục Website Tin Tức</h5> --}}
<table>
    <thead>
    <tr>
        <th><b>STT</b></th>
        <th><b>Title category</b></th>
        <th><b>Desc category</b></th>
        <th><b>Slug_category</b></th>
        <th><b>Parent_id</b></th>
        <th><b>Activiti</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($danhmucs as $key=>$danh)
        <tr>
            <th>{{ $key }}</th>
            <td>{{ $danh->tendanhmuc }}</td>
            <td>{{ $danh->motadanhmuc }}</td>
            <td>{{ $danh->slug_danhmuc }}</td>
            <td>{{ $danh->parent_id }}</td>
            <td>{{ $danh->kichhoat }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

