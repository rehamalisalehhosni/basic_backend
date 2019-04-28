<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SettingTranslation;

/**
* Class Setting
*/
class Setting extends Model
{
    protected $table = 'setting';

    protected $primaryKey = 'setting_id';

    public $timestamps = true;

    protected $fillable = [
        'lat',
        'long',
        'email',
        'tel',
        'tel2',
        'pin',
        'address',
        'description',
        'company_name',
        'logo',
        'active_theme',
    ];
    protected $guarded = [];
    public function translations($lang,$id)
    {
        return SettingTranslation::where(['locale'=>$lang,'setting_id'=>$id])->first();
    }


}
