<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Exception;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
	protected static string $resource = UserResource::class;

	/**
	 * @throws Exception
	 */
	protected function getActions(): array
	{
		return [
			Actions\DeleteAction::make()->visible(fn(User $record): bool => $record->id != auth()->id()),
		];
	}

	protected function mutateFormDataBeforeSave(array $data): array
	{
		if (!@$data['password']) {
			unset($data['password']);
		}
		return $data;
	}
}
