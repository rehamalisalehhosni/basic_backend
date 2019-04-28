<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* Class AboutUsTranslation
*/
class AboutUsTranslation extends Model
{
    protected $table = 'aboutus_translations';

    protected $primaryKey = 'aboutus_translations_id';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'aboutus_id',
        'description',
        'image',
        'locale',
        'sort',
    ];
public function mainTb()
{
    return $this->belongsTo('App\Models\AboutUs','aboutus_id','aboutus_id');
}

}
