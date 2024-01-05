<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'dokter-list',
        'dokter-create',
        'dokter-edit',
        'dokter-delete',
        'pasien-list',
        'pasien-create',
        'pasien-edit',
        'pasien-delete',
        'poli-list',
        'poli-create',
        'poli-edit',
        'poli-delete',
        'obat-list',
        'obat-create',
        'obat-edit',
        'obat-delete',
    ];

    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $user = User::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
