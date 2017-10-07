[![PHP version](https://img.shields.io/badge/PHP-%3E%3D7.0-8892BF.svg?style=flat-square)](http://php.net)
[![Latest Version](https://img.shields.io/packagist/vpre/juliangut/doctrine-mongodb-odm-repositories.svg?style=flat-square)](https://packagist.org/packages/juliangut/doctrine-mongodb-odm-repositories)
[![License](https://img.shields.io/github/license/juliangut/doctrine-mongodb-odm-repositories.svg?style=flat-square)](https://github.com/juliangut/doctrine-mongodb-odm-repositories/blob/master/LICENSE)

[![Build Status](https://img.shields.io/travis/juliangut/doctrine-mongodb-odm-repositories.svg?style=flat-square)](https://travis-ci.org/juliangut/doctrine-mongodb-odm-repositories)
[![Style Check](https://styleci.io/repos/85864913/shield)](https://styleci.io/repos/85864913)
[![Code Quality](https://img.shields.io/scrutinizer/g/juliangut/doctrine-mongodb-odm-repositories.svg?style=flat-square)](https://scrutinizer-ci.com/g/juliangut/doctrine-mongodb-odm-repositories)
[![Code Coverage](https://img.shields.io/coveralls/juliangut/doctrine-mongodb-odm-repositories.svg?style=flat-square)](https://coveralls.io/github/juliangut/doctrine-mongodb-odm-repositories)

[![Total Downloads](https://img.shields.io/packagist/dt/juliangut/doctrine-mongodb-odm-repositories.svg?style=flat-square)](https://packagist.org/packages/juliangut/doctrine-mongodb-odm-repositories)
[![Monthly Downloads](https://img.shields.io/packagist/dm/juliangut/doctrine-mongodb-odm-repositories.svg?style=flat-square)](https://packagist.org/packages/juliangut/doctrine-mongodb-odm-repositories)

# doctrine-mongodb-odm-repositories

Doctrine2 MongoDB ODM utility entity repositories

## Installation

### Composer

```
composer require juliangut/doctrine-mongodb-odm-repositories
```

_Might need "--ignore-platform-reqs" flag_

## Usage

### Use repositoryClass on mapped classes

```php
/**
 * Comment MongoDB document.
 *
 * @ODM\Document(repositoryClass="\Jgut\Doctrine\Repository\MongoDB\ODM\MongoDBRepository")
 */
class Comment
{
}
```

### Register factory on managers

When creating object managers you can set a repository factory to create default repositories such as follows

```php
use Jgut\Doctrine\Repository\Factory\MongoDBRepositoryFactory;

$config = new \Doctrine\ODM\MongoDB\Configuration;
$config->setRepositoryFactory(new MongoDBRepositoryFactory);

$documentManager = \Doctrine\ODM\MongoDB\DocumentManager::create(new \Doctrine\MongoDB\Connection(...), $config);
```

> For an easier way of registering repository factories and managers generation in general have a look at [juliangut/doctrine-manager-builder](https://github.com/juliangut/doctrine-manager-builder)

## Functionalities

Head to [juliangut/doctrine-base-repositories](https://github.com/juliangut/doctrine-base-repositories) for a full list of new functionalities provided by the repository

## Contributing

Found a bug or have a feature request? [Please open a new issue](https://github.com/juliangut/doctrine-mongodb-odm-repositories/issues). Have a look at existing issues before.

See file [CONTRIBUTING.md](https://github.com/juliangut/doctrine-mongodb-odm-repositories/blob/master/CONTRIBUTING.md)

## License

See file [LICENSE](https://github.com/juliangut/doctrine-mongodb-odm-repositories/blob/master/LICENSE) included with the source code for a copy of the license terms.
