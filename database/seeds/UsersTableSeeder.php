<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = array('Test','Admin','Jatan','Bhatt');
    	foreach ($names as $name) {
	        DB::table('users')->insert([
	            'name' => $name,
	            'email' => strtolower($name).'@gmail.com',
	            'password' => bcrypt('secret'),
	        ]);
    	}
    }
}
