<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    {{-- yeha chai css --}}
@stop

@section('content_header')
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <h1>Dashboard</h1>
@stop

@section('content')
{{-- yeha chai timro main code haru --}}
@stop

@section('js')
<scirp>
    {{-- yesko vitra script --}}
</scirp>
@stop
