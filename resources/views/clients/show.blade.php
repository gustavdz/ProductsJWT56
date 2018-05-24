@extends('layouts.app')
@section('topnavbar','Clientes')
@section('body-class','nav-md  footer_fixed')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Clientes</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <ul class="pagination pagination-split">
                                    <li><a href="#">A</a></li>
                                    <li><a href="#">B</a></li>
                                    <li><a href="#">C</a></li>
                                    <li><a href="#">D</a></li>
                                    <li><a href="#">E</a></li>
                                    <li>...</li>
                                    <li><a href="#">W</a></li>
                                    <li><a href="#">X</a></li>
                                    <li><a href="#">Y</a></li>
                                    <li><a href="#">Z</a></li>
                                </ul>
                            </div>

                            <div class="clearfix"></div>
                            @foreach($clients as $index => $client)
                                <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                                    <div class="well profile_view">
                                        <div class="col-sm-12">
                                            <h4 class="brief"><i>Cliente #{{$index+1}}</i></h4>
                                            <div class="left col-xs-7">
                                                <h2>{{ $client->name }} {{ $client->last_name }}</h2>
                                                <ul class="list-unstyled">
                                                    <li><i class="fa fa-envelope"></i> Email: {{ $client->email }}</li>
                                                    <li><i class="fa fa-building"></i> Address: {{ $client->address }}</li>
                                                    <li><i class="fa fa-phone"></i> Phone #: {{ $client->phone }}</li>
                                                </ul>
                                            </div>
                                            <div class="right col-xs-5 text-center">
                                                <img src="{{ $client->profilepicture_filename}}" alt="..." class="img-circle img-responsive">

                                            </div>
                                        </div>
                                        <div class="col-xs-12 bottom text-center">
                                            <div class="col-xs-12 col-sm-6 emphasis">
                                                <p class="ratings">
                                                    <a>4.0</a>
                                                    <a href="#"><span class="fa fa-star"></span></a>
                                                    <a href="#"><span class="fa fa-star"></span></a>
                                                    <a href="#"><span class="fa fa-star"></span></a>
                                                    <a href="#"><span class="fa fa-star"></span></a>
                                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                                </p>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 emphasis">
                                                <button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">
                                                    </i> <i class="fa fa-comments-o"></i> </button>
                                                <button type="button" class="btn btn-primary btn-xs">
                                                    <i class="fa fa-user"> </i> View Profile
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')@endsection