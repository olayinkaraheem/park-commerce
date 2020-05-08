<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $guarded = [];
    protected $with = ['storeitem'];

    public function storeitem() {
        return $this->belongsTo(\App\StoreItem::class, 'item_id');
    }
}
