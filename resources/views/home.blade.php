<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-header bg-danger">
                    <h2 class="card-title">Welcome to the Dashboard</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">Hello there!</p>
                    <p class="card-text">Feel free to explore the dashboard and manage your account.</p>
                    <a href="#" class="btn btn-dark">Get Started</a>
                </div>
            </div>
        </div>
    </div>
@stop
