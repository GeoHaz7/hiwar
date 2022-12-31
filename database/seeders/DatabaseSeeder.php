<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Page;
use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Video;
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


        $name = [
            'Do you hear the call?',
            'Hero, you took everything from me',
            'a playlist that makes you fight until your last breath',
            'This could be the day i die for you'
        ];

        $link = [
            'https://www.youtube.com/watch?v=yKve2Q52bX0',
            'https://www.youtube.com/watch?v=IofeeSQ4T2I&t=112s',
            'https://www.youtube.com/watch?v=PkCIiDVotlE&t=75s',
            'https://www.youtube.com/watch?v=M7CTQ7OeqCg&t=651s'
        ];

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

        for ($i = 0; $i < 4; $i++) {
            $url = $link[$i];
            parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);

            Video::create([
                'name' => $name[$i],
                'link' => $link[$i],
                'linkShortcut' => $my_array_of_vars['v']
            ]);
        }

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
