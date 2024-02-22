<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ABTest extends Model
{
    protected $fillable = ['name', 'status'];

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function start()
    {
        $this->update(['status' => 'running']);
    }

    public function stop()
    {
        $this->update(['status' => 'stopped']);
    }
}
