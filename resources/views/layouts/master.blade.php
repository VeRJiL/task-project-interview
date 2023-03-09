<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>@yield("title", "Task Management")</title>

	<link rel="stylesheet" href="{{ asset("assets/packages/awesome-notifications/style.css") }}">


	@stack("styles")
</head>
<body>

@yield("contentBody")

<script src="{{ asset("assets/packages/awesome-notifications/index.var.js") }}"></script>

@include("layouts.alert")

@stack("scripts")

</body>
</html>
