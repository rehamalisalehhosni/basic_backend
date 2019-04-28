<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* Class ProjectsTranslation
*/
class ProjectsTranslation extends Model
{
    protected $table = 'projects_translations';

    protected $primaryKey = 'projects_translations_id';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'main_image',
        'show_home',
        'gallary',
        'publish',
        'sort',
        'projects_category_id',
        'presentation',
        'video',
        'gallary',
        'client',
        'status',
        'location',
        'projects_id',
    ];


    protected $guarded = [];
    public function mainTb()
    {
    return $this->belongsTo('App\Models\Projects','projects_id','projects_id');
    }
    public function projectsCategoriesTranslate() {
        return $this->belongsTo('App\Models\ProjectsCategoryTranslation' ,'projects_category_id','projects_category_id');
    }

    public function ProjectsImages() {
        return $this->hasMany("App\Models\ProjectsImages");
    }
    public function ProjectsPlans() {
        return $this->hasMany("App\Models\ProjectsPlans");
    }

}
