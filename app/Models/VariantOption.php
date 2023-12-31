<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariantOption extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'variant_id',
        'hexacode',
        'position'
    ];

    public function translation()
    {
        return $this->hasMany('App\Models\VariantOptionTranslation')->join('languages', 'variant_option_translations.language_id', 'languages.id');
    }

    public function trans()
    {
        return $this->hasOne('App\Models\VariantOptionTranslation')->select('title', 'variant_option_id');
    }
}