<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$AuH6WwOnZVz7KDlCirXpmehweK0GflKh4oXi0mr1GBagwA2jXo9tK',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
