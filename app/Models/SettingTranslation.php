<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* Class Setting
*/
class SettingTranslation extends Model
{
    protected $table = 'setting_translations';

    protected $primaryKey = 'setting_translations_id';

    public $timestamps = true;

    protected $fillable = [
        'lat',
        'long',
        'email',
        'tel',
        'tel2',
        'pin',
        'address',
        'setting_id',
        'company_name',
        'description',
        'logo',
        'active_theme',
    ];
    protected $guarded = [];
    public function mainTb()
    {
        return $this->belongsTo('App\Models\Setting','setting_id','setting_id');
    }


}
