<?php

namespace App;

use Cache;
use Carbon\Carbon;

class CacheRedis implements CacheInterface 
{	
	/**
	 * Get the datas who belongs to the $key
	 * 
	 * @param  string
	 * @return mixed 
	 */
	public function get(string $key)
	{
		return Cache::store('redis')->get($key);
	}

	/**
	 * Save the $data into the specified $key
	 * 
	 * @param string
	 * @param mixed
	 */
	public function set(string $key, $data)
	{
		Cache::store('redis')->put($key, $data, Carbon::now()->addMinutes(env('CACHE_ROBOTS', 5)));
	}

	/**
	 * Empty the specified key
	 * 
	 * @param  string
	 * @return void
	 */
	public function reset(string $key)
	{
		Cache::store('redis')->forget($key);
	}

	/**
	 * Check if the datas under the key are available
	 * 
	 * @param  string
	 * @return boolean
	 */
	public function has(string $key)
	{
		return Cache::store('redis')->has($key);
	}

	public function flush()
	{
		Cache::store('redis')->flush();
	}
}