
@section('style-include')
{{ HTML::style(asset('css/jquery.sidr.light.min.css')) }}
{{ HTML::style(asset('css/sidr-style.min.css')) }}
@stop
@section('script-include')
{{ HTML::script(asset('js/jquery.sidr.min.js')) }}
@stop
<div id="sidr" hidden>
	<ul>
		<li role="presentation" id="overview">
			<a href="{{ route('faculty.index') }}" class='text-muted'>Overview
			</a>
		</li>
		<li role="presentation" id="add">
			<a href="{{ route('faculty.create') }}" class='text-muted'> Create
			</a>
		</li>
		<li role="presentation" id="update">
			<a href="{{ route('faculty.update-view') }}" class='text-muted'>Update
			</a>
		</li>
		<li role="presentation" id="remove">
			<a href="{{ route('faculty.delete-view') }}" class='text-muted' >Remove
			</a>
		</li>
	</ul>
</div>

<div class="col-md-12" style="margin-bottom: 10px;">
	<button class="btn btn-default" id="simple-menu" href="#sidr"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <span id="nav-text">Toggle Navigation</span></button>
</div>

<script>
$(document).ready(function() {

	@if(count($active_tab) > 0)
	$('#{{ $active_tab }}').addClass('active');
	@endif

  $('#simple-menu').sidr();

	$('#sidr').show();
});
</script>
