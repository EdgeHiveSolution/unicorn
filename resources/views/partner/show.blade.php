@extends('layouts.app')
@section('content')

    <partner-detail-component :partner="{{ json_encode($partner) }}" :members="{{ json_encode($partner->members) }}"
        :kpimetrics="{{ json_encode($partner->kpimetrics) }}" :kpis="{{ json_encode($partner->kpis) }}">
    </partner-detail-component>
@endsection
