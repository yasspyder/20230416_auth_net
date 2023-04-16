<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'id', 
		'title', 
		'text', 
		'is_private', 
		'category_id'
	];
	use HasFactory;

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id')->first();
	}
}
