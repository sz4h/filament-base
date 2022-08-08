<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$roles = [
			'Super Admin',
			'Admin',
			'Shop Staff',
			'Accounting',
		];
		$permissions = [
			'*',
		];
		foreach ($roles as $role) {
			$this->createRole($role);
		}
		foreach ($permissions as $permission) {
			$this->createPermission($permission);
		}
		Role::query()
			->where('name', 'Super Admin')
			->first()
			->permissions()->sync(Permission::where('name', '*')->first());
		User::query()->where('email', 'ahmed@sz4h.com')->first()?->assignRole('Super Admin');
	}

	private function createRole(string $role): void
	{
		Role::create([
			'name' => $role,
			'guard_name' => 'web',
		]);
	}

	private function createPermission(string $permission)
	{
		Permission::create([
			'name' => $permission,
			'guard_name' => 'web',
		]);
	}
}
