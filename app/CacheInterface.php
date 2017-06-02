<?php
/**
 * This interface must be use to store datas into the cache
 * Bind the environement storage into the service provider
 * 
 */
namespace App;

interface CacheInterface 
{
	public function get(string $key);

	public function set(string $key, $data);

	public function reset(string $key);

	public function has(string $key);

	public function flush();
}