<?php

namespace Promise\Component\Config\Contracts;

interface RepositoryInterface
{
	/**
	 * Set the configuration items.
	 *
	 * @param array $items
	 */
	public function setItems(array $items = []);

	/**
	 * Determine if the given configuration value exists.
	 *
	 * @param  string  $key
	 *
	 * @return bool
	 */
	public function has(string $key): bool;

	/**
	 * Get the specified configuration value.
	 *
	 * @param  array|string  $key
	 * @param  mixed  $default
	 *
	 * @return mixed
	 */
	public function get($key, $default = null);

	/**
	 * Get many configuration values.
	 *
	 * @param  array  $keys
	 *
	 * @return array
	 */
	public function getMany(array $keys): array;

	/**
	 * Set a given configuration value.
	 *
	 * @param  array|string  $key
	 * @param  mixed  $value
	 *
	 * @return void
	 */
	public function set($key, $value = null): void;

	/**
	 * Prepend a value onto an array configuration value.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 *
	 * @return void
	 */
	public function prepend($key, $value): void;

	/**
	 * Push a value onto an array configuration value.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 *
	 * @return void
	 */
	public function push($key, $value): void;

	/**
	 * Get all of the configuration items for the application.
	 *
	 * @return array
	 */
	public function all(): array;
}
