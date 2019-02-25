@extends('admin.master')


@section('title')

  All Projects

@endsection

<!-- Content Header (Page header) -->
@section('content')
  <section class="content-header">
    <h1>
      All Projects
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('administrator')}}"><i class="fa fa-dashboard"></i> Projects</a></li>
      <li class="active">All Projects</li>
    </ol>
  </section>
@endsection

@section('content-full')
<!-- All Blogs -->
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">All Projects</h3>
        
        <h2 class="text-success">{{ Session::has('success') ? Session::get('success') : '' }}</h2>
        <h2 class="text-danger">{{ Session::has('error') ? Session::get('error') : '' }}</h2>

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
                    @php
                        $i = 1;
                    @endphp
                    @foreach( $projects as $project )
                    <tr>
                        <td><a href="#">{{ $i++ }}</a></td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->client_name }}</td>
                        <td><img src="{{ asset('/') . $project->client_logo }}" alt="" height="25"></td>
                        <td>
                            <span class="label {{ $project->status == 0 ? 'label-warning' : 'label-success' }}">{{ $project->status == 0 ? 'Pending' : 'Approved' }}</span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('view-project', ['id' => $project->id]) }}" target="_blank"><span class="label label-info">View</span></a>
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