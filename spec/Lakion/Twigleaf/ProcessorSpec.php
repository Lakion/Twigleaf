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

use Lakion\Twigleaf\ActionInterface;
use Lakion\Twigleaf\Crawler;
use Lakion\Twigleaf\CrawlerFactoryInterface;
use Lakion\Twigleaf\OverrideInterface;
use Lakion\Twigleaf\RegistryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class ProcessorSpec extends ObjectBehavior
{
    function let(RegistryInterface $registry, CrawlerFactoryInterface $crawlerFactory)
    {
        $this->beConstructedWith($registry, $crawlerFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\Processor');
    }

    function it_implements_processor_interface()
    {
        $this->shouldImplement('Lakion\Twigleaf\ProcessorInterface');
    }

    function it_does_nothing_if_overrides_do_not_exist_for_given_template(
        $registry,
        $crawlerFactory,
        OverrideInterface $override,
        ActionInterface $action1,
        ActionInterface $action2
    )
    {
        $registry->get('SyliusWebBundle:Frontend:layout.html.twig')->shouldBeCalled()->willReturn(array());
        $crawlerFactory->createCrawler(Argument::any())->shouldNotBeCalled();
        $override->getActions()->shouldNotBeCalled();
        $action1->apply(Argument::any())->shouldNotBeCalled();
        $action2->apply(Argument::any())->shouldNotBeCalled();

        $this->process('SyliusWebBundle:Frontend:layout.html.twig', '<html><body>{{ hello }}</html></html>');
    }

    function it_applies_all_override_actions_to_given_template(
        $registry,
        $crawlerFactory,
        OverrideInterface $override,
        ActionInterface $action1,
        ActionInterface $action2,
        Crawler $crawler
    )
    {
        $content = '<html><body>{{ hello }}</html></html>';

        $registry->get('SyliusWebBundle:Frontend:theme.html.twig')->shouldBeCalled()->willReturn(array($override));
        $crawlerFactory->createCrawler($content)->shouldBeCalled()->willReturn($crawler);
        $override->getActions()->shouldBeCalled()->willReturn(array($action1, $action2));
        $action1->apply($crawler)->shouldBeCalled();
        $action2->apply($crawler)->shouldBeCalled();

        $this->process('SyliusWebBundle:Frontend:theme.html.twig', $content);
    }
}
