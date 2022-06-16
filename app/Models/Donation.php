<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
class Donation extends Model
{
    use HasFactory;
    use SearchableTrait;

    //donations

    protected $searchable  = [
        "columns"=>[
            "donations.reason"=>10,
            "donations.fullname"=>10,
            "donations.amount"=>10,
        ]
      ];

    protected $fillable = [
      'fullname',
       'email',
       'amount',
       'reason',
       'explain',
       'message',
      "referencecode",
    ];
}
