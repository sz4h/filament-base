<?php

namespace Modules\Product\Filament\Resources\BrandResource\Pages;

use Modules\Product\Filament\Resources\BrandResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBrands extends ListRecords
{
	protected static string $resource = BrandResource::class;

	protected function getActions(): array
	{
		return [
			Actions\CreateAction::make(),
		];
	}
}
