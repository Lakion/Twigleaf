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
 * Override interface.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
interface OverrideInterface
{
    /**
     * Get the template associated with this override.
     *
     * @return string
     */
    public function getTemplate();

    /**
     * Get all actions for this override.
     *
     * @return ActionInterface[]
     */
    public function getActions();
}
