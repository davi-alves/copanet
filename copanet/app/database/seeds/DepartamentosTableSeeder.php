<?php

class DepartamentosTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('departamentos')->delete();

        $departamentos = array(
            array('nome' => 'Vendas', 'slug' => 'vendas'),
            array('nome' => 'Atendimento', 'slug' => 'atendimento'),
            array('nome' => 'Atendimento Banda Larga', 'slug' => 'atendimento-banda-larga'),
            array('nome' => 'Retenção', 'slug' => 'retencao'),
        );

        // Uncomment the below to run the seeder
        DB::table('departamentos')->insert($departamentos);
    }

}
