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
 * Replaces elements matching the given selector with custom content.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class Replace implements ActionInterface
{
    /**
     * @var string
     */
    private $selector;

    /**
     * @var string
     */
    private $text;

    /**
     * @param string $selector
     * @param string $text
     */
    public function __construct($selector, $text)
    {
        $this->selector = $selector;
        $this->text = $text;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Crawler $template)
    {
        $template->filter($this->selector)->replaceWith($this->text);
    }
}
