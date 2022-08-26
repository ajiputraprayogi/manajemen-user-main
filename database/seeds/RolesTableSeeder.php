<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(env('DB_CONNECTION', 'pgsql') == 'mysql'){
            DB::statement("SET foreign_key_checks=0");
            App\Role::truncate();
            App\RoleMenu::truncate();
            DB::statement("SET foreign_key_checks=1");
        }
        else{
            App\Role::truncate();
            App\RoleMenu::truncate();
        }
        $roles = json_decode(File::get(database_path('datas/roles.json')));
        foreach ($roles as $role) {
            
            $newrole = App\Role::create([
                'name'=> $role->name,
                'display_name'=> $role->display_name,
            ]);
            $menus = App\Menu::all();
            foreach($menus as $menu){
                App\RoleMenu::create([
                    'role_id' => $newrole->id,
                    'menu_id' => $menu->id,
                    'role_access' => 1,
                    'create'=>1,
                    'read'=>1,
                    'update'=>1,
                    'delete'=>1,
                    'import'=>1,
                    'export'=>1,
                    'print'=>1,
                    'sync'=>1,
                ]);
            }
        }
    }
}
