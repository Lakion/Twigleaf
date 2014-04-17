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
 * Processor interface.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
interface ProcessorInterface
{
    /**
     * Process template with overrides.
     *
     * @param string $template
     * @param string $content
     *
     * @return string The final output of template source
     */
    public function process($template, $content);
}
