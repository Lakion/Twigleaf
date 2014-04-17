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
class RemoveSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('div#comments');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\Action\Remove');
    }

    function it_implements_action_interface()
    {
        $this->shouldImplement('Lakion\Twigleaf\ActionInterface');
    }

    function it_removes_elements_matching_selector_when_applied(Crawler $template, Crawler $elements)
    {
        $template->filter('div#comments')->shouldBeCalled()->willReturn($elements);
        $elements->remove()->shouldBeCalled();

        $this->apply($template);
    }
}
