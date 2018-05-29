<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('statuses')->delete();
        
        \DB::table('statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Open',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Appointed',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'On execution',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Delivered',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Paid',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Done',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Canceled',
            ),
        ));
        
        
    }
}