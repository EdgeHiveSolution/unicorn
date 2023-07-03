@extends('layouts.app')
@section('content')
<configuration-component :user-name="{{ json_encode(Auth::user()->name) }}"></configuration-component>
@endsection



