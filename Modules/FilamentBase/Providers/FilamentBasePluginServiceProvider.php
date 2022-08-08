<?php

namespace Modules\FilamentBase\Providers;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentBasePluginServiceProvider extends PluginServiceProvider
{

	public function configurePackage(Package $package): void
	{
		$package->name('filament-base');
	}

	public function getStyles(): array
	{
		return config('filamentbase.filament.styles');
	}
}