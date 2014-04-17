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

use Lakion\Twigleaf\Crawler;

/**
 * Action interface.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
interface ActionInterface
{
    /**
     * Apply the action to crawler.
     *
     * @param Crawler $template
     */
    public function apply(Crawler $template);
}
