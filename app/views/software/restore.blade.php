@extends('layouts.master-white')
@section('title')
Software
@stop
@section('navbar')
@include('layouts.navbar')
@stop
@section('style-include')
<style>
	#page-body{
		display: none;
	}

  .panel-shadow{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
</style>
@stop
@section('script-include')
<script src="{{ asset('js/jQuery.succinct.min.js') }}"></script>
@stop
@section('content')
<div class="container-fluid" id="page-body">
	@include('software.sidebar.default')
	<div class="col-md-10">
		<div class="panel panel-body panel-shadow table-responsive">
			<table class="table table-hover table-striped table-bordered" id='softwareTable'>
				<thead>
					<th>Software name</th>
					<th>License type</th>
					<th>Software type</th>
					<th>Minimum Requirements</th>
					<th>Maximum Requirements</th>
					<th class="no-sort"></th>
				</thead>
				<tbody>
				@if( count($softwares) == 0)
				@else
					@foreach( $softwares as $software )
					<tr>
						<td>
						 <span class="truncate">{{{ $software->softwarename }}}</span>
						 @if(isset($software->softwarename) && strlen($software->softwarename) > 20 )
						 <a tabindex="0" class="btn btn-link" role="button" data-toggle="popover" data-trigger="focus" data-content="{{{ $software->softwarename }}}">more</a>
						 @endif
					 </td>
					 <td>
						 <span class="truncate">{{{ $software->licensetype }}}</span>
						 @if(isset($software->licensetype) && strlen($software->licensetype) > 20 )
						 <a tabindex="0" class="btn btn-link" role="button" data-toggle="popover" data-trigger="focus" data-content="{{{ $software->licensetype }}}">more</a>
						 @endif
					 </td>
					 <td>
						 <span class="truncate">{{{ $software->softwaretype }}}</span>
						 @if(isset($software->softwaretype) && strlen($software->softwaretype) > 20 )
						 <a tabindex="0" class="btn btn-link" role="button" data-toggle="popover" data-trigger="focus" data-content="{{{ $software->softwaretype }}}">more</a>
						 @endif
					 </td>
						<td>
							<span class="truncate">{{{ $software->minsysreq }}}</span>
							@if(isset($software->minsysreq) && strlen($software->minsysreq) > 20 )
							<a tabindex="0" class="btn btn-link" role="button" data-toggle="popover" data-trigger="focus" data-content="{{{ $software->minsysreq }}}">more</a>
							@endif
						</td>
						<td>
							<span class="truncate">{{{ $software->maxsysreq }}}</span>
							@if(isset($software->maxsysreq) && strlen($software->maxsysreq) > 20 )
							<a tabindex="0" class="btn btn-link" role="button" data-toggle="popover" data-trigger="focus" data-content="{{{ $software->maxsysreq }}}">more</a>
							@endif
						</td>
						<td>
							{{ Form::open(['method'=>'post','route' => array('software.restore',$software->id),'id'=>'restoreForm']) }}
							{{ Form::button('Restore',[
								'class'=>'btn btn-sm btn-danger btn-block restore',
								'name'=>'view'
							]) }}
							{{ Form::close() }}
						</td>
					</tr>
					@endforeach
				@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
@section('script')
<script type="text/javascript">
	$(document).ready(function(){

		$('.restore').click(function(){
			swal({
			  title: "Are you sure?",
			  text: "This software will be restored!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes, restore it!",
			  cancelButtonText: "No, cancel it!",
			  closeOnConfirm: false,
			  closeOnCancel: false
			},
			function(isConfirm){
			  if (isConfirm) {
					$("#restoreForm").submit();
			  } else {
			    swal("Cancelled", "Restoration Cancelled", "error");
			  }
			});
		});

		$('#softwareTable').dataTable({
	    	columnDefs:[
				{ targets: 'no-sort', orderable: false },
	    	],
    });

    $('[data-toggle="popover"]').popover();

		@if( Session::has("success-message") )
		swal("Success!","{{ Session::pull('success-message') }}","success");
		@endif
		@if( Session::has("error-message") )
		swal("Oops...","{{ Session::pull('error-message') }}","error");
		@endif

    $('.truncate').succinct({
        size: 20
    });

		$('#page-body').show();
	});
</script>
@stop
