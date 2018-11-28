<?php

use Illuminate\Database\Seeder;
use App\User;

class DataAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'login' => 'admin',
            'name' => 'admin',
            'email' => 'admin@admin.ru',
            'password' => Hash::make('admin'),
        ]);
    }
}
