<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>TVShow Downloader</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="{{ url('/css/sweetalert.css') }}">
		<script src="https://code.jquery.com/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script src="{{ url('/js/sweetalert.min.js') }}"></script>
		<script src="{{ url('/js/app.js') }}"></script>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script>
			document.url = "{{ url('/') }}";
		</script>
		<style type="text/css">
			.btn-search{margin-top: 25px;}
			#tvs-search-input{margin-bottom: 20px;padding: 3px;border: solid 1px #E4E4E4;border-radius: 6px;background-color: #fff;}
			#tvs-search-input input{border: 0;box-shadow: none;}
			#tvs-search-input button{margin: 2px 0 0 0;background: none;box-shadow: none;border: 0;color: #666666;padding: 0 8px 0 10px;border-left: solid 1px #ccc;}
			#tvs-search-input button:hover{border: 0;box-shadow: none;border-left: solid 1px #ccc;}
			#tvs-search-input .glyphicon-search{font-size: 23px;}
			.btn-radio {width: 100%; margin-bottom: 20px;}
			.img-radio {opacity: 0.5;margin-bottom: 5px;width: 100%;}
			.img-radio:hover {opacity: 1;}
			.space-20 {margin-top: 20px;}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{ url('/') }}">TVShow Downloader</a>
				</div>

				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li><a href="{{ url('/') }}">Shows</a></li>
						<li><a href="{{ url('/whats-new') }}">What's New</a></li>
						<li><a href="{{ url('/new-show') }}">Add New Show</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
		<div class="container">
			@yield('content')
		</div>
		
	</body>
</html>