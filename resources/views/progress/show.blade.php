@extends('layouts.app')
@section('content')

@if(Auth::user()->user_role_id === 1 || Auth::user()->user_role_id === 3)
    <progress-all-component :kpimetric-id="{{ $kpimetric->id }}"></progress-all-component>
@else
    <progress-component :kpimetric-id="{{ $kpimetric->id }}" ></progress-component>
@endif

@endsection
