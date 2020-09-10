<?php

namespace Promise\Component\Config\Console;

use Illuminate\Filesystem\Filesystem;
use Promise\Foundation\Console\Command;

class ConfigClearCommand extends Command
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected string $name = 'config:clear';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected ?string $description = 'Remove the configuration cache file';

	/**
	 * The filesystem instance.
	 *
	 * @var \Illuminate\Filesystem\Filesystem
	 */
	protected Filesystem $files;

	/**
	 * Create a new config clear command instance.
	 *
	 * @param  \Illuminate\Filesystem\Filesystem  $files
	 *
	 * @return void
	 */
	public function __construct(Filesystem $files)
	{
		parent::__construct();

		$this->files = $files;
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->files->delete($this->promise->getCachedConfigPath());

		$this->info('Configuration cache cleared!');
	}
}
