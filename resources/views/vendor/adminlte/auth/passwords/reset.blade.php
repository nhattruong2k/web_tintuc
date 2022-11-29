@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_header', __('Đặt lại mật khẩu'))

@section('auth_body')
    <form action="{{ $password_reset_url }}" method="post">
        @csrf

        {{-- Token field --}}
        <input type="hidden" name="token" value="{{ $token }}">

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon1"><i onclick="myfunctionsx()" class="fa fa-eye" aria-hidden="true"></i></span>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <script type="text/javascript">
            var v = true;
            function myfunctionsx(){
                if(v){
                    document.getElementById("password").type = "text";
                    v = false;
                }else{
                    document.getElementById("password").type = "password";
                    v = true;
                }
            }
        </script>

        {{-- Password confirmation field --}}
        <div class="input-group mb-3">
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ trans('adminlte::adminlte.retype_password') }}">

            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon1"><i onclick="myfunctions()" class="fa fa-eye" aria-hidden="true"></i></span>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <script type="text/javascript">
            var v = true;
            function myfunctions(){
                if(v){
                    document.getElementById("password_confirmation").type = "text";
                    v = false;
                }else{
                    document.getElementById("password_confirmation").type = "password";
                    v = true;
                }
            }
        </script>
        {{-- Confirm password reset button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-sync-alt"></span>
            {{ __('Cập nhật mật khẩu') }}
        </button>

    </form>
@stop
