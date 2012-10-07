<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 2/23/12
 * Time: 9:56 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Db;
class RedisClient implements \Processus\Interfaces\InterfaceDatabase
{

    /**
     * @var
     */
    private $_redisClient;

    public function __construct()
    {
        $this->_redisClient = new \Redis();
    }

    public function fetch()
    {
        // TODO: Implement fetch() method.
    }

    public function fetchOne()
    {
        // TODO: Implement fetchOne() method.
    }

    public function fetchAll()
    {
        // TODO: Implement fetchAll() method.
    }

    /**
     * @return \Zend\Db\Statement\Pdo
     */
    public function insert()
    {
        // TODO: Implement insert() method.
    }

    /**
     * @return \Zend\Db\Statement\Pdo
     */
    public function update()
    {
        // TODO: Implement update() method.
    }
}
