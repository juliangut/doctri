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

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\UnitOfWork;
use Jgut\Doctrine\Repository\MongoDB\ODM\MongoDBRepository;
use Jgut\Doctrine\Repository\MongoDB\ODM\MongoDBRepositoryFactory;
use Jgut\Doctrine\Repository\MongoDB\ODM\Tests\Stubs\DocumentStub;
use PHPUnit\Framework\TestCase;

/**
 * MongoDB repository factory tests.
 */
class MongoDBRepositoryFactoryTest extends TestCase
{
    public function testCount()
    {
        $classMetadata = new ClassMetadata(DocumentStub::class);

        $uow = $this->getMockBuilder(UnitOfWork::class)
            ->disableOriginalConstructor()
            ->getMock();

        $manager = $this->getMockBuilder(DocumentManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $manager->expects(static::any())
            ->method('getUnitOfWork')
            ->will(static::returnValue($uow));
        $manager->expects(static::any())
            ->method('getClassMetadata')
            ->will(static::returnValue($classMetadata));
        /* @var DocumentManager $manager */

        $factory = new MongoDBRepositoryFactory();

        $repository = $factory->getRepository($manager, DocumentStub::class);

        static::assertInstanceOf(MongoDBRepository::class, $repository);
        static::assertEquals($repository, $factory->getRepository($manager, DocumentStub::class));
    }
}
