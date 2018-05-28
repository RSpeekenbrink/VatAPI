<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'TestUser';
        $user->email = 'user@test.test';
        $user->password = bcrypt('secret');
        $user->api_token = 'lCP1i5NJKgEHtATJ3vel0yeIHlO4p0EEq1Y5PsV0ewEUCh3WnxOpUm7bwTbp'; //str_random(60);
        $user->save();
    }
}
