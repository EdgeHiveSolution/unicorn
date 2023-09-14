@extends('layouts.app')
@section('content')


    <department-member-component :member-id="{{ $member->id }}"></department-member-component>


  


@endsection
