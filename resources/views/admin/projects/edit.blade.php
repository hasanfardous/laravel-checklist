@extends('admin.master')


@section('title')

  Edit Project

@endsection

<!-- Content Header (Page header) -->
@section('content')
  <section class="content-header">
    <h1>
    Edit Project
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('administrator') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Edit Project</li>
    </ol>
  </section>
@endsection

@section('dashboard-left-item')

<div class="box box-info">
  <div class="box-header">
    <i class="fa fa-pencil-square-o"></i>

    <h3 class="box-title">Edit Project</h3>
    <!-- tools box -->
    <div class="pull-right box-tools">
      <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
              title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
    <!-- /. tools -->
  </div>
  <div class="box-body">
    <form method="POST" action="{{ route('update-project', ['id' => $project->id]) }}" enctype="multipart/form-data">
        @csrf
      <div class="form-group">
        <input type="text" class="form-control" value="{{ $project->name }}" name="name" placeholder="Project Name">
      </div>

      <div class="form-group">
        <input type="text" class="form-control" value="{{ $project->client_name }}" name="client_name" placeholder="Client Name">
      </div>
      
      <div class="form-group">
        <label for="clientImage">Client Image</label>
        <input type="file" id="clientImage" name="client_image">
        <img src="{{ asset('/') . $project->client_logo }}" alt="" width="60">
        <p class="help-block">Upload Client image here.</p>
      </div>

      <div class="box-footer clearfix">
        <button type="submit" class="pull-right btn btn-default" name="save" id="save">Save
          <i class="fa fa-arrow-circle-right"></i></button>
      </div>
    </form>
  </div>
</div>
@endsection