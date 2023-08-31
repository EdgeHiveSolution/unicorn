@extends('layouts.app')
<style>
    .encircle {
        padding: 3px;
        border-radius: 50%;
        background-color: rgba(128, 128, 128, 0.089);
        color: rgba(24, 23, 23, 0.911);
    }
</style>
@section('content')
    <department-detail-component :department="{{ json_encode($department) }}" :members="{{ json_encode($department->members) }}" :partners="{{ json_encode($department->partners) }}">

    
    </department-detail-component>

 
@endsection
