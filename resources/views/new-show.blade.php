@extends('layouts.app')
@section('content')
<div class="row">
	<form action="#" method="post" onsubmit="searchTvmaze();">
		<div class="col-md-12">
			<div id="tvs-search-input">
				<div class="input-group col-md-12">
					<input type="text" id="show_name" class="form-control input-lg" placeholder="Enter TV Show Name" />
					<span class="input-group-btn">
						<button onclick="searchTvmaze();" class="btn btn-info btn-lg" type="button">
							<i class="glyphicon glyphicon-search"></i>
						</button>
					</span>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="row" id="results">
        	</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	function searchTvmaze() {
		$.ajax({
			dataType: "json",
			url: "http://api.tvmaze.com/search/shows?q=" + $("#show_name").val(),
			type: "GET",
			success: function(data){
				var html = '';
				$.each(data,function(index,value){
					try{
						html += '<div class="col-md-3">';
						html += '	<img src="' + value.show.image.medium + '" class="img-responsive img-radio">';
						html += '	<button type="button" onclick="addShow(\''+ value.show.id +'\');" class="btn btn-primary btn-radio">' + value.show.name + '</button>';
						html += '	<input type="checkbox" id="left-item" class="hidden">';
						html += '</div>';
					} catch ( e ) {}
				});
				$("#results").html(html);
				searchResult();
			}
		});
	}

	function searchResult(){
	    $('.btn-radio').click(function(e) {
	        $('.btn-radio').not(this).removeClass('active')
	    		.siblings('input').prop('checked',false)
	            .siblings('.img-radio').css('opacity','0.5');
	    	$(this).addClass('active')
	            .siblings('input').prop('checked',true)
	    		.siblings('.img-radio').css('opacity','1');
	    });
	}
	function addShow(id) {
		swal({
			title: "Add Show?",
			text: "Do you want to add this show in you list?",
			type: "info",
			confirmButtonText: "Yes",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		},
		function(){
			$.ajax({
				dataType: "json",
				url: "{{ url('/add-show-ajax') }}?id=" + id,
				type: "GET",
				success: function(data){
					swal("New Show Added!","","success");
				},
				error:function(){
					swal("Something Went Wrong!","","error");
				}
			});
		});
	}

	$("form").submit(function(e){
		searchTvmaze();
        e.preventDefault();
    });
</script>
@endsection