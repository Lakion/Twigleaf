<?php

/*
 * This file is part of the Twigleaf package.
 *
 * (c) Lakion
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lakion\Twigleaf;

/**
 * Registry holds all overrides for templates to apply.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class Registry implements RegistryInterface
{
    /**
     * @var OverrideInterface[]
     */
    private $overrides = array();

    /**
     * {@inheritdoc}
     */
    public function add(OverrideInterface $override)
    {
        if (null === $template = $override->getTemplate()) {
            throw new \InvalidArgumentException('Override needs to have a template defined.');
        }

        if (!array_key_exists($template, $this->overrides)) {
            $this->overrides[$template] = array();
        }

        $this->overrides[$template][] = $override;
    }

    /**
     * {@inheritdoc}
     */
    public function get($template)
    {
        if (!array_key_exists($template, $this->overrides)) {
            return array();
        }

        return $this->overrides[$template];
    }
}
