<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Page;
use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        //0 = super admin
        //1 = admin
        //2 = vendor

        User::create([
            'username' => 'George Hazboun',
            'email' => 'georgehazboun1997@gmail.com',
            'password' => '$2y$10$avAiACLwV4KgPTpnJsdeyO3K6u5dzMArXOyNA5WUBTC3yslfNXAn2',
            'type' => '0',
        ]);

        Vendor::factory(4)->create();
        Page::factory(4)->create();
        Image::factory(4)->create();
        Product::factory(4)->create();

        // User::create([
        //     'nickname' => 'Oriana_Element',
        //     'email' => 'oriana@element.com',
        //     'password' => '$2y$10$avAiACLwV4KgPTpnJsdeyO3K6u5dzMArXOyNA5WUBTC3yslfNXAn2',
        //     'type' => '2',
        // ]);

        // Vendor::create([
        //     'full_name' => 'Oriana Sabat',
        //     'bio' =>  'Lorem Ipsum -_-',
        //     'address' => 'Nativity Street',
        //     'phone' => '0592341594',
        //     'status' => 1,
        //     'user_id' => User::where('nickname', 'Oriana_Element')->first()->user_id
        // ]);
    }
}
