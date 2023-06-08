<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\About;
use App\Models\AboutTranslation;
use App\Models\MetaTag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            LanguageSeeder::class,
            PermissionsSeeder::class,
            UserSeeder::class,
            SliderSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            AboutSeeder::class,
            ContactInfoSeeder::class,
            SocialSeeder::class,
        ]);
    }
}
