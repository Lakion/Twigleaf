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
 * Alters attributes of matched elements.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class AlterAttributes implements ActionInterface
{
    /**
     * @var string
     */
    private $selector;

    /**
     * @var array
     */
    private $attributes;

    /**
     * @param string $selector
     * @param array  $attributes
     */
    public function __construct($selector, array $attributes)
    {
        $this->selector = $selector;
        $this->attributes = $attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Crawler $template)
    {
        $elements = $template->filter($this->selector);

        foreach ($this->attributes as $attribute => $value) {
            false === $value ? $elements->removeAttribute($attribute) : $elements->setAttribute($attribute, $value);
        }
    }
}
