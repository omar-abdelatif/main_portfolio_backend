<?php

namespace Database\Seeders;

use App\Models\ApiKey;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        do {
            $apiKey = Str::random(32);
        } while (ApiKey::where('key', $apiKey)->exists());
        ApiKey::create([
            'key' => $apiKey,
        ]);
    }
}
