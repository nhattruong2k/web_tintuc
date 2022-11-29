@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6" style="margin-top:80px">
            <div class="card">
                <div class="card-header">Thay đổi mật khẩu</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                     @endif
                     <form method="POST" action="{{ route('resetPassword',[$user->id])}}" enctype="multipart/form-data"> 
                        @method('PUT')
                        @csrf 
                        <div class="mb-3">
                          <input 
                            type="text" 
                            class="form-control" 
                            name="random-password" 
                            aria-describedby="emailHelp"
                            placeholder="Mật khẩu mới"
                            id="password"
                            >
                        @if($errors->has('random-password'))
                            <div class="bar error">{{$errors->first('random-password')}}</div>
                        @endif
                        </div>
                        <table>
                            <th><div id="button" class="btn1" onclick="genPassword()">Random mật khẩu</div></th>
                            <th><div id="button" class="btn2" onclick="copyPassword()">Sao chép</div></th>
                            <th><button name="themuser" type="submit" class="btn btn-success">Cập nhật</button></th>
                        </table>
                    </div>
                    <script type="text/javascript"> 
                        var password = document.getElementById("passsword");

                        function genPassword(){
                            var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                            var passwordLength = 10;
                            var password = "";

                            for (var i = 0; i <= passwordLength; i++) {
                                var randomNumber = Math.floor(Math.random() * chars.length);
                                password += chars.substring(randomNumber, randomNumber +1);
                            }
                            // Apply it
                            document.getElementById("password").value = password;
                        }
                        // Coppy button
                            function copyPassword(){
                                var copyText = document.getElementById("password");
                                copyText.select();
                                copyText.setSelectionRange(0, 999);
                                document.execCommand("copy");
                            }
                    </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script scr="app.js">
</script>
<link rel="stylesheet" href="{{ asset('css/Password/resetPass.css')}}">
