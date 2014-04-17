<?php

/*
 * This file is part of the Twigleaf package.
 *
 * (c) Lakion
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lakion\Twigleaf\Action;

use Lakion\Twigleaf\ActionInterface;
use Lakion\Twigleaf\Crawler;

/**
 * Toggles class on matched elements.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class ToggleClass implements ActionInterface
{
    /**
     * @var string
     */
    private $selector;

    /**
     * @var string
     */
    private $class;

    /**
     * @param string $selector
     * @param string $class
     */
    public function __construct($selector, $class)
    {
        $this->selector = $selector;
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Crawler $template)
    {
        $template->filter($this->selector)->toggleClass($this->class);
    }
}
