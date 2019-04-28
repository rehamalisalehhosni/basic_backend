<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ServicesTranslation;

/**
* Class Services
*/
class Services extends Model
{
    protected $table = 'services';

    protected $primaryKey = 'services_id';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'image',
        'sort',
    ];
    public function translations($lang,$id)
    {
        return ServicesTranslation::where(['locale'=>$lang,'services_id'=>$id])->first();
    }

    protected $guarded = [];

}
