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

	tbody, th{
		text-align: center
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
			<table class="table table-hover table-striped table-bordered table-condensed" id="roomTable">
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
						<td class="col-md-4">{{ $room->name }}</td>
						<td class="col-md-4">{{ $room->description }}</td>
						<td class="col-md-4" style="padding-left: 7%;padding-right: 7%;">
							{{ Form::open(['method'=>'get','route' => array('room.edit',$room->id)]) }}
							<button class="btn btn-md btn-block btn-warning" name="update" type="submit" value="Update"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <span class="hidden-xs"> Update </span></button>
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
		$('#roomTable').DataTable({
	    	columnDefs:[
				{ targets: 'no-sort', orderable: false },
	    	], 
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