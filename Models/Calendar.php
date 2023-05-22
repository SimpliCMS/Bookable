<?php

namespace Modules\Bookable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calendar extends Model {

    use HasFactory;

    protected $table = 'calendar';
    protected $fillable = [
        'title', 'start', 'end'
    ];

}
