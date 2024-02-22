<?php

namespace App\Http\Controllers;

use App\Models\ABTest;
use App\Models\Variant;
use Illuminate\Http\Request;

class ABTestController extends Controller
{
    public function startTest($id)
    {
        $test = ABTest::findOrFail($id);

        if ($test->status === 'stopped') {
            $variants = $test->variants;
            $selectedVariant = $this->selectVariant($variants);

            session(['ab_test_variant' => $selectedVariant->name]);
            session(['ab_test_status' => 'running']);

            $test->update(['status' => 'running']);
        }

        return redirect('/');
    }

    public function stopTest($id)
    {
        $test = ABTest::findOrFail($id);

        if ($test->status === 'running') {
            $test->update(['status' => 'stopped']);

            session()->forget(['ab_test_variant', 'ab_test_status']);
        }

        return redirect('/');
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

    public function showWelcomePage()
    {
        $abTestId = 1;

        return view('welcome', compact('abTestId'));
    }
}
