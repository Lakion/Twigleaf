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
 * Overrides registry interface.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
interface RegistryInterface
{
    /**
     * Add override.
     *
     * @param OverrideInterface $override
     */
    public function add(OverrideInterface $override);

    /**
     * Get overrides for given template.
     *
     * @param string $template
     *
     * @return OverrideInterface[]
     */
    public function get($template);
}
