<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* Class StatisticsTranslation
*/
class StatisticsTranslation extends Model
{
  protected $table = 'statistics_translations';

  protected $primaryKey = 'statistics_translations_id';

  public $timestamps = true;

  protected $fillable = [
    'title',
    'statistics_id',
    'description',
    'number',
    'sort',
  ];

  protected $guarded = [];
  public function mainTb()
  {
    return $this->belongsTo('App\Models\Statistics','statistics_id','statistics_id');
  }
}
