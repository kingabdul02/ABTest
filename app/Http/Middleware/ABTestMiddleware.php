<?php
// app/Http/Middleware/ABTestMiddleware.php

namespace App\Http\Middleware;

use App\Models\ABTest;
use Closure;

class ABTestMiddleware
{
    public function handle($request, Closure $next)
    {
        // Get the active A/B tests
        $activeTests = ABTest::where('status', 'running')->get();

        foreach ($activeTests as $test) {
            // Check if a session already has a selected variant for the A/B test
            $sessionKey = 'ab_test_variant_' . $test->id;

            if (!session()->has($sessionKey)) {
                // If not, select a variant based on targeting ratios
                $selectedVariant = $this->selectVariant($test->variants);

                // Set the selected variant in the session
                session([$sessionKey => $selectedVariant->name]);
            }
        }

        return $next($request);
    }

    private function selectVariant($variants)
    {
        // Simple random selection based on targeting ratios
        $totalRatio = $variants->sum('targeting_ratio');
        $randomNumber = rand(1, $totalRatio);

        $cumulativeRatio = 0;
        foreach ($variants as $variant) {
            $cumulativeRatio += $variant->targeting_ratio;
            if ($randomNumber <= $cumulativeRatio) {
                return $variant;
            }
        }

        // Fallback: return the first variant if something goes wrong
        return $variants->first();
    }
}
