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
class Override implements OverrideInterface
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var ActionInterface[]
     */
    private $actions = array();

    /**
     * @param string $template
     */
    public function __construct($template)
    {
        $this->template = $template;
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * {@inheritdoc}
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * {@inheritdoc}
     */
    public function addAction(ActionInterface $action)
    {
        $this->actions[] = $action;
    }
}
