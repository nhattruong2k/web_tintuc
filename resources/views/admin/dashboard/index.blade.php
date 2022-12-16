@extends('layouts.index')
@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Trang Chủ</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$count_blog}}</h3>
                <p>Số lượng bài viết</p>
              </div>
              <div class="icon">
                <i class="far fa-bookmark"></i>
              </div>
              <a href="{{url('/blog')}}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$count_user}}</h3>
                <p>Số lượng người đăng ký</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{url('/manager_user')}}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>  
                          <!-- Likes -->
          <div class="col-lg-3 col-6">
            <div class="info-box bg-success" style="height:143px">
              <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Số lượt yêu thích</span>
                <span class="info-box-number">{{$count_like}}</span>
                <div class="progress">
                  {{-- <div class="progress-bar" style="width: 70%"></div> --}}
                </div>
                <span class="progress-description">
                  {{-- {{$phantramcomments}}% Tăng trong 30 ngày --}}
                </span>
              </div>
            </div>
          </div>
                            <!-- Comments -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger" style="height:143px">
              <span class="info-box-icon"><i class="fas fa-comments"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Comments</span>
                <span class="info-box-number">{{$count_comments}}</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$phantramcomments}}%" ></div>
                </div>
                <span class="progress-description">
                 {{$phantramcomments}} % Tăng trong 30 ngày
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-xs-12" style="left:73px; top:35px">
            <div class="row">
              <div class="col-8">
                <span><h4 style="text-align:center">Thống kê số lượng Viewer</h4></span>
                <div id="donut" style="height: 300px; right:67px"></div>
              </div>
              {{-- <div class="col-4" style="left:180px">
                <div class="row">
                  <div class="col-6">
                    <span><h4 style="text-align:center">Bài viết nổi bât</h4></span>

                  </div>
                  <div class="col-6">
                    <span><h4 style="text-align:center">Bài viết xem nhiều</h4></span>

                  </div>
                </div>
              </div> --}}
            </div>

          </div>
    </div>
@endsection

