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
class AlterClassesSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('h1', array('headline' => true, 'promoted' => false));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\Action\AlterClasses');
    }

    function it_implements_action_interface()
    {
        $this->shouldImplement('Lakion\Twigleaf\ActionInterface');
    }

    function it_adds_class_if_set_to_true(Crawler $template, Crawler $elements)
    {
        $this->beConstructedWith('h1', array('headline' => true));

        $template->filter('h1')->shouldBeCalled()->willReturn($elements);
        $elements->addClass('headline')->shouldBeCalled();

        $this->apply($template);
    }

    function it_removes_class_if_set_to_false(Crawler $template, Crawler $elements)
    {
        $this->beConstructedWith('h1', array('promoted' => false));

        $template->filter('h1')->shouldBeCalled()->willReturn($elements);
        $elements->removeClass('promoted')->shouldBeCalled();

        $this->apply($template);
    }
}
