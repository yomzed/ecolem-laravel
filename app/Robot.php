<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{	
	protected $fillable = ['name', 'description', 'category_id', 'status', 'link', 'power'];

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

	public function scopeCountPublished($query)
	{
		return $query->where('status', 'published')->count();
	}

	public function scopePublished($query, $status = 'published')
	{
		return $query->where('status', $status)
					 ->orderBy('published_at', env('ORDER_ROBOT', 'DESC'))
					 ->orderBy('created_at', env('ORDER_ROBOT', 'DESC'));
	}

	public function scopePower($query, $power = 50)
	{
		return $query->where('power', '<', $power)
					 ->count();
	}
}
