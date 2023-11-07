<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Party extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['_token', 'id', '_method'];

    public function order()
    {
        return $this->morphMany(Order::class, 'orderable');
    }
}
