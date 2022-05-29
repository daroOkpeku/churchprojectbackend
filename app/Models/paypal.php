<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paypal extends Model
{
    use HasFactory;
    protected $fillable = [
      'access_token',
       'token_type',
       'app_id',
       'expires_in',
    ];
}
