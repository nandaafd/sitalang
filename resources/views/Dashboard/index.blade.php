@extends('dashboard.layout.main')
@section('content')
@if(Auth::user())
    
    <div>hello {{Auth::user()->fullname}}</div>
    
@endif
    
@endsection