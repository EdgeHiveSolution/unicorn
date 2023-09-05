@extends('layouts.app')
@section('content')


    <department-partner-detail-component  :partner-id="{{ $partner->id }}"   ></department-partner-detail-component>


{{--   
@dd($partner->id) --}}

@endsection
