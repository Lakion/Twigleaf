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

use Lakion\Twigleaf\ProcessorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use \Twig_LoaderInterface;

/**
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class LoaderSpec extends ObjectBehavior
{
    function let(Twig_LoaderInterface $loader, ProcessorInterface $processor)
    {
        $this->beConstructedWith($loader, $processor);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\Loader');
    }

    function it_is_a_Twig_loader()
    {
        $this->shouldImplement('Twig_LoaderInterface');
    }

    function it_processes_template_source_when_loading($loader, $processor)
    {
        $loader->getSource('foo.html.twig')->shouldBeCalled()->willReturn('<html>Yey!</html>');
        $processor->process('foo.html.twig', '<html>Yey!</html>')->shouldBeCalled()->willReturn('<html><b>Awesome!</b></html>');

        $this->getSource('foo.html.twig')->shouldReturn('<html><b>Awesome!</b></html>');
    }

    function it_delegates_cache_key_request_to_real_loader($loader)
    {
        $loader->getCacheKey('foo.html.twig')->shouldBeCalled()->willReturn('random key');
        $this->getCacheKey('foo.html.twig')->shouldReturn('random key');
    }

    function it_delegates_freshness_check_to_real_loader($loader)
    {
        $loader->isFresh('foo.html.twig', 3600)->shouldBeCalled()->willReturn(false);
        $this->isFresh('foo.html.twig', 3600)->shouldReturn(false);

        $loader->isFresh('foo.html.twig', 3600)->shouldBeCalled()->willReturn(true);
        $this->isFresh('foo.html.twig', 3600)->shouldReturn(true);
    }
}
