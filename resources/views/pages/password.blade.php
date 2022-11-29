@extends('../layout')

@section('content')
    @include('pages.navbar')
@endsection

@section('password')
<div class="hero-area height-400 bg-img background-overlay" style="background-image: url('{{asset('img/blog-img/istockphoto2.jpg')}}')">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="single-blog-title text-center">
                    <h3>Thay đổi mật khẩu</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Thay đổi mật khẩu</div>
                @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                @endif
                <div class="card-body"> 
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    <form method="POST" action="{{ route('updatePass') }}">
                        {{ csrf_field() }}

                        <div class="row form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-sm-4 col-form-label">Mật khẩu cũ:</label>

                            <div v class="col-md-7">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <input id="current-password" type="password" class="form-control" name="current-password" placeholder="Nhập lại mật khẩu cũ" required>
                                    </div>
                                    <span class="input-group-text" id="basic-addon1"><i onclick="myfunctionss()" class="fa fa-eye" aria-hidden="true"></i></span>
                                </div>
                                <script type="text/javascript">
                                    var s = true;
                                    function myfunctionss(){
                                        if(s){
                                            document.getElementById("current-password").type = "text";
                                            s = false;
                                        }else{
                                            document.getElementById("current-password").type = "password";
                                            s = true;
                                        }
                                    }
                                </script> 

                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <div class="bar error">{{ $errors->first('current-password') }}</div>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class=" row form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                        <tr>
                            <label for="new-password" class="col-sm-4 col-form-label">Mật khẩu mới:</label>
                            <div class="col-md-6">
                                <div class="pass">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <input id="new-password" type="password" class="form-control" name="new-password" placeholder="Mật khẩu mới *" required>
                                        </div>
                                        <span class="input-group-text" id="basic-addon1"><i onclick="myfunction()" class="fa fa-eye" aria-hidden="true"></i></span>
                                    </div>
                                    @if ($errors->has('new-password'))
                                        <div class="bar error">{{ $errors->first('new-password') }}</div>
                                    @endif
                                </div>
                                <script type="text/javascript">
                                    var a = true;
                                    function myfunction(){
                                        if(a){
                                            document.getElementById("new-password").type = "text";
                                            a = false;
                                        }else{
                                            document.getElementById("new-password").type = "password";
                                            a = true;
                                        }
                                    }
                                </script> 
                            </div>
                        </tr>
                        </div>

                        <div class="row form-group">
                            <label for="new-password-confirm" class="col-sm-4 col-form-label">Nhập lại mật khẩu:</label>

                            <div class="col-md-6">
                                <td style="position: relative;">
                                    <div class="pass">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" placeholder="Nhập lại mật khẩu *" required>
                                            </div>
                                            <span class="input-group-text" id="basic-addon1"><i onclick="myfunctions()" class="fa fa-eye" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </td>
                                @if ($errors->has('new-password_confirmation'))
                                    <span class="help-block">
                                        <div class="bar error">{{ $errors->first('new-password_confirmation') }}</div>
                                    </span>
                                @endif
                            </div>
                            <script type="text/javascript">
                                    var b = true;
                                    function myfunctions(){
                                        if(b){
                                            document.getElementById("new-password-confirm").type = "text"
                                            b = false;
                                        }else{
                                            document.getElementById("new-password-confirm").type = "password";
                                            b = true;
                                        }
                                    }
                                </script> 
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Đổi mật khẩu
                                </button>
                            </div>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
@endsection

