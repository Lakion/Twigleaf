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

use Lakion\Twigleaf\OverrideInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class CrawlerFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\CrawlerFactory');
    }

    function it_implements_crawler_factory_interface()
    {
        $this->shouldImplement('Lakion\Twigleaf\CrawlerFactoryInterface');
    }

    function it_creates_crawler_instance_for_given_template_source()
    {
        $this->createCrawler('<html></html>')->shouldHaveType('Lakion\Twigleaf\Crawler');
    }
}
