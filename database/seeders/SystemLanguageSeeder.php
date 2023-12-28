<?php

namespace Database\Seeders;

use App\Models\SystemLanguage;
use Illuminate\Database\Seeder;

class SystemLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
          'az',
          'en',
        ];

        foreach ($languages as $language)
        {
            SystemLanguage::create([
                'language' => $language
            ]);
        }
    }
}
