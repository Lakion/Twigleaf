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
class ReplaceSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('h1', '<h1>Hello!</h1>');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\Action\Replace');
    }

    function it_implements_action_interface()
    {
        $this->shouldImplement('Lakion\Twigleaf\ActionInterface');
    }

    function it_replaces_elements_with_content(Crawler $template, Crawler $elements)
    {
        $template->filter('h1')->shouldBeCalled()->willReturn($elements);
        $elements->replaceWith('<h1>Hello!</h1>')->shouldBeCalled();

        $this->apply($template);
    }
}
