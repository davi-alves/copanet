<?php

class TimesTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('times')->delete();

        $times = array(
            array('nome' => 'Time 1', 'slug' => 'time-1', 'departamento_id' => 1),
            array('nome' => 'Time 2', 'slug' => 'time-2', 'departamento_id' => 1),
            array('nome' => 'Time A', 'slug' => 'time-a', 'departamento_id' => 2),
            array('nome' => 'Time B', 'slug' => 'time-b', 'departamento_id' => 2),
            array('nome' => 'Time Alpha', 'slug' => 'time-alpha', 'departamento_id' => 3),
            array('nome' => 'Time Beta', 'slug' => 'time-beta', 'departamento_id' => 3),
            array('nome' => 'Time I', 'slug' => 'time-i', 'departamento_id' => 4),
            array('nome' => 'Time II', 'slug' => 'time-ii', 'departamento_id' => 4),
        );

        // Uncomment the below to run the seeder
        DB::table('times')->insert($times);
    }

}
