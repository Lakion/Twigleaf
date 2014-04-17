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
class InsertBeforeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('p.comment', '<a href="#">Foo</a>');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\Action\InsertBefore');
    }

    function it_implements_action_interface()
    {
        $this->shouldImplement('Lakion\Twigleaf\ActionInterface');
    }

    function it_inserts_content_before_matched_elements(Crawler $template, Crawler $elements)
    {
        $template->filter('p.comment')->shouldBeCalled()->willReturn($elements);
        $elements->insertBefore('<a href="#">Foo</a>')->shouldBeCalled();

        $this->apply($template);
    }
}
