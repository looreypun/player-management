<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
  <h1>Dashboard</h1>
@stop

@section('content')
    <div class="wrapper">
        <div id="body" class="active">
            <div class="container">
                <div class="row">
                    @foreach ($cards as $card)
                        <div class="col-sm-6 col-lg-3 mt-3">
                            <div class="card {{ $card['bg_color'] }}">
                                <p class="text-center mt-2"><i class="{{ $card['icon'] }}"></i> {{ $card['subtitle'] }}</p>
                                <p class="text-center">{{ $card['number'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12 row m-0 p-0">
                        @foreach ($charts as $chart)
                            <div class="col-md-6">
                                <div class="card p-2">
                                    <div class="head">
                                        <h5 class="mb-0">{{ $chart['title'] }}</h5>
                                        <p class="text-muted">{{ $chart['description'] }}</p>
                                    </div>
                                    <div class="canvas-wrapper">
                                        <canvas class="chart" id="{{ $chart['chart_id'] }}"></canvas>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <div class="card p-2">
                            <h5 class="mb-0">Top Contributors</h5>
                            <p class="text-muted">Current year top contributors</p>
                            <table class="table table-striped">
                                <thead class="success">
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contributors as $contributor)
                                        <tr>
                                            <td>{{ $contributor->name}}</td>
                                            <td class="text-end">¥{{ $contributor->amount}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-2">
                            <h5 class="mb-0">Most Visited Pages</h5>
                            <p class="text-muted">Current year website visitor data</p>
                            <table class="table table-striped">
                                <thead class="success">
                                    <tr>
                                        <th>Page Name</th>
                                        <th class="text-end">Visitors</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pages as $page)
                                        <tr>
                                            <td><i class="fas fa-link text-primary"></i> {{ $page['page_name']}}</td>
                                            <td class="text-end">{{ $page['visitors']}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        let posChartLabels = @json($position_chart['labels']);
        let posChartData = @json($position_chart['data']);
        let contChartLabels = @json($contribution_chart['labels']);
        let contChartData = @json($contribution_chart['data']);
    </script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@stop
