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
 * Appends element to another element.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class Append implements ActionInterface
{
    /**
     * @var string
     */
    private $selector;

    /**
     * @var string
     */
    private $element;

    /**
     * @param string $selector
     * @param string $element
     */
    public function __construct($selector, $element)
    {
        $this->selector = $selector;
        $this->element = $element;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Crawler $template)
    {
        $template->filter($this->selector)->append($this->element);
    }
}
