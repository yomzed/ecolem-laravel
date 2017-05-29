<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{	
	protected $fillable = ['name', 'description', 'category_id', 'status', 'link'];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function setNameAttribute($value)
	{
		$this->attributes['name']= ucfirst($value);
		$this->attributes['slug'] = str_slug($value);
	}

	public function setStatusAttribute($value)
	{
		$this->attributes['status'] = $value;
		$this->attributes['published_at'] = ($value === 'published') ? \Carbon\Carbon::now() : null;
	}

	public function isTag(int $tagId)
	{
		foreach($this->tags as $tag)
		{
			if($tagId == $tag->id) return true;
		}

		return false;
	}
}
