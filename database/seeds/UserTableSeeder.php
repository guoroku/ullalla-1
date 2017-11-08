<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->username = 'shogun';
        $user->email = 'disabledbyfb@gmail.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->save();
    }
}
