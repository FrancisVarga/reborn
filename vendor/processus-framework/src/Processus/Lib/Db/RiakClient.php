<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 3/12/12
 * Time: 1:06 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Db;

require "../../Contrib/Riak/riak.php";

class RiakClient implements \Processus\Interfaces\InterfaceDatabase
{

    /**
     * @var RiakClient
     */
    private $_client;

    /**
     *
     */
    public function fetch()
    {
        // TODO: Implement fetch() method.
    }

    /**
     *
     */
    public function fetchOne()
    {
        // TODO: Implement fetchOne() method.
    }

    /**
     *
     */
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
