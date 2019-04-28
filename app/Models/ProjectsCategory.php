<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectsCategoryTranslation;

/**
* Class News
*/
class ProjectsCategory extends Model
{
    protected $table = 'projects_category';

    protected $primaryKey = 'projects_category_id';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'parent',
        'theme',
        'sort',
        'description',
        'projects_category_id',
    ];

    protected $guarded = [];
    public function Projects() {
        return $this->hasMany("App\Models\Projects");
    }
    public function ProjectsCategories() {
        return $this->hasMany("App\Models\ProjectsCategory");
    }
    public function ParentCategories() {
        return $this->belongsTo('App\Models\ProjectsCategory','parent','projects_category_id');
    }
    public function translations($lang,$id)
    {
        return ProjectsCategoryTranslation::where(['locale'=>$lang,'projects_category_id'=>$id])->first();
    }


}
