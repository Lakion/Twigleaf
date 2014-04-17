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
class UnwrapSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('p.comment');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\Action\Unwrap');
    }

    function it_implements_action_interface()
    {
        $this->shouldImplement('Lakion\Twigleaf\ActionInterface');
    }

    function it_unwraps_matched_element_from_another_element(Crawler $template, Crawler $elements)
    {
        $template->filter('p.comment')->shouldBeCalled()->willReturn($elements);
        $elements->unwrap()->shouldBeCalled();

        $this->apply($template);
    }
}
