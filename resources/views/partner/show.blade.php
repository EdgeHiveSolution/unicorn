@extends('layouts.app')
@section('content')


    <partner-detail-component :partner="{{ json_encode($partner) }}" :members="{{ json_encode($partner->members) }}"
        :kpimetrics="{{ json_encode($partner->kpimetrics) }}" :kpis="{{ json_encode($partner->kpis) }}"  :department="{{ json_encode($partner->department) }}"   
        >  


    </partner-detail-component>



@endsection
