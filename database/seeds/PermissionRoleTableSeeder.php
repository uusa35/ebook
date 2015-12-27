<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->insert([
            'permission_id' => App\Src\Permission\Permission::all()->random()->id,
            'role_id' => App\Src\Role\Role::all()->random()->id
        ]);
    }
}
