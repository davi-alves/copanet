<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('users')->delete();

        $users = array(
            array(
                'nome' => 'Index Digital',
                'email' => 'teste@indexdigital.com.br',
                'username' => 'index',
                'password' => Hash::make('idx32611908'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($users);
    }

}
