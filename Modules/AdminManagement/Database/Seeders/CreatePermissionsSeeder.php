<?php

namespace Modules\AdminManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\AdminManagement\App\Models\Admin;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreatePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**Create Permissions */
        $permissiongroups = [
            'admins' => [
                'admin:admin-list',
                'admin:admin-create',
                'admin:admin-edit',
                'admin:admin-show',
                'admin:admin-delete',
                'admin:admin-change-status',
                'admin:admin-export',
            ],
            'users' => [
                'admin:user-list',
                'admin:user-create',
                'admin:user-edit',
                'admin:user-show',
                'admin:user-delete',
                'admin:user-change-status',
                'admin:user-export',
            ],
            'vendors' => [
                'admin:vendor-list',
                'admin:vendor-create',
                'admin:vendor-edit',
                'admin:vendor-show',
                'admin:vendor-delete',
                'admin:vendor-change-status',
                'admin:vendor-export',
            ],
            'scratch-game' => [
                'admin:scratch-game-information',
                'admin:scratch-game-information-update'
            ],
            'spin-game' => [
                'admin:spin-game-information',
                'admin:spin-game-information-update'
            ],
            'roles' => [
                'admin:role-list',
                'admin:role-create',
                'admin:role-edit',
                'admin:role-show',
                'admin:role-delete',
            ],
            'reports' => [
                'admin:report-list',
                'admin:report-create',
                'admin:report-edit',
                'admin:report-show',
                'admin:report-delete',
            ],
        ];
        $permissionsNames = [];
        foreach ($permissiongroups as $groupname => $permissiongroup) {
            foreach($permissiongroup as $permission){
                $permissionsNames[] = $permission;
                Permission::firstOrCreate(
                    [
                        'name' => $permission,
                        'guard_name' => 'admin',
                        'grouping' => $groupname
                    ],
                );
            }
        };
         /**Create Permissions */
         $role = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'admin' ]);
         $role->syncPermissions($permissionsNames);

         $admin = Admin::firstOrCreate([
            'email' => 'admin@admin.com'
         ],[
            'name' => 'admin',
            'password' => Hash::make('123456'),
         ]);

         $admin->assignRole($role);
    }
}
