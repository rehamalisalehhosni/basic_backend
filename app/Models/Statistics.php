<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StatisticsTranslation;

/**
* Class Statistics
*/
class Statistics extends Model
{
    protected $table = 'statistics';

    protected $primaryKey = 'statistics_id';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'number',
        'sort',
    ];
    public function translations($lang,$id)
    {
        return StatisticsTranslation::where(['locale'=>$lang,'statistics_id'=>$id])->first();
    }

    protected $guarded = [];

}
