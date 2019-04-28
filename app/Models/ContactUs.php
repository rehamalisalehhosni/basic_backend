<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* Class ContactUs
*/
class ContactUs extends Model
{
    protected $table = 'contact_us';

    protected $primaryKey = 'contact_us_id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];

    protected $guarded = [];


}
