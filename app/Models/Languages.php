<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Languages extends Model
{
  protected $table = 'languages';


  protected $primaryKey = 'languages_id';

  public $timestamps = true;

  public $fillable = ['title','code','icon','sort'];
  protected $guarded = [];


}
