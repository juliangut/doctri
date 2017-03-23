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
use Jgut\Doctrine\Repository\MongoDB\ODM\MongoDBRepository;

/**
 * Repository stub.
 */
class RepositoryStub extends MongoDBRepository
{
    public function getManager(): DocumentManager
    {
        return parent::getManager();
    }
}
