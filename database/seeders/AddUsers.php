<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'admin';
        $user->email = 'moisespmen@gmail.com';
        $user->password = bcrypt('admin');
        $user->save();
        unset($user);

        $user = new User();
        $user->name = 'Ana Flávia Ribeiro';
        $user->email = 'anaflavia@soluccontconsultorias.com';
        $user->password = bcrypt('admin');
        $user->save();
    }
}
