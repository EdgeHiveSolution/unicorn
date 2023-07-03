@extends('layouts.app')
@section('content')
<partner-create-component :user-name="{{ json_encode(Auth::user()->name) }}"></partner-create-component>
@endsection
