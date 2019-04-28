<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SliderTranslation;

/**
* Class Slider
*/
class Slider extends Model
{
    protected $table = 'slider';

    protected $primaryKey = 'slider_id';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'image',
        'sort',
    ];
    public function translations($lang,$id)
    {
        return SliderTranslation::where(['locale'=>$lang,'slider_id'=>$id])->first();
    }

    protected $guarded = [];

}
