<?php

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;

if (!function_exists('admin')) {
	/**
	 * @param  string|null  $path
	 * @return string|UrlGenerator|Application
	 */
	function admin(?string $path = null): string|UrlGenerator|Application
	{
		return url(config('filament.path') . '/' . $path);
	}
}