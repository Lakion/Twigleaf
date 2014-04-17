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

use PhpSpec\ObjectBehavior;
use Lakion\Twigleaf\ActionInterface;

/**
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class OverrideSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('SyliusWebBundle:Backend/Product:show.html.twig');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Twigleaf\Override');
    }

    function it_implements_override_interface()
    {
        $this->shouldImplement('Lakion\Twigleaf\OverrideInterface');
    }

    function it_returns_template_name()
    {
        $this->getTemplate()->shouldReturn('SyliusWebBundle:Backend/Product:show.html.twig');
    }

    function it_intializes_action_collection_by_default()
    {
        $this->getActions()->shouldReturn(array());
    }

    function it_adds_actions(ActionInterface $action)
    {
        $this->addAction($action);
        $this->getActions()->shouldReturn(array($action));
    }
}
