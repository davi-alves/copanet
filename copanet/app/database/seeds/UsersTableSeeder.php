<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('users')->delete();

        $users = array(
            array(
                  'name' => 'Davi Alves',
                  'email' => 'davi@email.com',
                  'username' => 'davi',
                  'password' => Hash::make('123456'),
                  'created_at' => new DateTime,
                  'updated_at' => new DateTime
              ),
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($users);
    }

}
