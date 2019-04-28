<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PagesTranslation;

/**
* Class Pages
*/
class Pages extends Model
{
    protected $table = 'pages';

    protected $primaryKey = 'pages_id';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'page',
        'image',
        'video',
        'sort',
    ];
    public function translations($lang,$id)
    {
        return PagesTranslation::where(['locale'=>$lang,'pages_id'=>$id])->first();
    }

    protected $guarded = [];

}
