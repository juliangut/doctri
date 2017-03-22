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

use Doctrine\ODM\MongoDB\Cursor;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Persisters\DocumentPersister;
use Doctrine\ODM\MongoDB\UnitOfWork;
use Jgut\Doctrine\Repository\MongoDB\ODM\MongoDBRepository;
use Jgut\Doctrine\Repository\MongoDB\ODM\Tests\Stubs\DocumentStub;
use Jgut\Doctrine\Repository\MongoDB\ODM\Tests\Stubs\RepositoryStub;
use PHPUnit\Framework\TestCase;
use Zend\Paginator\Paginator;

/**
 * MongoDB repository tests.
 */
class MongoDBRepositoryTest extends TestCase
{
    public function testDocumentName()
    {
        $manager = $this->getMockBuilder(DocumentManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        /* @var DocumentManager $manager */

        $uow = $this->getMockBuilder(UnitOfWork::class)
            ->disableOriginalConstructor()
            ->getMock();
        /* @var UnitOfWork $uow */

        $repository = new MongoDBRepository($manager, $uow, new ClassMetadata(DocumentStub::class));

        static::assertEquals(DocumentStub::class, $repository->getClassName());
    }

    public function testDocumentManager()
    {
        $manager = $this->getMockBuilder(DocumentManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        /* @var DocumentManager $manager */

        $uow = $this->getMockBuilder(UnitOfWork::class)
            ->disableOriginalConstructor()
            ->getMock();
        /* @var UnitOfWork $uow */

        $repository = new RepositoryStub($manager, $uow, new ClassMetadata(DocumentManager::class));

        static::assertSame($manager, $repository->getManager());
    }

    public function testFindPaginated()
    {
        $manager = $this->getMockBuilder(DocumentManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        /* @var DocumentManager $manager */

        $cursor = $this->getMockBuilder(Cursor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $documentPersister = $this->getMockBuilder(DocumentPersister::class)
            ->disableOriginalConstructor()
            ->getMock();
        $documentPersister->expects(static::once())
            ->method('loadAll')
            ->will(static::returnValue($cursor));

        $uow = $this->getMockBuilder(UnitOfWork::class)
            ->disableOriginalConstructor()
            ->getMock();
        $uow->expects(static::once())
            ->method('getDocumentPersister')
            ->will(static::returnValue($documentPersister));
        /* @var UnitOfWork $uow */

        $repository = new MongoDBRepository($manager, $uow, new ClassMetadata(DocumentStub::class));

        static::assertInstanceOf(Paginator::class, $repository->findPaginatedBy([], ['fakeField' => 'ASC']));
    }

    public function testCount()
    {
        $manager = $this->getMockBuilder(DocumentManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        /* @var DocumentManager $manager */

        $cursor = $this->getMockBuilder(Cursor::class)
            ->disableOriginalConstructor()
            ->getMock();
        $cursor->expects(static::once())
            ->method('count')
            ->will(static::returnValue(10));

        $documentPersister = $this->getMockBuilder(DocumentPersister::class)
            ->disableOriginalConstructor()
            ->getMock();
        $documentPersister->expects(static::once())
            ->method('loadAll')
            ->will(static::returnValue($cursor));

        $uow = $this->getMockBuilder(UnitOfWork::class)
            ->disableOriginalConstructor()
            ->getMock();
        $uow->expects(static::once())
            ->method('getDocumentPersister')
            ->will(static::returnValue($documentPersister));
        /* @var UnitOfWork $uow */

        $repository = new MongoDBRepository($manager, $uow, new ClassMetadata(DocumentStub::class));

        static::assertEquals(10, $repository->countBy(['fakeField' => 'fakeValue', 'arrayFakeField' => []]));
    }
}
