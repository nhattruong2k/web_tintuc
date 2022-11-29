@extends('layouts.index')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cấp vai trò user: {{$user->name}}</div>
                <div class="card-body">
                    <form action="{{url('/insert_roles', [$user->id])}}" method="POST">
                        @csrf
                        @foreach($role as $key=>$r)
                            @if(isset($all_column_roles))
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" value="{{$r->name}}" 
                                    {{$r->id == $all_column_roles->id ? 'checked' : ''}}
                                    type="radio" name="role" 
                                    id="{{$r->id}}">

                                    <label class="form-check-label" for="{{$r->id}}">{{$r->name}}</label>
                                </div>
                                @else
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" value="{{$r->name}}" 
                                    type="radio" name="role" 
                                    id="{{$r->id}}">
                                    <label class="form-check-label" for="{{$r->id}}">{{$r->name}}</label>
                                </div>
                            @endif
                        @endforeach
                        <br>
                        <div class="mt-3">
                            <input type="submit" name="insertroles" value="Cấp vai trò cho user" class="btn btn-success">
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
