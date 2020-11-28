<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Option;
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
        Option::insert([
            'key' => 'default_lang',
            'value' => 1
        ]);

        Language::insert([[
            'display_name' => 'Türkçe',
            'lang_code' => 'tr',
            'flag_code' => 'tr'
        ], [
            'display_name' => 'English',
            'lang_code' => 'en',
            'flag_code' => 'gb'
        ]]);
    }
}
