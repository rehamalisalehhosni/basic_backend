<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* Class ServicesTranslation
*/
class ServicesTranslation extends Model
{
  protected $table = 'services_translations';

  protected $primaryKey = 'services_translations_id';

  public $timestamps = true;

  protected $fillable = [
    'title',
    'services_id',
    'description',
    'image',
    'sort',
  ];

  protected $guarded = [];
  public function mainTb()
  {
    return $this->belongsTo('App\Models\Services','services_id','services_id');
  }
}
