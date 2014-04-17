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
class ToggleClassSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('p.comment', 'highlighted');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\Action\ToggleClass');
    }

    function it_implements_action_interface()
    {
        $this->shouldImplement('Lakion\Twigleaf\ActionInterface');
    }

    function it_toggles_given_class_on_matched_set_of_elements(Crawler $template, Crawler $elements)
    {
        $template->filter('p.comment')->shouldBeCalled()->willReturn($elements);
        $elements->toggleClass('highlighted')->shouldBeCalled();

        $this->apply($template);
    }
}
