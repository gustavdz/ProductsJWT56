@extends('layouts.app')
@section('topnavbar','Usuarios')
@section('body-class','nav-md  footer_fixed')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left top_search">
                    <div class="input-group">
                        <h3>Usuarios</h3>
                    </div>
                </div>
            </div>

            <div class="title_right">
                <form method="get" action="{{ url('/users') }}">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                          <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">

                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            </div>
                            <div class="clearfix "></div>

                            @foreach($users as $index => $user)
                                <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                                    <div class="well profile_view">
                                        <div class="col-sm-12">
                                            <h4 class="brief"><i>Usuario #{{$index+1}}</i></h4>
                                            <div class="left col-xs-7">
                                                <h2>{{ $user->name }}</h2>
                                                <ul class="list-unstyled">
                                                    <li><i class="fa fa-envelope"></i> Email: <br>{{ $user->email }}</li>
                                                    <li><i class="fas fa-address-card"></i> Username: <br>{{ $user->username }}</li>
                                                </ul>
                                            </div>
                                            <div class="right col-xs-5 text-center">
                                                <img src="{{ $user->profilepicture_filename}}" alt="..." class="img-circle img-responsive">

                                            </div>
                                        </div>
                                        <div class="col-xs-12 bottom text-center">
                                            <div class="col-xs-12 col-sm-6 emphasis">
                                                <p class="ratings">
                                                    <a>4.0</a>
                                                    <a href="#"><span class="fas fa-star"></span></a>
                                                    <a href="#"><span class="fas fa-star"></span></a>
                                                    <a href="#"><span class="fas fa-star"></span></a>
                                                    <a href="#"><span class="fas fa-star"></span></a>
                                                    <a href="#"><span class="far fa-star"></span></a>
                                                </p>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 emphasis">
                                                <a href="{{url('/users/password/'.$user->id)}}" class="btn btn-success btn-xs"> <i class="fa fa-key">
                                                    </i> Reset Password</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="row">{{$users->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')@endsection