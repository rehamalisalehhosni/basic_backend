<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* Class Newsletter
*/
class Newsletter extends Model
{
    protected $table = 'newsletter';

    protected $primaryKey = 'newsletter_id';

    public $timestamps = true;

    protected $fillable = [
        'email',
    ];

    protected $guarded = [];


}
