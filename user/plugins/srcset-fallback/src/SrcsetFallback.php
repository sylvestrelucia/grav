<?php

namespace Gertt\Grav\Srcset;

use RocketTheme\Toolbox\Event\Event;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

class SrcsetFallback
{
	public static $grav;

	public function __construct()
	{
		$config = self::$grav['config'];
		$this->config = $config->get('plugins.srcset-fallback');

		$events = self::$grav['events'];
		$events->addListener('onTwigSiteVariables', array($this, 'onTwigSiteVariables'), 0);
		$events->addListener('onPageContentProcessed', array($this, 'onPageContentProcessed'), 0);
	}

	public function setConfig($config)
	{
		$this->config = array_merge($this->config, $config->toArray());
	}

	public function onPageContentProcessed(Event $e)
	{
		if ($this->config['mode'] !== 'active') {
			return;
		}

		$content = $e['page']->getRawContent();

		$content = $this->convertHTML($content);

		$e['page']->setRawContent($content);
	}

    public function onTwigSiteVariables(Event $e)
    {
    	if ($this->config['mode'] === 'inactive') {
			return;
		}

        $init = "$(document).ready(function() {
                    $('img[data-srcsetfallback=\"true\"]').each(function() {
                      $(this).attr('style', '');  
                    });
                 });";

        self::$grav['assets']->addJs('plugin://srcset-fallback/js/picturefill.min.js');        
        self::$grav['assets']->addInlineJs($init);
    }

    protected function convertHTML($content)
    {
    	$dom = HtmlPageCrawler::create($content);

		$dom->filter('img')->each(function ($node, $i) {
			$optimized = clone $node;
			$optimized->setAttribute('src', 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=');
			$optimized->setAttribute('data-srcsetfallback', 'true');
			$optimized->setAttribute('style', 'display:none;');
			$optimized->insertBefore($node);

			$node->wrap('<noscript>');
		});

		return $dom->saveHtml();
    }
}

