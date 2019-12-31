<?php

/**
 * @see       https://github.com/mezzio/mezzio-problem-details for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-problem-details/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-problem-details/blob/master/LICENSE.md New BSD License
 */

namespace Mezzio\ProblemDetails;

use Psr\Container\ContainerInterface;

class ProblemDetailsNotFoundHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ProblemDetailsNotFoundHandler
    {
        return $container->has(ProblemDetailsResponseFactory::class)
            ? new ProblemDetailsNotFoundHandler($container->get(ProblemDetailsResponseFactory::class))
            : new ProblemDetailsNotFoundHandler();
    }
}