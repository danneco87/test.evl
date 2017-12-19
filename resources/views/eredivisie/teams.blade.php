<?php
/**
 * Created by PhpStorm.
 * User: danneco87
 * Date: 29/11/2017
 * Time: 14:15
 */
?>
@extends('adminlte::page')

@section('content_header')
    <h1>EREDIVISIE</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>150 Punten</h3>
                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>150</h3>

                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>150</h3>

                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="big-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>150</h3>

                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Table
                    </h3>
                </div>
                <div class="box-body">
                    <table id="teams" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="index">#</th>
                            <th>Team</th>
                            <th>Matches</th>
                            <th>Wins</th>
                            <th>Draws</th>
                            <th>Losses</th>
                            <th>GF</th>
                            <th>GA</th>
                            <th>GD</th>
                            <th>Points</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teams as $key => $team)
                            <tr>
                                <td></td>
                                <td><a href="{!! route('team', [$team->id]) !!}">{{ $team->name }}</a></td>
                                <td>{!! MatchesHelper::getTableData($team->id)['matches'] !!}</td>
                                <td>{!! MatchesHelper::getTableData($team->id)['wins'] !!}</td>
                                <td>{!! MatchesHelper::getTableData($team->id)['draws'] !!}</td>
                                <td>{!! MatchesHelper::getTableData($team->id)['losses'] !!}</td>
                                <td>{!! MatchesHelper::getTableData($team->id)['goalsFor'] !!}</td>
                                <td>{!! MatchesHelper::getTableData($team->id)['goalsAgainst'] !!}</td>
                                <td>{!! MatchesHelper::getTableData($team->id)['goalsDifference'] !!}</td>
                                <td>{!! MatchesHelper::getTableData($team->id)['points'] !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Top Scorer
                    </h3>
                </div>
                <div class="box-body">
                    <table id="topScorers" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="index">#</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Goals</th>
                            <th>Penalty</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($goals as $key => $goals)
                            <tr>
                                <td></td>
                                <td>{{ $goals->name }}</td>
                                <td>{{ $goals->position }}</td>
                                <td>{{ 0 }}</td>
                                <td>{{ 0 }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop
