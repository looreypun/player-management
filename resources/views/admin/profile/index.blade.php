@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Profile</h1>
@stop

@section('adminlte_css')
    <style>
        .related_player img {
            width: 50px;
            height: 50px;
        }

        .related_player a {
            color: black;
        }

        .related_player p {
            font-size: 0.8rem
        }
    </style>
@stop

@section('content')
    <div id="player-index" v-cloak>
        <div class="p-0">
            <div class="container">
                <div class="row">
                    <!-- player images   -->
                    <div class="col-md-4">
                        <div class="card shadow p-3 bg-body rounded">
                            <img class="card rounded-circle mx-auto mt-5" src="{{ $user->img_url }}" alt="profile-image">
                            <div class="card-body">
                                <h5 class="text-center text-capitalize">{{ $user->name }}</h5>
                                <p class="my-4">Introduction</p>
                                <p class="card-text">{{ $user->desc }}</p>
                                <h6 class="my-5">Total goal score <span class="badge bg-danger">10</span></h6>
                            </div>
                        </div>
                    </div>
                    <!-- player details  -->
                    <div class="col-md-8">
                        <div class="card shadow p-3 mb-3 bg-body rounded">
                            <h5 class="card-header text-bold dispa">
                                Players Details
                            </h5>
                            <table class="table table-bordered w-100">
                                <tbody>
                                    <tr>
                                        <th class="w-25 bg-light">
                                            <i class="far fa-user mr-2"></i> Name
                                        </th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25 bg-light">
                                            <i class="far fa-envelope mr-2"></i> E-mail
                                        </th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">
                                            <i class="far fa-calendar-alt mr-2"></i> Date of Birth
                                        </th>
                                        <td>{{ $user->age }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">
                                            <i class="far fa-envelope mr-2"></i> Phone
                                        </th>
                                        <td>{{ $user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">
                                            <i class="far fa-address-card mr-2"></i> Position
                                        </th>
                                        <td>{{ $user->position_id }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- releted player  -->
                        <div class="card mt-2 shadow p-3 mb-5 bg-body rounded">
                            <h5 class="card-header text-bold">Related players</h5>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($relatedPlayers as $relatedPlayer)
                                        <div class="col-md-2 related_player">
                                            <a href="{{ route('admin.member.profile', ['id' => $relatedPlayer->id]) }}">
                                                <img src="{{ $relatedPlayer->img_url }}"
                                                    class="card-img-top card rounded-circle mx-auto"
                                                    alt="{{ $relatedPlayer->name }}">
                                                <p class="text-center">{{ $relatedPlayer->name }}</p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

@stop
