@extends('admin.master')


@section('title')

  All Feedbacks

@endsection

<!-- Content Header (Page header) -->
@section('content')
  <section class="content-header">
    <h1>
      All Feedbacks
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('administrator')}}"><i class="fa fa-dashboard"></i> Feedbacks</a></li>
      <li class="active">All Feedbacks</li>
    </ol>
  </section>
@endsection

@section('content-full')
<!-- All Blogs -->
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">All Feedbacks</h3>
        
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
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @if( count($CommonFeedbacks) == 0 )
                <tr>
                    <td colspan="3"><h2 class="text-danger text-center">No Feedback Found!!</h2></td>
                </tr>
                @else
                @php   
                    $i = 1; 
                @endphp
                @foreach( $CommonFeedbacks as $feedback )
                    <tr>
                        <td><a href="#">{{ $i++ }}</a></td>
                        <td>{{ $feedback->feedback }}</td>
                    
                        <td class="text-right">
                            <a href="{{ route('edit-feedback', ['id' => $feedback->id]) }}"><span class="label label-warning">Edit</span></a>
                            <a href="{{ route('delete-feedback', ['id' => $feedback->id]) }}"><span class="label label-danger" onclick="return confirm('Are you sure, to delete this item?')">Delete</span></a>
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
        <a href="{{ route('add-new-feedback') }}" class="btn btn-sm btn-info btn-flat pull-left">Add New</a>
        {{ $CommonFeedbacks->links() }}
        <!-- <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
    </div>
    <!-- /.box-footer -->
</div>
<!-- /.box -->
@endsection    