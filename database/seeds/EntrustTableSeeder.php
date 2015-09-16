<?php

use App\Src\Permission\Permission;
use App\Src\Role\Role;
use App\Src\User\User;
use Illuminate\Database\Seeder;

class EntrustTableSeeder extends Seeder {

	public function run()
	{

		DB::table('role_user')->truncate();
		DB::table('permission_role')->truncate();
		DB::table('roles')->truncate();
		DB::table('permissions')->truncate();

		$admin = new Role(); // 1
		$admin->name = 'Admin';
		$admin->display_name = "Administrator";
		$admin->level = 10;
		$admin->save();

		$editor = new Role(); // 2
		$editor->name = 'Editor';
		$editor->display_name = "Editor";
		$editor->level = 5;
		$editor->save();

		$userRole = new Role(); // 3
		$userRole->name = 'Author';
		$userRole->display_name = "Author";
		$userRole->level = 1;
		$userRole->save();

		$user = User::where('email', '=', 'admin@email.com')->first();
		$user->roles()->attach($admin->id);

		$user1 = User::where('email', '=', 'editor@email.com')->first();
		//$user1->attachRole($editor);

		$user2 = User::where('email', '=', 'author@email.com')->first();
		//$user2->attachRole($userRole);

		/*$manageRoles = new Permission();
		$manageRoles->name = 'Users';
		$manageRoles->display_name = "Users Managment";
		$manageRoles->description = "";
		//$manageRoles->route = "roles";
		$manageRoles->save();

		$createRoles = new Permission();
		$createRoles->name = 'Roles';
		$createRoles->display_name = "Create roles";
		$createRoles->description = "";
		//$createRoles->route = "roles/create";
		$createRoles->save();*/

		$permissions = [
			// Modules
			'Users','Roles','Permissions','Books','Comments','Messages','Contactus','Blog','Gallery',
			// Modules Permissions
			'user_create','user_edit','user_delete',
			'role_create','role_edit','role_delete','permission_create','permission_edit','permission_delete',
			'book_create','book_edit','book_delete','book_change','chapter_create','chapter_edit','chapter_delete','chapter_change',
			'blog_create','blog_edit','blog_delete','gallery_create','gallery_edit','gallery_delete'
		];

		foreach($permissions as $permission) {
			$updateRoles = new Permission();
			$updateRoles->name = $permission;
			$updateRoles->save();
		}



		/*$createUsers = new Permission();
		$createUsers->name = 'create_users';
		$createUsers->display_name = "Create users";
		$createUsers->description = "";
		$createUsers->route = "users/create";
		$createUsers->save();

		$updateUsers = new Permission();
		$updateUsers->name = 'update_users';
		$updateUsers->display_name = "Update users";
		$updateUsers->description = "";
		$updateUsers->route = "users/{users}/edit";
		$updateUsers->save();

		$destroyUsers = new Permission();
		$destroyUsers->name = 'delete_users';
		$destroyUsers->display_name = "Delete users";
		$destroyUsers->description = "";
		$destroyUsers->route = "users/{users}";
		$destroyUsers->save();


		$managePerms = new Permission();
		$managePerms->name = 'manage_permissions';
		$managePerms->display_name = "Manage permissions";
		$managePerms->description = "";
		$managePerms->route = "permissions";
		$managePerms->save();

		$createPerms = new Permission();
		$createPerms->name = 'create_permissions';
		$createPerms->display_name = "Create permissions";
		$createPerms->description = "";
		$createPerms->route = "permissions/create";
		$createPerms->save();

		$updatePerms = new Permission();
		$updatePerms->name = 'update_permissions';
		$updatePerms->display_name = "Update permissions";
		$updatePerms->description = "";
		$updatePerms->route = "permissions/{permissions}/edit";
		$updatePerms->save();

		$destroyPerms = new Permission();
		$destroyPerms->name = 'delete_permissions';
		$destroyPerms->display_name = "Delete permissions";
		$destroyPerms->description = "";
		$destroyPerms->route = "permissions/{permissions}";
		$destroyPerms->save();

		$admin->attachPermissions([$manageRoles, $createRoles, $updateRoles, $destroyRoles, $manageUsers, $createUsers, $updateUsers, $destroyUsers, $managePerms, $createPerms, $updatePerms, $destroyPerms]);
		//$admin->perms()->sync([$manageRoles->id, $manageUsers->id, $managePerms->id]); Eloquent basic

		$editor->attachPermissions([$managePerms, $createPerms, $updatePerms, $destroyPerms]);*/
	}

}