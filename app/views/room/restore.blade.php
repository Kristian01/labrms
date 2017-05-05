@extends('layouts.master-white')
@section('title')
Room
@stop
@section('navbar')
@include('layouts.navbar')
@stop
@section('style-include')
<style>
	#page-body{
		display: none;
	}

	th,tbody{
		text-align: center;
	}
	.panel-shadow{
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}
</style>
@stop
@section('content')
<div class="container-fluid" id="page-body">
	@include('room.sidebar.default')
	<div class="col-md-10">
		<div class="panel panel-body panel-shadow table-responsive">
			<table class="table table-condensed table-hover table-striped table-bordered" id="roomTable">
				<thead>
					<th>Name</th>
					<th>Description</th>
					<th>Action</th>
				</thead>
				<tbody>
				@if(empty($rooms))
				@else
					@foreach($rooms as $room)
					<tr>
						<td class="col-md-4" >{{ $room->name }}</td>
						<td class="col-md-4" >{{ $room->description }}</td>
						<td class="col-md-4" style="padding-left: 7%;padding-right: 7%;">
							{{ Form::open(['method'=>'put','route' => array('room.restore',$room->id),'id'=>'restoreForm']) }}
							<button class="btn btn-md btn-block btn-default delete" name="delete" type="button" value="Condemn"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"> <span class="hidden-xs"> Restore</span> </span></button>
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
	$(document).ready(function() {
		$('#page-body').show();
		$('#roomTable').DataTable();

		$('.delete').click(function(){
			swal({
				title: "Are you sure?",
				text: "Do you really want to restore this room?",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "Yes, i want to continue!",
				cancelButtonText: "No, cancel it!",
				closeOnConfirm: false,
				closeOnCancel: false
			},
			function(isConfirm){
				if (isConfirm) {
					$("#restoreForm").submit();
				} else {
					swal("Cancelled", "Deletion Cancelled", "error");
				}
			});
		});

		@if( Session::has("success-message") )
			swal("Success!","{{ Session::pull('success-message') }}","success");
		@endif
		@if( Session::has("error-message") )
			swal("Oops...","{{ Session::pull('error-message') }}","error");
		@endif
	} );
</script>
@stop
