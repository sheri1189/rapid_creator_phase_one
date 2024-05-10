<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AuthenticationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            "first_name" => "Shaharyar",
            "last_name" => "Ahmed",
            "email" => 'admin@gmail.com',
            "email_verified_at" => date('Y-m-d h:i:s'),
            "emailToken" => null,
            "password" => bcrypt(123123123),
            "plain_password" => 123123123,
            "contact_no" => +923127502394,
            "country" => "Pakistan",
            "state" => "Punjab",
            "city" => "Faisalabad",
            "zip_code" => "38000",
            "is_admin" => 1,
            "enter_from" => 'Email',
            "is_active" => 1,
            "picture" => "./images/avatar.png",
        ]);
    }
}
