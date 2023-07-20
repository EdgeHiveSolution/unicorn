@extends('layouts.app')
@section('content')
<partner-detail-component  :partner="{{ json_encode($partner) }}" :members="{{ json_encode($partner->members) }}"></partner-detail-component>
@endsection
