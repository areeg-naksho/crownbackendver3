<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Checkout;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => "ammar",
            'email' => "admin@gmail.com",
            'password' => Hash::make('123456789'),
        ]);

        Country::create([
            'name_en' => "Emarat",
            'name_ar' => "الإمارات",
        ]);
        State::create([
            'name_en' => "Agman",
            'name_ar' => "عجمان",
            'country_id' => 1,
            'default_shipping' => 20,
            'extra_shipping' => 4
        ]);
        State::create([
            'name_en' => "AlSharqa",
            'name_ar' => "الشارقة",
            'country_id' => 1,
            'default_shipping' => 15,
            'extra_shipping' => 3
        ]);

        City::create([
            'name_en' => "test1",
            'name_ar' => "test1",
            'state_id' => "1",
        ]);
        City::create([
            'name_en' => "test2",
            'name_ar' => "test2",
            'state_id' => "2",
        ]);

        Category::create([
            'name_en' => "vegetables",
            'name_ar' => "خضراوات",
            'description_en' => "good",
            'description_ar' => "جيدة",
        ]);
        Category::create([
            'name_en' => "Dairies",
            'name_ar' => "البان و اجبان",
            'description_en' => "good",
            'description_ar' => "جيدة",
        ]);

        Product::create([
            'name_en' => "Tomato",
            'name_ar' => "بندورة",
            'image' => '["productImages\/a4etANvdNXQNEVKzBuH2UKy4Ijr33l-metadG9tYXQucG5n-.png","productImages\/WSTGqcTpIleHIIguRstuv07F4rPUoe-metadG9tYXRvLmpwZw==-.jpg"]',
            'description_en' => "good",
            'description_ar' => "جيدة",
            'price' => 1000.00,
            'quantity' => 10,
            'featured' => 1,
            'category_id' => 1,
        ]);
        Product::create([
            'name_en' => "egg",
            'name_ar' => "بيض",
            'image' => '["productImages\/igmGNYvVcx7eR4Gm25nHaDXBQ1rMT4-metaNzg5LmpwZw==-.jpg","productImages\/UxCojxonfSuA5J4EjAeIfYj0WZHGeE-metaZWdnLnBuZw==-.png"]',
            'description_en' => "good",
            'description_ar' => "جيدة",
            'price' => 840.00,
            'quantity' => 16,
            'featured' => 1,
            'category_id' => 2,
        ]);
        Product::create([
            'name_en' => "Cucumber",
            'name_ar' => "خيار",
            'image' => '["productImages\/iCm9SiGnQOTACZwVh00VMJACHevmUM-metady5wbmc=-.png"]',
            'description_en' => "good",
            'description_ar' => "جيدة",
            'price' => 900.00,
            'quantity' => 13,
            'featured' => 0,
            'category_id' => 1,
        ]);
        Order::create([
            'subtotal' => 1
        ]);
        OrderProduct::create([
            'order_id' => "1",
            'product_id' => "1",
            'quantity' => 1,
            'price' => 1
        ]);
        Checkout::create([
            'order_id' => "1",
            'first_name' => "Ammar",
            'last_name' => "Sharbek",
            'email' => "ammar@gmail.com",
            'phone' => "0966884425",
            'address' => "homs",
            'address2' => "karm alshame",
            'country_id' => "1",
            'state_id' => "1",
            'city_id' => "1",
            'zip_code' => "qwe",
            'po_box' => "asdkjjkl"
        ]);
        Setting::create([
            'value' => '5'
        ]);
        Setting::create([
            'value' => '10'
        ]);
    }
}
