<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PracticalTests extends Authenticatable
{
    use Notifiable;

 	protected $fillable = [
        'order_id','pin_type_id','payment_type','customer_name','full_address','order_date','price','quantity','product_name',
    ];
        public $timestamps = false;

}
