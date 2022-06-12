<?php

namespace App\Models;

use App\Events\ItemCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
//    protected $guarded = [];
//    protected $dispatchesEvents = [
//      'created' => ItemCreated::class
//    ];
    protected $fillable = [
        'name', 'price', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
