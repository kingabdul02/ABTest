<?php

use Illuminate\Database\Seeder;
use App\Models\ABTest;
use App\Models\Variant;

class ABTestSeeder extends Seeder
{
    public function run()
    {
        // Seed an A/B test with one or more variants
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
