<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $phone = preg_replace('/[^0-9]/', '', $faker->phoneNumber);

            $userModel->save([
                'first_name' => $faker->firstName,
                'last_name' =>  $faker->lastName,
                'email' =>  $faker->email,
                'username' => $faker->username,
                'password' => password_hash($faker->password, PASSWORD_DEFAULT),
                'mobile' => $phone,
                'active' => random_int(0, 1),
                'first_access_at' => null,
                'last_access_at' => null
            ]);
        }
    }
}
