<?php

Route::filter('guest', function() {
	if (Auth::check()) return Redirect::to('/')->withErrors('You must be signed out to view that page.');
});

Route::filter('auth', function () {
	if (Auth::guest()) return Redirect::guest('signin');
});

Route::filter('admin', function () {
	if (Auth::guest()) return Redirect::guest('signin');
	if (!Auth::user()->is_admin()) return Redirect::guest('signin')->withErrors('You must be signed in as an administrator to view that page.');
});

Route::filter('nonadmin', function () {
	if (Auth::check() && Auth::user()->is_admin()) return Redirect::to(admin_uri('/'));
});

Route::filter('superadmin', function () {
	if (Auth::guest()) return Redirect::guest('signin');
	if (!Auth::user()->is_superadmin()) {
		return Redirect::to(admin_uri('/'))->withErrors('You must be signed in as a super administrator to view that page.');
	}
});