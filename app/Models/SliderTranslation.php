<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* Class SliderTranslation
*/
class SliderTranslation extends Model
{
  protected $table = 'slider_translations';

  protected $primaryKey = 'slider_translations_id';

  public $timestamps = true;

  protected $fillable = [
    'title',
    'slider_id',
    'image',
    'sort',
  ];

  protected $guarded = [];
  public function mainTb()
  {
    return $this->belongsTo('App\Models\Slider','slider_id','slider_id');
  }
}
