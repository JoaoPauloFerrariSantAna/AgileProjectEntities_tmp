<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = "product_tbl";
	protected $fillable = array("name", "stock", "price", "created_at", "updated_at");
}
