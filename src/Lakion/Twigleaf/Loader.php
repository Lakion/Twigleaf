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

use \Twig_LoaderInterface;

/**
 * Twig loader which processes template sources.
 *
 * @author Paweł Jędrzejewski <pawel.jedrzejewski@lakion.com>
 */
class Loader implements Twig_LoaderInterface
{
    /**
     * The real Twig loader.
     *
     * @var Twig_LoaderInterface
     */
    private $loader;

    /**
     * @var ProcessorInterface
     */
    private $processor;

    /**
     * @param Twig_LoaderInterface $loader
     * @param ProcessorInterface   $processor
     */
    public function __construct(Twig_LoaderInterface $loader, ProcessorInterface $processor)
    {
        $this->loader = $loader;
        $this->processor = $processor;
    }

    /**
     * {@inheritdoc}
     */
    public function getSource($name)
    {
        $template = $this->loader->getSource($name);

        return $this->processor->process($name, $template);
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheKey($name)
    {
        return $this->loader->getCacheKey($name);
    }

    /**
     * {@inheritdoc}
     */
    public function isFresh($name, $time)
    {
        return $this->loader->isFresh($name, $time);
    }
}
