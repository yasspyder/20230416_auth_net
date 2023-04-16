<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
	public $timestamps = false;
	protected $fillable = ['id', 'category_name'];
	use HasFactory;

	public function news()
	{
		return $this->hasMany(News::class, 'category_id');
	}
}
