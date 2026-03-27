<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	protected $table = "sale_tbl";
    protected $fillable = array("user_id", "product_id", "quantity_sold", "sale_date");
}
