<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* Class NewsImages
*/
class ProjectsImages extends Model
{
    protected $table = 'projects_images';

    protected $primaryKey = 'projects_images_id';

    public $timestamps = true;

    protected $fillable = [
        'image',
        'projects_translation_id',
    ];

    protected $guarded = [];

    public function projects()
    {
        return $this->belongsTo('App\Models\ProjectsTranslation' , 'projects_id','projects_translations_id');
    }

}
