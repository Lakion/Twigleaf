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
 * Factory used to create Crawler for template contents.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class CrawlerFactory implements CrawlerFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createCrawler($content)
    {
        $crawler = new Crawler($content);

        return $crawler;
    }
}
