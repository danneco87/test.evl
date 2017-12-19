<?php
/**
 * Created by PhpStorm.
 * User: danneco87
 * Date: 14/12/2017
 * Time: 16:51
 */
?>
{!! Form::open(
  array(
    'route' => 'teams.create',
    'class' => 'form')
  ) !!}

@if (count($errors) > 0)
    <div class="alert alert-danger">
        There were some problems adding the team.<br />
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{  $error  }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group">
    {!! Form::label('Team name') !!}
    {!! Form::text('name', null,
      array(
        'class'=>'form-control',
        'placeholder'=>'Add Name',
        'required'=> true
      )) !!}
    {!! Form::label('Shortname') !!}
    {!! Form::text('short_name', null,
      array(
        'class'=>'form-control',
        'placeholder'=>'Add shortname',
        'required'=> true
      )) !!}
    {!! Form::label('Api ID') !!}
    {!! Form::text('api_id', null,
      array(
        'class'=>'form-control',
        'placeholder'=>'Add API ID',
        'required'=> false
      )) !!}
    {!! Form::label('Season') !!}
    {!! Form::text('season', null,
      array(
        'class'=>'form-control',
        'placeholder'=>'Add Season',
        'required'=> true
      )) !!}
</div>

<div class="form-group">
    {!! Form::submit('Add team!',
      array('class'=>'btn btn-primary'
    )) !!}
</div>
