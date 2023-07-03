@extends('layouts.app')
@section('content')
<partner-component :user-name="{{ json_encode(Auth::user()->name) }}"></partner-component>
@endsection
