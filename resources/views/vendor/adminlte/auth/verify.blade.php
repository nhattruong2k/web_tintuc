@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', __('adminlte::adminlte.verify_message'))

@section('auth_body')

    @if(session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('adminlte::adminlte.verify_email_sent') }}
        </div>
    @endif

    {{ __('adminlte::adminlte.verify_check_your_email') }}.
    <br>
    {{ __('adminlte::adminlte.verify_if_not_recieved') }}.

    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit"   >
            {{ __('adminlte::adminlte.verify_request_another') }}
        </button>
    </form>
    <style>
        button {
        display: inline-block;
        background-color: #7b38d8;
        width: 295px;
        color: #ffffff;
        text-align: center;
        border: 4px double #cccccc;
        border-radius: 10px;
        font-size: 20px;
        cursor: pointer;
        margin: 5px;
        -webkit-transition: all 0.5s; /* add this line, chrome, safari, etc */
        -moz-transition: all 0.5s; /* add this line, firefox */
        -o-transition: all 0.5s; /* add this line, opera */
        transition: all 0.5s; /* add this line */
        }
        button:hover {
        background-color: green;
        }
    </style>
@stop
