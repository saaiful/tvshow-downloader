@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table id="aria2list" class="table table-bordered">
				<thead>
					<tr>
						<th>Download Name</th>
						<th>File Size</th>
						<th>Downloaded</th>
						<th>Download Speed</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			{{-- completedLength --}}

			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Show Name</th>
						<th>Previous Episode</th>
						<th>Next Episode</th>
						<th>Season</th>
						<th>Episode</th>
					</tr>
				</thead>
				<tbody>
				@foreach($shows as $key=>$show)
					<tr>
						<td>{{ $show->id }}. <a href="{{ url('show/'.$show->id) }}">{{ $show->name }}</a></td>
						<td>{{ App\ShowMeta::epName($show->p_episode) }}</a></td>
						<td>{{ App\ShowMeta::epName($show->n_episode) }}</a></td>
						<td>{{ $show->season }}</td>
						<td>{{ $show->episode }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-12" align="center">
		{{ $shows->links() }}
	</div>
</div>
<script type="text/javascript">
	function pcom(total,done){
		return (done*100)/total;
	}
	function formatBytes(bytes,decimals) {
		if(bytes == 0) return '0 Byte';
		var k = 1000; // or 1024 for binary
		var dm = decimals + 1 || 3;
		var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
		var i = Math.floor(Math.log(bytes) / Math.log(k));
		return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
	}
	function aria2status() {
		$.ajax({
			dataType: "json",
			url: "{{ url('/aria2-ajax') }}",
			type: "GET",
			success: function(data){
				var html = '';
				$.each(data.result, function(index,value){
					html += "<tr>";
					html += "	<td>"+ value.bittorrent.info.name +"</td>";
					html += "	<td>"+ formatBytes(value.totalLength,1) +"</td>";
					html += "	<td>"+ formatBytes(value.completedLength,1) +" ("+pcom(value.totalLength,value.completedLength)+"%)</td>";
					html += "	<td>"+ formatBytes(value.downloadSpeed,1) +"</td>";
					html += "	<td><a href='{{ url('/aria2-remove') }}?id=" + value.gid + "'>Remove</a></td>";
					html += "</tr>";
				});

				if(data.result.length!=0){
					$("#aria2list").show();
					$("#aria2list>tbody").html(html);
				}else{
					$("#aria2list").hide();
				}
			}
		});
	}
	aria2status();
	setInterval(aria2status, 3000);
</script>
@endsection