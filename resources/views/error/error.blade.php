<html>
	<head>
		<title>Error</title>
		<link rel="stylesheet" href="{{asset('css/animate.css')}}">
		<style>
			:root {
				--primary: #08387F;
			}
			.container {
				width: 80%;
				margin: 0 auto;
				display: grid;
				place-items: center;
			}

			.jumbotron {
				font-size: 200%;
				text-align: center;
			}

			.large {
				font-size: 150px;
				letter-spacing: 30px;
				font-family: sans-serif;
				font-weight: bolder;
				margin-bottom: 0;
			}

			.text-primary {
				color: steelblue;
			}

			.text-danger {
				color: orangered;
			}

			.btn {
				display: inline-block;
				padding: 4px 40px;
				background: var(--primary);
				color: white;
				text-align: center;
				text-decoration: none;
				font-size: 30px;
				border: none;
				border-radius: 4px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="jumbotron animated shake">
				<p class="large">404</p>
				<p><span class="text-danger">Sorry!</span> No search Results found for <span class="text-primary">{{$query}}</span></p>
				<a href="/gallery" class="btn btn-primary">Back</a>
			</div>
		</div>
	</body>
</html>
