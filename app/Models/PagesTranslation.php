<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* Class PagesrTranslation
*/
class PagesTranslation extends Model
{
  protected $table = 'pages_translations';

  protected $primaryKey = 'pages_translations_id';

  public $timestamps = true;

  protected $fillable = [
    'title',
    'description',
    'page',
    'pages_id',
    'image',
    'video',
    'sort',
  ];

  protected $guarded = [];
  public function mainTb()
  {
    return $this->belongsTo('App\Models\Slider','slider_id','slider_id');
  }
}
