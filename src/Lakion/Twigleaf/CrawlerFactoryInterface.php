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
 * Crawler factory interface.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
interface CrawlerFactoryInterface
{
    /**
     * Create a new crawler instance for given content.
     *
     * @param string $content
     *
     * @return Crawler
     */
    public function createCrawler($content);
}
