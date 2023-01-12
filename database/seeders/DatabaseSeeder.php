<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Faker\Factory;
use App\Models\News;
use App\Models\Page;
use App\Models\User;
use App\Models\Album;
use App\Models\Image;
use App\Models\Order;
use App\Models\Option;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\VideoAlbum;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
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
        $faker = Factory::create();

        $optionName = [
            'website_name',
            'website_description',
            'website_lang',
            'website_photo'
        ];

        $optionValue = [
            'Hiwar',
            'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'EN',
            'logo.png'
        ];


        $name = [
            'Do you hear the call?',
            'Hero, you took everything from me',
            'a playlist that makes you fight until your last breath',
            'This could be the day i die for you'
        ];

        $link = [
            'https://www.youtube.com/watch?v=yKve2Q52bX0',
            'https://www.youtube.com/watch?v=IofeeSQ4T2I',
            'https://www.youtube.com/watch?v=PkCIiDVotlE',
            'https://www.youtube.com/watch?v=M7CTQ7OeqCg'
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

        Page::create([
            'title' => 'من نحن',
            'brief' => 'مؤسسة حوار للتنمية المجتمعية',
            'description' => 'مؤسسة حوار للتنمية المجتمعية هي مؤسسة أهلية فلسطينية غير ربحية، متخصصة في العمل الشبابي والنسوي. تأسست عام 2010 من قبل مجموعة فلسطينية شابة، و تركز في برامجها على تدريب وتمكين الشباب والنساء من أجل تعزيز مشاركتهم في بناء مجتمع فلسطيني تسوده العدالة الاجتماعية والديمقراطية والمساواة وتدعيم لغة الحوار ونبذ العنف المبني على النوع الاجتماعي. ومحاولة المساهمة في الحد من الفقر في فلسطين بمساعدة الفئات المهمشة والفقيرة. ترخصت مؤسسة حوار للتنمية المجتمعية في عام 2011 وهي مسجلة رسميا لدى وزارة الداخلية الفلسطينية. تستهدف مؤسستنا قطاعي المرأة والشباب بشكل مباشر والأطفال وكبار السن بشكل غير مباشر.',
            'status' => 1,
            'sideMenu' => 1,
            'feature_image' => 5,
            'page_slug' => Str::slug('من نحن'),
        ]);

        Page::create([
            'title' => 'رؤيتنا',
            'brief' => 'ما هو "لوريم إيبسوم" ؟',
            'description' => 'لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص،.',
            'status' => 1,
            'sideMenu' => 0,
            'feature_image' => 2,
            'page_slug' => Str::slug('رؤيتنا'),
        ]);

        Page::create([
            'title' => 'برامجنا',
            'brief' => 'ما فائدته ؟',
            'description' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي،.',
            'status' => 1,
            'sideMenu' => 0,
            'feature_image' => 3,
            'page_slug' => Str::slug('برامجنا'),
        ]);


        Page::create([
            'title' => 'رسالتنا',
            'brief' => 'ما أصله ؟',
            'description' => 'خلافاَ للإعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، بل إن له جذور في الأدب اللاتيني الكلاسيكي منذ العام 45 قبل الميلاد، مما يجعله أكثر من 2000 عام في القدم. قام البروفيسور "ريتشارد ماك لينتوك" (Richard McClintock) وهو بروفيسور اللغة اللاتينية في جامعة.',
            'status' => 1,
            'sideMenu' => 0,
            'feature_image' => 1,
            'page_slug' => Str::slug('رسالتنا'),
        ]);

        $pages = Page::factory(4)->create();

        foreach ($pages as $key => $value) {

            $pages[$key]->page_slug =
                Str::slug($pages[$key]->title);
            $pages[$key]->save();
        }
        News::factory(4)->create();
        Image::factory(4)->create();

        Image::create([
            'original_filename' => 'aboutUs0001.png',
            'filename' => 'aboutus-img.png',
        ]);

        Product::factory(4)->create();
        Album::factory(4)->create();


        for ($i = 0; $i < 3; $i++) {
            $order =  Order::factory(1)->create();

            for ($o = 0; $o < 2; $o++) {
                OrderProduct::create([
                    'order_id' => $order->last()->order_id,
                    'product_id' => Product::all()->random()->product_id,
                    'quantity' => $faker->numberBetween(1, 3),
                ]);
            }
        }



        for ($i = 0; $i < 4; $i++) {
            $url = $link[$i];
            parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);

            VideoAlbum::create([
                'name' => $name[$i],
                'link' => $link[$i],
                'linkShortcut' => $my_array_of_vars['v']
            ]);
        }

        for ($i = 0; $i < 4; $i++) {
            Option::create([
                'name' => $optionName[$i],
                'value' => $optionValue[$i],
            ]);
        }
    }
}
