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
 * Alters classes of matched elements.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class AlterClasses implements ActionInterface
{
    /**
     * @var string
     */
    private $selector;

    /**
     * @var array
     */
    private $classes;

    /**
     * @param string $selector
     * @param array  $classes
     */
    public function __construct($selector, array $classes)
    {
        $this->selector = $selector;
        $this->classes = $classes;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Crawler $template)
    {
        $elements = $template->filter($this->selector);

        foreach ($this->classes as $class => $action) {
            $action ? $elements->addClass($class) : $elements->removeClass($class);
        }
    }
}
