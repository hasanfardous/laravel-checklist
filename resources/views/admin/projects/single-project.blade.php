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
        <table class="table no-margin single-project">
            <thead>
                <tr>
                    <th>All Feedbacks</th>
                    <th class="text-right">&nbsp;</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        $i = 1;
                        function dynamicClass($feedback_status){
                            if($feedback_status == 1){
                                return 'approved';
                            }elseif($feedback_status == 2){
                                return 'rejected';
                            }
                        }
                    ?>
                    @if( count($feedbacks) == 0 )
                        <tr>
                            <td colspan="2"><h2 class="text-danger text-center">No Feedback Found!!</h2></td>
                        </tr>
                    @else
                        @foreach( $feedbacks as $feedback )
                        <tr id="feedbackNum{{$feedback->id}}" class="{{ dynamicClass($feedback->feedback_status) }}">
                            <td>
                                <b>{{ $i++. '. ' .$feedback->feedback }}</b><br>
                                &nbsp; &nbsp; &nbsp;<span id="feedbackSecLine{{$feedback->id}}">{{ $feedback->feedback_sec ? $feedback->feedback_sec : 'No feedback yet' }}</span> 
                                
                            </td>
                            <td>
                                <textarea name="feedback_sec" data-feedbackid="{{$feedback->id}}" id="feedbackSec{{$feedback->id}}" cols="30" rows="10" style="width: 100%; height: 35px; outline: none; display:none; padding: 2px 7px; border: 1px solid #bbb;" placeholder="Add your comment here"></textarea>
                                <a href="" id="addFeedbackSec{{$feedback->id}}" style="display: none"><span class="label label-success">Add comment</span></a>
                                <span id="#feedbackSecMsg{{$feedback->id}}" class="text-success" style="opacity:0"><b>Feedback added successfully!</b></span>
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

                                    // $('#feedbackSec{{$feedback->id}}').fadeOut();
                                    // $('#addFeedbackSec{{$feedback->id}}').fadeOut();
                                    $('#feedbackNum{{$feedback->id}}').removeClass('rejected');
                                    $('#feedbackNum{{$feedback->id}}').addClass('approved');

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
                                    $('#feedbackNum{{$feedback->id}}').removeClass('approved');
                                    $('#feedbackNum{{$feedback->id}}').addClass('rejected');

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

                                $("#addFeedbackSec{{$feedback->id}}").click(function(e){
                                    e.preventDefault();
                                    $('#feedbackSec{{$feedback->id}}').fadeOut();
                                    $('#addFeedbackSec{{$feedback->id}}').fadeOut();
                                    // $('#feedbackSecMsg{{$feedback->id}}').fadeIn();
                                    

                                    let feedbackId = $(this).attr("data-feedbackid");
                                    var feedbackSec = $('#feedbackSec{{$feedback->id}}').val();
                                    $('#feedbackSecLine{{$feedback->id}}').text(feedbackSec);
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{ route("secondary-feedback", ["id" => $feedback->id]) }}',
                                        dataType: 'json',
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                        data: {id:feedbackId,"_token": "{{ csrf_token() }}", feedbackSec:feedbackSec},

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
                                    // this.fadeOut();
                                    $.ajax({
                                        type: 'GET',
                                        url: '{{ route("delete-feedback", ["id" => $feedback->id]) }}',
                                        dataType: 'json',
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                        data: {id:deleteId,"_token": "{{ csrf_token() }}"},

                                        success: function (data) {
                                                // alert(data.responseText);
                                        },
                                        error: function (data) {
                                                // alert(data.responseText);
                                        }
                                    });


                                    $('#feedbackNum{{$feedback->id}}').fadeOut();
                                });
                            </script>
                        </tr>
                        @endforeach
                    @endif
                    
                    <tr>
                        <td>
                            <form method="POST" action="{{ route('new-feedback-add') }}">
                                @csrf
                                <input type="text" name="newFeedback" id="newFeedback" class="form-control" placeholder="Add new feedback" style="width: 100%; display: none">
                                <input type="hidden" name="project_id" value="{{$project_id}}">

                                <button type="submit" id="submitNewFeedback" class="label label-success" name="save" id="save" style="display: none; border: none">Add Feedback</button>
                                {{-- <a href="{{route('new-feedback-add', ['project_id' => $project_id])}}" id="submitNewFeedback" style="display: none"><span class="label label-success">Add Feedback</span></a> --}}

                            </form>
                        </td>
                    </tr>
            </tbody>
        </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <a href="" class="btn btn-sm btn-info btn-flat pull-left hasan" id="addNewFeedback">Add New Feedback</a>
        
    </div>


    <script>
        $("#addNewFeedback").click(function(e){
            e.preventDefault();
            $('#newFeedback').fadeIn();
            $('#submitNewFeedback').fadeIn();
            $(this).attr('disabled', 'disabled');
        });

        // $("#submitNewFeedback").click(function(e){
        //     e.preventDefault();
        //     $('#newFeedback').fadeOut();
        //     $('#submitNewFeedback').fadeOut();
        // });
    </script>
    <!-- /.box-footer -->
</div>
<!-- /.box -->
@endsection    