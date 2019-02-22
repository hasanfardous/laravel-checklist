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
                    <th>All Feedbacks</th>
                    <th class="text-right">&nbsp;</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                    @php($i = 1)
                    @foreach( $feedbacks as $feedback )
                    <tr>
                        <td>
                            <b>{{ $i++. '. ' .$feedback->feedback }}</b><br>
                            &nbsp; &nbsp; &nbsp;{{ $feedback->feedback_sec ? $feedback->feedback_sec : 'No feedback yet' }}
                            
                        </td>
                        <td>
                            <textarea name="feedback_sec" id="feedbackSec{{$feedback->id}}" cols="30" rows="10" style="width: 100%; height: 35px; outline: none; display:none"></textarea>
                            <a href="" id="addFeedbackSec{{$feedback->id}}" style="display: none"><span class="label label-success">Add comment</span></a>
                        </td>
                        <td class="text-right">
                            <a href="" data-approveid="{{$feedback->id}}" id="appFeed{{$feedback->id}}"><span class="label label-{{$feedback->feedback_status == 1 ? 'success' : 'default'}}">{{$feedback->feedback_status == 1 ? 'Approved' : 'Approve'}}</span></a>
                            <a href="" data-rejectid="{{$feedback->id}}" id="rejFeed{{$feedback->id}}"><span class="label label-{{$feedback->feedback_status == 2 ? 'warning' : 'default'}}">{{$feedback->feedback_status == 2 ? 'Rejected' : 'Reject'}}</span></a>
                            <a href="" data-deleteid="{{$feedback->id}}" id="delFeed{{$feedback->id}}"><span class="label label-danger" onclick="return confirm('Are you sure, to delete this item?')">Delete</span></a>
                        </td>

                        <script>
                            $("#appFeed{{$feedback->id}}").click(function(e){
                                e.preventDefault();
                                
                                $(this).find('span').removeClass('label-default');
                                $(this).find('span').addClass('label-success');
                                $(this).find('span').text('Approved');

                                $('#rejFeed{{$feedback->id}}').find('span').removeClass('label-warning');
                                $('#rejFeed{{$feedback->id}}').find('span').addClass('label-default');
                                $('#rejFeed{{$feedback->id}}').find('span').text('Reject');

                                let approveId = $(this).attr("data-approveid");
                                $.ajax({
                                    type: 'GET',
                                    url: '{{ route("approve-feedback", ["id" => $feedback->id]) }}',
                                    dataType: 'json',
                                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                    data: {id:approveId,"_token": "{{ csrf_token() }}"},

                                    success: function (data) {
                                            // alert(data.responseText);
                                    },
                                    error: function (data) {
                                            // alert(data.responseText);
                                    }
                                });
                            });

                            $("#rejFeed{{$feedback->id}}").click(function(e){
                                e.preventDefault();

                                $(this).find('span').removeClass('label-default');
                                $(this).find('span').addClass('label-warning');
                                $(this).find('span').text('Rejected');

                                $('#appFeed{{$feedback->id}}').find('span').removeClass('label-success');
                                $('#appFeed{{$feedback->id}}').find('span').addClass('label-default');
                                $('#appFeed{{$feedback->id}}').find('span').text('Approve');
                                $('#feedbackSec{{$feedback->id}}').show();
                                $('#addFeedbackSec{{$feedback->id}}').show();

                                let rejectId = $(this).attr("data-rejectid");
                                $.ajax({
                                    type: 'GET',
                                    url: '{{ route("reject-feedback", ["id" => $feedback->id]) }}',
                                    dataType: 'json',
                                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                    data: {id:rejectId,"_token": "{{ csrf_token() }}"},

                                    success: function (data) {
                                            // alert(data.responseText);
                                    },
                                    error: function (data) {
                                            // alert(data.responseText);
                                    }
                                });
                            });

                            $("#delFeed{{$feedback->id}}").click(function(e){
                                e.preventDefault();

                                let deleteId = $(this).attr("data-deleteid");
                                $.ajax({
                                    type: 'GET',
                                    url: '{{ route("delete-feedback", ["id" => $feedback->id]) }}',
                                    dataType: 'json',
                                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                    data: {id:deleteId,"_token": "{{ csrf_token() }}"},

                                    success: function (data) {
                                            alert(data.responseText);
                                    },
                                    error: function (data) {
                                            alert(data.responseText);
                                    }
                                });
                            });
                        </script>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <!-- <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
    </div>
    <!-- /.box-footer -->
</div>
<!-- /.box -->
@endsection    