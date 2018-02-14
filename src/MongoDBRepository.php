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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\ODM\MongoDB\Cursor;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Jgut\Doctrine\Repository\EventsTrait;
use Jgut\Doctrine\Repository\FiltersTrait;
use Jgut\Doctrine\Repository\PaginatorTrait;
use Jgut\Doctrine\Repository\Repository;
use Jgut\Doctrine\Repository\RepositoryTrait;
use Zend\Paginator\Paginator;

/**
 * MongoDB document repository.
 */
class MongoDBRepository extends DocumentRepository implements Repository
{
    use RepositoryTrait;
    use EventsTrait;
    use FiltersTrait;
    use PaginatorTrait;

    /**
     * Class name.
     *
     * @var string
     */
    protected $className;

    /**
     * {@inheritdoc}
     */
    public function getClassName(): string
    {
        if ($this->className === null) {
            $this->className = ClassUtils::getRealClass($this->getDocumentName());
        }

        return $this->className;
    }

    /**
     * Finds documents by a set of criteria.
     *
     * @param array    $criteria
     * @param array    $sort
     * @param int|null $limit
     * @param int|null $skip
     *
     * @return ArrayCollection
     *
     * @codeCoverageIgnore
     */
    public function findBy(array $criteria, array $sort = null, $limit = null, $skip = null)
    {
        return new ArrayCollection(parent::findBy($criteria, $sort, $limit, $skip));
    }

    /**
     * {@inheritdoc}
     */
    protected function getFilterCollection()
    {
        return $this->getManager()->getFilterCollection();
    }

    /**
     * {@inheritdoc}
     */
    protected function getManager(): DocumentManager
    {
        return $this->getDocumentManager();
    }

    /**
     * {@inheritdoc}
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int        $itemsPerPage
     *
     * @return \Zend\Paginator\Paginator
     */
    public function findPaginatedBy($criteria, array $orderBy = null, int $itemsPerPage = 10): Paginator
    {
        return $this->paginate($this->getDocumentPersister()->loadAll($criteria, $orderBy), $itemsPerPage);
    }

    /**
     * Paginate MongoDB cursor.
     *
     * @param Cursor $cursor
     * @param int    $itemsPerPage
     *
     * @return Paginator
     */
    protected function paginate(Cursor $cursor, int $itemsPerPage = 10): Paginator
    {
        return $this->getPaginator(new MongoDBPaginatorAdapter($cursor), $itemsPerPage);
    }

    /**
     * {@inheritdoc}
     *
     * @param array $criteria
     *
     * @return int
     */
    public function countBy($criteria): int
    {
        return $this->getDocumentPersister()->loadAll($criteria)->count();
    }
}
