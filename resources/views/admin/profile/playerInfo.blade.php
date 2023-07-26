<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

@section('title', 'Players')

@section('content_header')
  <h1>PlayerInfo</h1>
@stop

@section('content')
    <div id="player-index" v-cloak>
        <div class="p-0">
            {{-- 検索フォーム --}}
            <div class="card">
                <div class="card-body small row">
                    <div class="col-md-4">
                        <h1> images show  </h1>
                    </div>
                    <div class="col-md-8 form-group">
                        <h1> player Info </h1>
                    </div>
            </div>
        </div>
    </div>
            
@stop

@section('js')

@stop

