<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ServicesTranslation;
use App\Models\CustomerServices;

/**
* Class CustomerTranslation
*/
class CustomerTranslation extends Model
{
    protected $table = 'customer_translations';

    protected $primaryKey = 'customer_translations_id';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'image',
        'customer_id',
        'sort',
    ];

    protected $guarded = [];
    public function services($id,$lang)
     {
        $rel= CustomerServices::where('customer_id',$id)->get()->toArray();
        $ser= ServicesTranslation::where(['locale'=>$lang])->get();
        $data = array_map(function($item) {
            return $item['services_id'];
        }, $rel);
        $arr=[];
        if (is_array($data)) {
            foreach ($ser as $item) {
               foreach ($data as $r) {
                   if($r==$item->services_id){
                       array_push($arr,$item);
                   }
               }

            }
        }
      // return $this->belongsToMany('App\Models\Services', 'customer_services',  'customer_id','services_id');
       return $arr;
     }
    public function mainTb()
    {
    return $this->belongsTo('App\Models\Customer','customer_id','customer_id');
    }
}
