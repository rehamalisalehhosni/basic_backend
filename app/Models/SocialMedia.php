<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SocialMedia extends Model
{
  protected $table = 'social_media';


  protected $primaryKey = 'social_media_id';

  public $timestamps = true;

  public $fillable = ['title','link','icon','sort'];
  protected $guarded = [];


}
