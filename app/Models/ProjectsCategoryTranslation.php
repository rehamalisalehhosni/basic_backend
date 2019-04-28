<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* Class ProjectsCategoryTranslation
*/
class ProjectsCategoryTranslation extends Model
{
    protected $table = 'projects_category_translations';

    protected $primaryKey = 'projects_category_translations_id';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'theme',
        'parent',
        'sort',
        'description',
        'projects_category_id',
    ];

    protected $guarded = [];
    public function Projects() {
        return $this->hasMany("App\Models\ProjectsTranslation",'projects_category_id');
    }
    public function mainTb()
    {
        return $this->belongsTo('App\Models\ProjectsCategory','projects_category_id','projects_category_id');
    }
    public function ProjectsCategoriesTranslate() {
        return $this->hasMany("App\Models\ProjectsCategoryTranslation");
    }
    public function ParentCategoriesTranslate() {
        return $this->belongsTo('App\Models\ProjectsCategoryTranslation','projects_category_id','parent');
    }

}
