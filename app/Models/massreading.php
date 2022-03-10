<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class massreading extends Model
{
    use HasFactory;
    protected $fillable = [
          'firstheading',
           'firstbody',
           'responsorialheading',
           'responsorialresponse',
           'responsorialbody',
           'secondheading',
           'secondbody',
           'alleluiaheading',
           'alleluiabody',
           'gospelheading',
            'gospelbody',
            'dailydate'
    ];
}
