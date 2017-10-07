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

namespace Jgut\Doctrine\Repository\MongoDB\ODM\Tests\Stubs;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Query\FilterCollection;
use Jgut\Doctrine\Repository\MongoDB\ODM\MongoDBRepository;

/**
 * Repository stub.
 */
class RepositoryStub extends MongoDBRepository
{
    /**
     * @return FilterCollection
     */
    public function getFilterCollection(): FilterCollection
    {
        return parent::getFilterCollection();
    }

    /**
     * @return DocumentManager
     */
    public function getManager(): DocumentManager
    {
        return parent::getManager();
    }
}
