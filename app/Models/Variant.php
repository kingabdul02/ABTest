<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = ['name', 'targeting_ratio', 'ab_test_id'];

    public function abTest()
    {
        return $this->belongsTo(ABTest::class);
    }
}
