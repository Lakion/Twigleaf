<?php

/*
 * This file is part of the Twigleaf package.
 *
 * (c) Lakion
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Lakion\Twigleaf;

use PhpSpec\ObjectBehavior;

/**
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class CrawlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\Crawler');
    }

    function it_extends_html_page_crawler()
    {
        $this->shouldHaveType('Wa72\HtmlPageDom\HtmlPageCrawler');
    }
}
