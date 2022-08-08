<?php /** @noinspection ALL */

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\RoleRelationManager;
use Exception;
use App\Models\User;
use Filament\Forms\Components\BelongsToManyMultiSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
	protected static ?string $model = User::class;

	protected static ?string $navigationIcon = 'heroicon-o-collection';

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Card::make()->schema([
					TextInput::make('name')->required(),
					TextInput::make('email')->required()->email()->disableAutocomplete(),
					TextInput::make('password')->required()->password()->visibleOn('create')->disableAutocomplete(),
					TextInput::make('password')->password()->visibleOn('edit')->disableAutocomplete(),

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
				TextColumn::make('id')->sortable(),
				TextColumn::make('name')->sortable()->searchable(),
				TextColumn::make('email')->sortable()->searchable(),
				TextColumn::make('roles')
					->formatStateUsing(fn(
						?Collection $state
					) => $state->pluck('name')->implode(", ")),
				TextColumn::make('created_at')->sortable()->date(),
			])
			->filters([
				//
			])
			->actions([
				EditAction::make(),
				DeleteAction::make()->visible(fn(User $record): bool => $record->id != auth()->id()),
			])
			->bulkActions([
				DeleteBulkAction::make()->action(function (DeleteBulkAction $action): void {
					$action->process(static fn(Collection $records) => $records->each(
						fn(User $record) => $record->id != auth()->id() ? $record->delete() : null
					));
					$action->success();
				}),
			]);
	}

	public static function getRelations(): array
	{
		return [
			RoleRelationManager::class
		];
	}

	public static function getEloquentQuery(): Builder
	{
		return parent::getEloquentQuery()->with('roles');
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListUsers::route('/'),
			'create' => Pages\CreateUser::route('/create'),
			'edit' => Pages\EditUser::route('/{record}/edit'),
		];
	}
}
