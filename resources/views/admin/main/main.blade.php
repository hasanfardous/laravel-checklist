@extends('admin.master')

@section('title')

  Admin Main Page

@endsection

<!-- Content Header (Page header) -->
@section('content')
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
@endsection


@section('dashboard-left-item')
<!-- Quick Blog Post -->
<div class="box box-info">
  <div class="box-header">
    <i class="fa fa-pencil-square-o"></i>

    <h3 class="box-title">Make a Project</h3>
    <!-- tools box -->
    <div class="pull-right box-tools">
      <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
              title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
    <!-- /. tools -->
  </div>
  <div class="box-body">
    <form method="POST" action="{{ route('store-project') }}" enctype="multipart/form-data">
        @csrf
      <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Project Name">
      </div>

      <div class="form-group">
        <input type="text" class="form-control" name="client_name" placeholder="Client Name">
      </div>
      
      <div class="form-group">
        <label for="clientImage">Client Image</label>
        <input type="file" id="clientImage" name="client_image">

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

@section('dashboard-right-item')
<!-- All Blogs -->
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">All Projects</h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Project Name</th>
                    <th>Client Name</th>
                    <th>Client Logo</th>
                    <th>Status</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @if( count($projects) == 0 )
                <tr>
                    <td colspan="7"><h2 class="text-danger text-center">No Projects Found!!</h2></td>
                </tr>
                @else
                    @foreach( $projects as $project )
                    <tr>
                        <td><a href="#">{{ $project->id }}</a></td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->client_name }}</td>
                        <td><img src="{{ asset('/') . $project->client_logo }}" alt="" height="25"></td>
                        <td>
                            <span class="label {{ $project->status == 0 ? 'label-warning' : 'label-success' }}">{{ $project->status == 0 ? 'Pending' : 'Approved' }}</span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('view-project', ['id' => $project->id]) }}"><span class="label label-info">View</span></a>
                            <a href="{{ route('edit-project', ['id' => $project->id]) }}"><span class="label label-warning">Edit</span></a>
                            <a href="{{ route('delete-project', ['id' => $project->id]) }}"><span class="label label-danger" onclick="return confirm('Are you sure, to delete this item?')">Delete</span></a>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <a href="{{ route('add-new-project') }}" class="btn btn-sm btn-info btn-flat pull-left">Add New Project</a>
        {{ $projects->links() }}
        <!-- <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
    </div>
    <!-- /.box-footer -->
</div>
<!-- /.box -->
@endsection    

