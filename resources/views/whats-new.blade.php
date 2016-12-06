@extends('layouts.app')
@section('content')
<div class="row">
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Show Name</th>
					<th>Episode Title</th>
					<th>Season</th>
					<th>Episode</th>
					<th>OnAir</th>
					<th>Torrent</th>
				</tr>
			</thead>
			<tbody>
			@foreach($shows as $show)
				<tr>
					<td>{{ $show->show->name }}</td>
					<td>{{ $show->name }}</td>
					<td>{{ $show->season }}</td>
					<td>{{ $show->episode }}</td>
					<td>{{ $show->schedule }} {{ $show->show->schedule }}</td>
					<td>
					@if($show->magnet)
						<a href="{{ $show->magnet }}">Torrent</a>
					@else						
						<a href="javascript:{};" onclick='findTorrent("{{ $show->id }}","{{ $show->show->name.sprintf(" S%02dE%02d",$show->season,$show->episode) }}");'>Find</a>
					@endif
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection