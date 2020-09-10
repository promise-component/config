<?php

namespace Promise\Component\Config\Console;

use Illuminate\Filesystem\Filesystem;
use LogicException;
use Promise\Foundation\Console\Command;
use Promise\Foundation\Console\Contracts\KernelInterface;
use Throwable;

class ConfigCacheCommand extends Command
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected string $name = 'config:cache';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected ?string $description = 'Create a cache file for faster configuration loading';

	/**
	 * The filesystem instance.
	 *
	 * @var \Illuminate\Filesystem\Filesystem
	 */
	protected Filesystem $files;

	/**
	 * Create a new config cache command instance.
	 *
	 * @param  \Illuminate\Filesystem\Filesystem  $files
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
	 *
	 * @throws \LogicException
	 */
	public function handle()
	{
		$this->call('config:clear');

		$config = $this->getFreshConfiguration();

		$configPath = $this->promise->getCachedConfigPath();

		$this->files->put(
			$configPath, '<?php return '.var_export($config, true).';'.PHP_EOL
		);

		try {
			require $configPath;
		}
		catch (Throwable $e) {
			$this->files->delete($configPath);

			throw new LogicException('Your configuration files are not serializable.', 0, $e);
		}

		$this->info('Configuration cached successfully!');
	}

	/**
	 * Boot a fresh copy of the application configuration.
	 *
	 * @return array
	 */
	protected function getFreshConfiguration()
	{
		$app = require $this->promise->bootstrapPath(['app.php']);

		$app->make(KernelInterface::class)->bootstrap();

		return $app['config']->all();
	}
}
