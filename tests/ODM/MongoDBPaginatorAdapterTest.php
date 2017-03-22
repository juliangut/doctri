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

namespace Jgut\Doctrine\Repository\MongoDB\ODM\Tests;

use Doctrine\MongoDB\EagerCursor;
use Doctrine\ODM\MongoDB\Cursor;
use Jgut\Doctrine\Repository\MongoDB\ODM\MongoDBPaginatorAdapter;

/**
 * MongoDB paginator adapter tests.
 *
 * @group mongo
 */
class MongoDBPaginatorAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testItems()
    {
        $cursor = $this->getMockBuilder(Cursor::class)
            ->disableOriginalConstructor()
            ->getMock();
        $cursor->expects(self::any())
            ->method('recreate');
        $cursor->expects(self::any())
            ->method('skip');
        $cursor->expects(self::any())
            ->method('limit');
        $cursor->expects(self::any())
            ->method('toArray')
            ->will(self::returnValue([1, 2, 3]));
        /* @var Cursor $cursor */

        $adapter = new MongoDBPaginatorAdapter($cursor);

        static::assertEquals([1, 2, 3], $adapter->getItems(0, 10));
    }

    public function testCount()
    {
        $cursor = $this->getMockBuilder(Cursor::class)
            ->disableOriginalConstructor()
            ->getMock();
        $cursor->expects(self::any())
            ->method('count')
            ->will(self::returnValue(10));
        /* @var Cursor $cursor */

        $adapter = new MongoDBPaginatorAdapter($cursor);

        static::assertEquals(10, $adapter->count());
    }

    public function testEagerCount()
    {
        $baseCursor = $this->getMockBuilder(Cursor::class)
            ->disableOriginalConstructor()
            ->getMock();
        $baseCursor->expects(self::any())
            ->method('count')
            ->will(self::returnValue(20));
        /* @var Cursor $baseCursor */

        $eagerCursor = $this->getMockBuilder(EagerCursor::class)
            ->disableOriginalConstructor()
            ->getMock();
        $eagerCursor->expects(self::any())
            ->method('getCursor')
            ->will(self::returnValue($baseCursor));
        /* @var EagerCursor $eagerCursor */

        $cursor = $this->getMockBuilder(Cursor::class)
            ->disableOriginalConstructor()
            ->getMock();
        $cursor->expects(self::any())
            ->method('getBaseCursor')
            ->will(self::returnValue($eagerCursor));
        /* @var Cursor $cursor */

        $adapter = new MongoDBPaginatorAdapter($cursor);

        static::assertEquals(20, $adapter->count());
    }
}
