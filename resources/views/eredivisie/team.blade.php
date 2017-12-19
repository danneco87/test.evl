<?php
/**
 * Created by PhpStorm.
 * User: danneco87
 * Date: 07/12/2017
 * Time: 19:51
 */
?>
@extends('adminlte::page')

@section('content_header')
    <h1>HOME</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $teams->name }}</h3>
                    <h4>Points</h4>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-football">{!! MatchesHelper::getTableData($teams->id)['points'] !!}</i>
                </div>
                <a href="{!! route('admin') !!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-minus"></i></span>
                    <h3 class="panel-title">Players</h3>
                </div>
                <div class="panel-body">
                    <table id="players" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Age</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($players as $key => $player)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td><span class="pull-right"><i class="glyphicon glyphicon-user"></i></span><span class="pull-left">{{ $player->name }}</span></td>
                                <td>{{ $player->position }}</td>
                                <td>{{ $player->age }}</td>
                                <td>{{ ucfirst($player->status) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-minus"></i></span>
                    <h3 class="panel-title">Players</h3>
                </div>
                <div class="panel-body">
                    <table id="topScorers" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Games</th>
                            <th>Goals</th>
                            <th>Assist</th>
                            <th>Yellow card</th>
                            <th>Red card</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($goals as $key => $goals)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $goals->name }}</td>
                                <td>{{ $goals->position }}</td>
                                <td>{{ 0 }}</td>
                                <td>{{ 0 }}</td>
                                <td>{{ 0 }}</td>
                                <td>{{ 0 }}</td>
                                <td>{{ 0 }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop

