<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	@yield('meta')

	<title>{{ $settings['title']['value'] }} | @yield('title')</title>

	{{ HTML::style('packages/kraken-cms/core/js/jquery/fancybox/jquery.fancybox.css') }}
	{{ HTML::style('packages/kraken-cms/core/bootstrap/bootstrap.min.css') }}
	@yield('css')
</head>
<body>
<div id="masterContainer" class="container">
	@include('core::header')
	@yield('content')
</div><!-- #masterContainer -->
{{ HTML::script('packages/kraken-cms/core/js/jquery/jquery.min.js') }}
{{ HTML::script('packages/kraken-cms/core/js/jquery/fancybox/jquery.fancybox.pack.js') }}
{{ HTML::script('packages/kraken-cms/core/bootstrap/bootstrap.min.js') }}
<script>
	var config = {
		base_url: '{{ url('/') }}/',
		admin_url: '{{ admin_url('/') }}/'
	};
	$(function() {
		$('.fancybox').fancybox();
	});
</script>
@yield('js')
</body>
</html>