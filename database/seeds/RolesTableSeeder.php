<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'customer',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'driver',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'manager',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'admin',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'superadmin',
            ),
        ));
        
        
    }
}