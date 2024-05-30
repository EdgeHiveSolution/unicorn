@extends('layouts.app')
@section('content')
<dashboard-component :user="{{ json_encode(Auth::user()) }}"
                    :data="{{json_encode($data)}}" ></dashboard-component>

@endsection


