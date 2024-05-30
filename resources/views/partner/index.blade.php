@extends('layouts.app')
@section('content')
@include("inc.status")
<partner-component :user-name="{{ json_encode(Auth::user()->name) }}"></partner-component>
@endsection
