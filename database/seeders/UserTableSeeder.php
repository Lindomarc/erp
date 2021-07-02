<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    if (DB::table('users')->where('email', 'admin@example.com')->count() == 0) {
		    DB::table('users')->insert([
			    'name'     => 'Admin',
			    'email'    => 'admin@example.com',
			    'password' => bcrypt('admin'),
		    ]);
	    }
    }
}
