@extends('dashboard.layout.main')
@section('content')
    <div>hello {{Auth::user()->fullname}}</div>
    
@endsection