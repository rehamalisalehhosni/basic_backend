<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AboutUsTranslation;

/**
* Class AboutUs
*/
class AboutUs extends Model
{

    protected $table = 'aboutus';

    protected $primaryKey = 'aboutus_id';

    public $timestamps = true;

    protected $translatedAttributes = [
        'title',
        'description',
        'image',
        'theme',
        'sort',
    ];
    /*protected $fillable = [
        'title',
        'description',
        'image_big',
        'first_image',
        'second_image',
        'theme',
        'sort',
    ];*/
    protected $guarded = [];
    public function translations($lang,$id)
   {
       return AboutUsTranslation::where(['locale'=>$lang,'aboutus_id'=>$id])->first();
   }
}
