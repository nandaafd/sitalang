<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            [
                'fullname'=>'Admin Sitalang',
                'nickname'=>'Admin',
                'email'=>'admin@sitalang.sch.id',
                'password'=>bcrypt('password'),
                'role_id'=>'1',
            ],
        ];
        foreach ($data as $key => $value) {
            $user = User::create($value);
            $user_id = $user->id;
            $admin = [
                [
                    'user_id'=>$user_id,
                    'code'=>'ADM-SITALANG-'.$user_id,

                ]
            ];
            foreach ($admin as $key => $adm) {
                Admin::create($adm);
            }
        }
        
    }
}
