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
class AlterCssAttributesSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('p.comment', array('margin-top' => '10px', 'color' => '#1abb9c'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\Action\AlterCssAttributes');
    }

    function it_implements_action_interface()
    {
        $this->shouldImplement('Lakion\Twigleaf\ActionInterface');
    }

    function it_modifies_css_attributes(Crawler $template, Crawler $elements)
    {
        $template->filter('p.comment')->shouldBeCalled()->willReturn($elements);

        $elements->css('margin-top', '10px')->shouldBeCalled();
        $elements->css('color', '#1abb9c')->shouldBeCalled();

        $this->apply($template);
    }
}
