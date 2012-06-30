<?php

/*
 * This file is part of the UniplacesPaginationBundle package.
 *
 * (c) Uniplaces
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Uniplaces\PaginationBundle\Paginator;

use Uniplaces\PaginationBundle\Paginator\PageableInterface;

/**
 * AbstractPageable.
 *
 * @author Miguel Manso <miguel.manso@uniplaces.com>
 */
abstract class AbstractPageable implements PageableInterface
{
    /**
     * The route parameter for the page
     * 
     * @var string
     */
    private $pageRouteParameterKey = 'page';

    /**
     * {@inheritdoc }
     */
    public function getPageRouteParameterKey() {
        return $this->pageRouteParameterKey;
    }

    /**
     * {@inheritdoc }
     */
    public function setPageRouteParameterKey($key) {
        if (empty($key)) {
            throw new \InvalidArgumentException('No route page key specified.');
        }

        if (!is_string($key)) {
            throw new \UnexpectedValueException('Expected string got ' . gettype($key) . '.');
        }

        $this->pageRouteParameterKey = $key;
    }
}
