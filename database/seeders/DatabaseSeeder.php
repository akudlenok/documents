<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Document::factory()
            ->hasAttached(
                User::factory()->count(3)
            )->count(5)
            ->create();
    }
}
