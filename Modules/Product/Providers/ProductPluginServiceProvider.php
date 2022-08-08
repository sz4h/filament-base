<?php

namespace Modules\Product\Providers;

use Filament\PluginServiceProvider;
use Modules\Product\Filament\Resources\BrandResource;
use Spatie\LaravelPackageTools\Package;
use Illuminate\Support\ServiceProvider;

class ProductPluginServiceProvider extends PluginServiceProvider
{
	public static string $name = 'product-filament';

	public function configurePackage(Package $package): void
	{
		$package->name('product-filament');
	}

	protected function getResources(): array
	{
		return [
			BrandResource::class
		];
	}

}