<?php

/*
 * This file is part of the Twigleaf package.
 *
 * (c) Lakion
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Lakion\Twigleaf\Action;

use PhpSpec\ObjectBehavior;
use Lakion\Twigleaf\Crawler;

/**
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class AlterAttributesSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('p.comment', array('data-url' => '{{ test }}', 'foo' => false));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\Action\AlterAttributes');
    }

    function it_implements_action_interface()
    {
        $this->shouldImplement('Lakion\Twigleaf\ActionInterface');
    }

    function it_sets_attributes_if_they_are_defined(Crawler $template, Crawler $elements)
    {
        $this->beConstructedWith('p.comment', array('data-url' => '{{ test }}'));

        $template->filter('p.comment')->shouldBeCalled()->willReturn($elements);
        $elements->setAttribute('data-url', '{{ test }}')->shouldBeCalled();

        $this->apply($template);
    }

    function it_removes_attributes_if_they_are_set_to_false(Crawler $template, Crawler $elements)
    {
        $this->beConstructedWith('p.comment', array('foo' => false));

        $template->filter('p.comment')->shouldBeCalled()->willReturn($elements);
        $elements->removeAttribute('foo')->shouldBeCalled();

        $this->apply($template);
    }
}
