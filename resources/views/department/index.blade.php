@extends('layouts.app')
@section('content')
<department-component :user-name="{{ json_encode(Auth::user()->name) }}"></department-component>
@endsection

