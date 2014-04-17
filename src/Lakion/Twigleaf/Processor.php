<?php

/*
 * This file is part of the Twigleaf package.
 *
 * (c) Lakion
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lakion\Twigleaf;

/**
 * Override interface.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class Processor implements ProcessorInterface
{
    /**
     * @var RegistryInterface
     */
    private $registry;

    /**
     * @var CrawlerFactoryInterface
     */
    private $crawlerFactory;

    /**
     * @param RegistryInterface            $registry
     * @param null|CrawlerFactoryInterface $crawlerFactory
     */
    public function __construct(RegistryInterface $registry, CrawlerFactoryInterface $crawlerFactory = null)
    {
        $this->registry = $registry;
        $this->crawlerFactory = null === $crawlerFactory ? new CrawlerFactory : $crawlerFactory;
    }

    /**
     * @param string $template
     * @param string $content
     */
    public function process($template, $content)
    {
        $overrides = $this->registry->get($template);

        if (0 === count($overrides)) {
            return;
        }


        $template = $this->crawlerFactory->createCrawler($content);

        foreach ($overrides as $override) {
            $this->apply($override, $template);
        }

        return $template->toHtml();
    }

    /**
     * @param OverrideInterface $override
     * @param Crawler           $template
     */
    private function apply(OverrideInterface $override, Crawler $template)
    {
        foreach ($override->getActions() as $action) {
            $action->apply($template);
        }
    }
}
