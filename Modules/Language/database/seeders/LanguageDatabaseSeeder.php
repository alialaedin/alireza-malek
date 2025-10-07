<?php

namespace Modules\Language\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$languages = [
			['english_name' => 'English', 'persian_name' => 'انگیلیسی',  'code' => 'en', 'native_name' => 'English', 'created_at' => now(), 'updated_at' => now()],
			['english_name' => 'French', 'persian_name' => 'فرانسوی',   'code' => 'fr', 'native_name' => 'Français', 'created_at' => now(), 'updated_at' => now()],
			['english_name' => 'Spanish', 'persian_name' => 'اسپانیایی',  'code' => 'es', 'native_name' => 'Español', 'created_at' => now(), 'updated_at' => now()],
			['english_name' => 'German', 'persian_name' => 'آلمانی',   'code' => 'de', 'native_name' => 'Deutsch', 'created_at' => now(), 'updated_at' => now()],
			['english_name' => 'Arabic', 'persian_name' => 'عربی',   'code' => 'ar', 'native_name' => 'العربية', 'created_at' => now(), 'updated_at' => now()],
			['english_name' => 'Russian', 'persian_name' => 'روسی',  'code' => 'ru', 'native_name' => 'Русский', 'created_at' => now(), 'updated_at' => now()],
			['english_name' => 'Chinese', 'persian_name' => 'چینی',  'code' => 'zh', 'native_name' => '中文', 'created_at' => now(), 'updated_at' => now()],
			['english_name' => 'Japanese', 'persian_name' => 'ژاپنی', 'code' => 'ja', 'native_name' => '日本語', 'created_at' => now(), 'updated_at' => now()],
			['english_name' => 'Korean', 'persian_name' => 'کره ای',   'code' => 'ko', 'native_name' => '한국어', 'created_at' => now(), 'updated_at' => now()],
		];

		foreach ($languages as $language) {
			DB::table('languages')->insert($language);
		}
	}
}
