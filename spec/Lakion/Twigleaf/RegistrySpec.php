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
class RegistrySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\Registry');
    }

    function it_implements_registry_interface()
    {
        $this->shouldImplement('Lakion\Twigleaf\RegistryInterface');
    }

    function it_adds_overrides(OverrideInterface $override1, OverrideInterface $override2)
    {
        $override1->getTemplate()->shouldBeCalled()->willReturn('SyliusWebBundle::template1.html.twig');
        $override2->getTemplate()->shouldBeCalled()->willReturn('SyliusWebBundle::template2.html.twig');

        $this->add($override1);
        $this->add($override2);

        $this->get('SyliusWebBundle::template1.html.twig')->shouldReturn(array($override1));
        $this->get('SyliusWebBundle::template2.html.twig')->shouldReturn(array($override2));
    }

    function it_throws_exception_if_override_has_undefined_template(OverrideInterface $override)
    {
        $override->getTemplate()->shouldBeCalled()->willReturn(null);

        $this
            ->shouldThrow('InvalidArgumentException')
            ->duringAdd($override)
        ;
    }
}
