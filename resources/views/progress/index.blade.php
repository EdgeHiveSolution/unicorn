@extends('layouts.app')
@section('content')

    
    <progress-detail-component :progress="{{ json_encode($progress) }}" :progress-id="{{ $progress->id }}"></progress-detail-component>

    {{-- @dd($progress->id) --}}
@endsection
