<?php

namespace Modules\Product\Filament\Resources;

use Exception;
use JetBrains\PhpStorm\Pure;
use Modules\Product\Filament\Resources\BrandResource\Pages;
use Modules\Product\Models\Brand;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class BrandResource extends Resource
{
	protected static ?string $model = Brand::class;

	protected static ?string $navigationIcon = 'heroicon-o-collection';

	public static function getLabel(): string
	{
		return __('Hello');
	}

	protected static function getNavigationGroup(): ?string
	{
		return __('filament-spatie-roles-permissions::filament-spatie.section.roles_and_permissions');
	}

	public static function getPluralLabel(): string
	{
		return __('filament-spatie-roles-permissions::filament-spatie.section.permissions');
	}

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\Card::make()->schema([
					Forms\Components\TextInput::make('name')->required(),
				])
			]);
	}

	/**
	 * @throws Exception
	 */
	public static function table(Table $table): Table
	{
		return $table
			->columns([
				Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
			])
			->filters([
				//
			])
			->actions([
				Tables\Actions\EditAction::make(),
			])
			->bulkActions([
				Tables\Actions\DeleteBulkAction::make(),
			]);
	}

	public static function getRelations(): array
	{
		return [
			//
		];
	}

	#[Pure] public static function getPages(): array
	{
		return [
			'index' => Pages\ListBrands::route('/'),
		];
	}
}
