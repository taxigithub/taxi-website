<?php

use Illuminate\Database\Seeder;

class DriverStatusesTableSeeder extends Seeder
    {

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
        {


        \DB::table('driver_statuses')->delete();
        \DB::table('driver_statuses')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'online',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'offline',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'on duty',
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'on office',
            ),
        ));
        }

    }
