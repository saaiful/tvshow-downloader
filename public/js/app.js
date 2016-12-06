function findTorrent(id, name) {
	swal({
		title: "Find Torrent?",
		text: "",
		type: "info",
		confirmButtonText: "Yes",
		showCancelButton: true,
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
	}, function() {
		$.ajax({
			dataType: "json",
			url: document.url + "/torrent?id=" + id + "&name=" + name,
			type: "GET",
			success: function(data) {
				swal("Torrent Found!", "", "success");
				setTimeout(function() {
					location.reload();
				}, 2000);
			},
			error: function() {
				swal("Something Went Wrong!", "", "error");
			}
		});
	});
}