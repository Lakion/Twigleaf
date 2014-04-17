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

use Wa72\HtmlPageDom\HtmlPageCrawler;

/**
 * Crawler.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class Crawler extends HtmlPageCrawler
{
    /**
     * Get the HTML code of all elements and their contents.
     *
     * @return string
     */
    public function toHtml()
    {
        return urldecode(preg_replace('/<!DOCTYPE [^>]+>/', '', $this->saveHTML()));
    }
}
