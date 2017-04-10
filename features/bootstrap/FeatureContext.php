<?php

/*
 * This file is part of the Twigleaf package.
 *
 * (c) Lakion
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Behat\Behat\Context\BehatContext;

class FeatureContext extends BehatContext
{
    /**
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->useContext('twigleaf', new TwigleafContext());
    }
}
