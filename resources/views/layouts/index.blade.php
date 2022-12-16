
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : ''}}">
  <title>{{config('app.Name', 'Admin TinTuc')}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('vendors/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/summernote/summernote-bs4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/styleWrapper.css')}}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/hoathi.css')}}">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/bootstrap-tagsinput.css')}}" type="text/css">
   <!-- Modal Booostrap -->
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
  
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  {{-- <script src="{{asset('vendor/adminlte/dist/js/bootstrap-tagsinput.min.js')}}"></script> --}}
  <script src="{{asset('vendor/adminlte/dist/js/bootstrap-tagsinput.js')}}"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="app">
    <div class="wrapper">
        <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ asset('vendors/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
            </div>
        <!-- Navbar -->
            @include('layouts.site.header');
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
            @include('layouts.site.siderbar');

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content container-fluid">
            @yield('content')
        </section>
    </div>

    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Quản Lý Tin Tức </strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
</div>

<!-- ./wrapper -->

<!-- Số lượng đăng ký viewer -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        Morris.Donut({
        element: 'donut',
        resize: true,
        colors: [
            '#36a3c6',
            '#ffff66',
            '#38c172',
            '#ff0000',
            '#FF1744',
            '#0066ff',
        ],
        data: [
            {label:"Bai viet", value:<?php echo $count_blog ?> },
            {label:"Nguoi xem", value:<?php echo $count_user?>},
            {label:"Luot like", value:<?php echo $count_like?>},
            {label:"Luot comment", value:<?php echo $count_comments?>},
            {label:"Thong bao", value:<?php echo $count_notifi?>}
        ]
        })
        });
    </script>
<!-- Font-awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<!-- jQuery -->
<script src="{{ asset('vendors/plugins/jquery/jquery.min.js')}}"></script>

    
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script> 

<!-- Bootstrap 4 -->
<script src="{{ asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('vendors/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('vendors/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{ asset('vendors/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('vendors/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('vendors/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('vendors/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('vendors/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('vendors/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('vendors/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('vendors/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('vendors/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('vendors/dist/js/demo.js')}}"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('vendors/dist/js/pages/dashboard.js')}}"></script>
<!-- DataTable -->
    
      <script src="{{ asset('js/app.js') }}"></script>
      <!-- Slug -->
<script type="text/javascript">
    function ChangeToSlug()
        {
            var slug;
        
            //Lấy slug từ thẻ input slug 
            slug = document.getElementById("slug").value;
            //Đổi chữ hoa thành chữ thường
            slug = slug.toLowerCase();
            // Kiểm trả slug
                // alert(slug);
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “convert_slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>
      <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
    <script type="text/javascript"> 
      CKEDITOR.replace('ckeditor1');
    </script>
    <script>
         $('#myModal').modal('hide');
          $(document).ready(function(){
             $('.detail-btn').click(function(){
                const id = $(this).attr('data-id');
                    //console.log(id);
                $.ajax({
                url:'content_detail/'+id,
                type: 'GET',
                 data: {
                    "id":id
                },
                success:function(data){
                    $('#blog-tenblog').html(data.tenblog);
                    $('#blog-content').html(data.content);
                 }
                })
        })
    })
    </script> 
        <!-- jQuery Birth_date -->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

        <script>
        $( function() {
            $("#datepicker" ).datepicker({
                dataFormat: "yy/mm/dd",
                changeMonth: true,
                changeYear: true,
                showOtherMonths: true,
                selectOtherMonths: true,
                minDate: "-1Y",
                maxDate: "Y",
            });
        } );
    </script>

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
         var dataTable = $('.table').DataTable({
            "language": {
                "lengthMenu": "Xem _MENU_ mục",
                "zeroRecords": "Không tìm thấy kết quả !",
                "info": "Hiển thị mục _START_ tới _END_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(Lọc từ _MAX_ cột dữ liệu)",
                "emptyTable": "Không có dữ liệu trong bảng",
                "search": "Tìm kiếm",
                "paginate": {
                    "first": "Đầu tiên",
                    "last": "Sau",
                    "next": "Tiếp theo",
                    "previous": "Trước"
                },
            },
         });
         dataTable.on('order.dt search.dt', function() {
            let i = 1;
            let page = $('.paginate_button.active').find('a').text();
            for (let j = 1; j <= page; j++) {
                if (j > 1) {
                    i = i + 10;
                }
            }
            dataTable.cells(null, 0, {
                search: 'applied',
                order: 'applied'
            }).every(function(cell) {
                this.data(i++);
            });
        }).draw();
        } );
	</script>
    <script>
        $(function () {
            $('input').tagsinput();
        });
    </script>
</body>
</html>
