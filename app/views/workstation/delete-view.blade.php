@extends('layouts.master-white')
@section('title')
Workstation
@stop
@section('navbar')
@include('layouts.navbar')
@stop
@section('style')
<link rel="stylesheet" href="{{ url('css/style.css') }}"  />
<style>
	#page-body{
		display: none;
	}
</style>
@stop
@section('content')
<div class="container-fluid">
	@include('workstation.sidebar.default')
	<div class="col-md-10 panel panel-body panel-shadow">
		<table class="table table-hover table-striped table-bordered" id="workstationTable">
			<thead>
				<th>OS</th>
				<th>System Unit</th>
				<th>Monitor</th>
				<th>AVR</th>
				<th>Keyboard</th>
				<th>Mouse</th>
				<th class="no-sort"></th>
			</thead>
			<tbody>
			@forelse($workstations as $workstation)
			<tr>
				<td>{{ $workstation->oskey }}</td>
				<td>{{ $workstation->systemunit->propertynumber }}</td>
				<td>{{ $workstation->monitor->property_number }}</td>
				<td>{{ $workstation->avr->property_number }}</td>
				<td>
				@if ($workstation->keyboard == 1 )
				yes
				@else
				no
				@endif
				</td>
				<td>
				@if ($workstation->mouse == 1 )
				yes
				@else
				no
				@endif
				</td>
				<td>
				{{ Form::open(['method'=>'delete','route' => array('workstation.destroy',$workstation->id),'id'=>'deletionForm']) }}
					{{ Form::button('Condemn',[
						'class'=>'btn btn-sm btn-danger btn-block delete'
					]) }}
				{{ Form::close() }}
				</td>
			</tr>
			@empty
			@endforelse
			</tbody>
		</table>
	</div>
</div>
@stop
@section('script')
<script type="text/javascript">

	$(document).ready(function() {

	  $('.delete').click(function(){
	    swal({
	      title: "Are you sure?",
	      text: "This process is irreversible, do you want to continue?",
	      type: "warning",
	      showCancelButton: true,
	      confirmButtonText: "Yes, i want to continue!",
	      cancelButtonText: "No, cancel it!",
	      closeOnConfirm: false,
	      closeOnCancel: false
	    },
	    function(isConfirm){
	      if (isConfirm) {
	        $("#deletionForm").submit();
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

    $('#workstationTable').DataTable({
			columnDefs:[
			{ targets: 'no-sort', orderable: false },
			],
		});

		$('#page-body').show();
  });
</script>
@stop
