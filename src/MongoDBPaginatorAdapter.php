<?php

/*
 * doctrine-mongodb-odm-repositories (https://github.com/juliangut/doctrine-mongodb-odm-repositories).
 * Doctrine2 MongoDB ODM utility entity repositories.
 *
 * @license MIT
 * @link https://github.com/juliangut/doctrine-mongodb-odm-repositories
 * @author Julián Gutiérrez <juliangut@gmail.com>
 */

declare(strict_types=1);

namespace Jgut\Doctrine\Repository\MongoDB\ODM;

use Doctrine\MongoDB\EagerCursor;
use Doctrine\ODM\MongoDB\Cursor;
use Zend\Paginator\Adapter\AdapterInterface;

/**
 * MongoDB paginator adapter.
 */
class MongoDBPaginatorAdapter implements AdapterInterface
{
    /**
     * @var Cursor
     */
    protected $cursor;

    /**
     * Adapter constructor.
     *
     * @param Cursor $cursor
     */
    public function __construct(Cursor $cursor)
    {
        $this->cursor = $cursor;
    }

    /**
     * {@inheritdoc}
     */
    public function getItems($offset, $itemCountPerPage)
    {
        $cursor = clone $this->cursor;
        $cursor->recreate();
        $cursor->skip($offset);
        $cursor->limit($itemCountPerPage);

        return $cursor->toArray(false);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        // Avoid using EagerCursor::count as this stores a collection without limits to memory
        if ($this->cursor->getBaseCursor() instanceof EagerCursor) {
            return $this->cursor->getBaseCursor()->getCursor()->count();
        }

        return $this->cursor->count();
    }
}
