<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        $languages = [
            ['name' => 'English', 'code' => 'en'],
            ['name' => 'German', 'code' => 'de'],
            ['name' => 'Georgian', 'code' => 'ka'],
            ['name' => 'Spanish', 'code' => 'es'],
            ['name' => 'Finnish', 'code' => 'fi'],
            ['name' => 'French', 'code' => 'fr'],
            ['name' => 'Hebrew', 'code' => 'he'],
            ['name' => 'Croatian', 'code' => 'hr'],
            ['name' => 'Indonesian', 'code' => 'id'],
            ['name' => 'Italian', 'code' => 'it'],
            ['name' => 'Irish', 'code' => 'ga'],
            ['name' => 'Japanese', 'code' => 'ja'],
            ['name' => 'Korean', 'code' => 'ko'],
            ['name' => 'Malay', 'code' => 'ms'],
            ['name' => 'Dutch', 'code' => 'nl'],
            ['name' => 'Norwegian', 'code' => 'no'],
            ['name' => 'Persian', 'code' => 'fa'],
            ['name' => 'Polish', 'code' => 'pl'],
            ['name' => 'Romanian', 'code' => 'ro'],
            ['name' => 'Russian', 'code' => 'ru'],
            ['name' => 'Swedish', 'code' => 'sv'],
            ['name' => 'Thai', 'code' => 'th'],
            ['name' => 'Turkish', 'code' => 'tr'],
            ['name' => 'Vietnamese', 'code' => 'vi'],
            ['name' => 'Chinese', 'code' => 'zh'],
        ];

        DB::table('languages')->insert($languages);
    }
}
