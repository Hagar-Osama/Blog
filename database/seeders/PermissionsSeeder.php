<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'create_artical',
            'edit_artical',
            'delete_artical',
            'create_user',
            'edit_user',
            'delete_user',
            'create_product',
            'edit_product',
            'delete_product'

        ];
        foreach($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }



    }
}
