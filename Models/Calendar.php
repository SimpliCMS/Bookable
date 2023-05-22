<?php

namespace Modules\Bookable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Bookable\Contracts\Calendar as CalendarContract;

class Calendar extends Model implements CalendarContract {

    use HasFactory;

    protected $table = 'calendar';
    protected $fillable = [
        'title', 'start', 'end'
    ];

}
