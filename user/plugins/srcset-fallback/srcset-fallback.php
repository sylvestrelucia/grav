<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Gertt\Grav\Srcset\SrcsetFallback;

class SrcsetFallbackPlugin extends Plugin
{
	protected $srcsetFallback;

	public static function getSubscribedEvents() {
		return [
			'onPluginsInitialized' => ['onPluginsInitialized', 0],
			'onTwigSiteVariables' => ['onTwigSiteVariables', 10],
		];
	}

	public function onPluginsInitialized()
	{
		$autoload = __DIR__ . '/vendor/autoload.php';
		
		if (!is_file($autoload)) {
			$this->grav['logger']->error('Srcset Fallback Plugin failed to load. Composer dependencies not met.');
		}

		require_once $autoload;

		SrcsetFallback::$grav = $this->grav;
		$this->srcsetFallback = new SrcsetFallback($this);
	}

	public function onTwigSiteVariables()
    {
    	$page = $this->grav['page'];
    	$config = $this->mergeConfig($page);

    	$this->srcsetFallback->setConfig($config);
    }
}