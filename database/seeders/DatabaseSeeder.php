<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ABTest;
use App\Models\Variant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $abTest = ABTest::create([
            'name' => 'Example A/B Test',
            'status' => 'stopped', // You can start it manually if needed
        ]);

        // Seed variants for the A/B test
        Variant::create([
            'name' => 'Variant A',
            'targeting_ratio' => 1,
            'a_b_test_id' => $abTest->id,
        ]);

        Variant::create([
            'name' => 'Variant B',
            'targeting_ratio' => 2,
            'a_b_test_id' => $abTest->id,
        ]);
    }
}
