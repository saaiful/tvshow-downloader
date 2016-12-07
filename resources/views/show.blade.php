@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-4">
		<h3>{{ $show->name }}</h3>
		<img style="width: 100%" src="{{ $show->cover }}" alt="{{ $show->name }}"><br><br>
		<button onclick="updateInfo();" type="button" class="btn btn-block btn-info">Update Information</button><br>
		<div class="alert alert-info">
			<strong>Season</strong>: {{ $show->season }}
		</div>
		<div class="alert alert-info">
			<strong>Episode</strong>: {{ $show->episode }}
		</div>

	</div>
	<div class="col-md-8">
		<p>{!! $show->summary !!}</p>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Title</th>
					<th>Season</th>
					<th>Episode</th>
					<th>AirDate</th>
					<th>Torrent</th>
				</tr>
			</thead>
			<tbody>
			@foreach($ep as $key=>$e)
				<tr class="{{ ($e->schedule<date('Y-m-d'))? 'info' : '' }}">
					<td>{{ $e->name }}</td>
					<td>{{ $e->season }}</td>
					<td>{{ $e->episode }}</td>
					<td>{{ $e->schedule }}</td>
					<td>
						@if($e->magnet)
							<a href="{{ $e->magnet }}">Torrent</a>
						@else						
							<a href="javascript:{};" onclick='findTorrent("{{ $e->id }}","{{ $e->show->name.sprintf(" S%02dE%02d",$e->season,$e->episode) }}");'>Find &amp; Download</a>
						@endif
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	function updateInfo() {
		$.ajax({
			dataType: "json",
			url: "{{ url('/add-show-ajax?id='.$show->tvmaze_id) }}",
			type: "GET",
			success: function(data){
				swal("Details Updated!","","success");
				setTimeout(function() {
					window.location.reload();
				}, 2000);
			}
		});
	}
</script>
@endsection