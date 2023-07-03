@extends('layouts.app')
@section('content')
<dashboard-component :user-name="{{ json_encode(Auth::user()->name) }}"></dashboard-component>
@endsection


