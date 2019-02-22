@extends('admin.master')


@section('title')

  Create Feedback

@endsection

<!-- Content Header (Page header) -->
@section('content')
  <section class="content-header">
    <h1>
    Create Feedback
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('administrator') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Create Feedback</li>
    </ol>
  </section>
@endsection

@section('dashboard-left-item')

<div class="box box-info">
  <div class="box-header">
    <i class="fa fa-pencil-square-o"></i>

    <h3 class="box-title">Add Feedback</h3>
    <!-- tools box -->
    <div class="pull-right box-tools">
      <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
              title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
    <!-- /. tools -->
  </div>
  <div class="box-body">
    <form method="POST" action="{{ route('store-feedback') }}">
        @csrf
        <div class="form-group">
            <label for="feedback">Feedback</label>
            <textarea class="form-control" name="feedback" rows="3" id="feedback" placeholder="Write feedback"></textarea>
        </div>

      <div class="box-footer clearfix">
        <button type="submit" class="pull-right btn btn-info" name="save" id="save">Save
          <i class="fa fa-arrow-circle-right"></i></button>
      </div>
    </form>
  </div>
</div>
@endsection