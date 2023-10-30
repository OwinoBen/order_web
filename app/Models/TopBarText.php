<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopBarText extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'redirect_category_id');
    }

    public function vendor()
    {
        return $this->hasOne('App\Models\Vendor', 'id', 'redirect_vendor_id');
    }
}
