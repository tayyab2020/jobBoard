<?php

use App\Events\Inst;
use Carbon\Carbon;
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
        DB::table('users')->truncate();

        // Create admin account
        DB::table('users')->insert([
            'usertype' => 'Admin',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'image_icon' => null,
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);



        DB::table('settings')->insert([
            'site_style' => 'blue',
            'site_name' => 'Job Board',
            'site_email' => 'admin@admin.com',
            'site_logo' => 'logo.png',
            'site_favicon' => 'favicon.png',
            'site_description' => 'Easy Job Board provide you with a quick and easy way to create a Job ad.',
            'site_copyright' => 'Copyright © 2020 HAWK Technologies. All rights reserved.'
        ]);


       // factory('App\User', 20)->create();
    }
}
