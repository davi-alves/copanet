<?php

class ArtilheirosTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('artilheiros')->delete();

        $artilheiros = array(
             array('nome' => 'Davi', 'time_id' => 1),
             array('nome' => 'Renata', 'time_id' => 2),
             array('nome' => 'Jozé', 'time_id' => 3),
             array('nome' => 'Maria', 'time_id' => 4),
             array('nome' => 'Ane', 'time_id' => 5),
             array('nome' => 'Mariana', 'time_id' => 6),
             array('nome' => 'Franzé', 'time_id' => 7),
             array('nome' => 'Chico', 'time_id' => 8),
        );

        // Uncomment the below to run the seeder
        DB::table('artilheiros')->insert($artilheiros);
    }

}
