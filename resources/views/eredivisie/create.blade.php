<?php
/**
 * Created by PhpStorm.
 * User: danneco87
 * Date: 14/12/2017
 * Time: 15:51
 */
?>
@extends('adminlte::page')

@section('content_header')
    <h1>ADD NEW TEAM</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">Add new eredivisie team</h2>
                </div>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'teams.store','method'=>'POST')) !!}
                        @include('eredivisie.forms.create')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
