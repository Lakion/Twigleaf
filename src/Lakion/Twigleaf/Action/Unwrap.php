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
 * Unwrap matched elements.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class Unwrap implements ActionInterface
{
    /**
     * @var string
     */
    private $selector;

    /**
     * @param string $selector
     */
    public function __construct($selector)
    {
        $this->selector = $selector;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Crawler $template)
    {
        $template->filter($this->selector)->unwrap();
    }
}
