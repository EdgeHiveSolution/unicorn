@extends('layouts.app')
@section('content')
<department-create-component :causer_id="{{ json_encode(Auth::user()->id) }}"></department-create-component>
@endsection
