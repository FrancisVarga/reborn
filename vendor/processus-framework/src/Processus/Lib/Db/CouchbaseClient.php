<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 2/18/12
 * Time: 8:07 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Db;
class CouchbaseClient implements \Processus\Interfaces\InterfaceDatabase
{
    /**
     * @var \Couchbase
     */
    private $_couchbaseClient;

    /**
     * @param string $host // example: 127.0.0.1:8091
     * @param string $userName
     * @param string $password
     * @param string $couchbaseBucket
     */
    public function __construct(\string $host, \string $userName, \string $password, \string $couchbaseBucket)
    {
        $this->_couchbaseClient = new \Couchbase($host, $userName, $password, $couchbaseBucket);

        $this->_couchbaseClient->setOption(COUCHBASE_OPT_COMPRESSER, FALSE);
    }

    /**
     * @return array
     */
    public function getStats()
    {
        return $this->_couchbaseClient->getStats();
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function fetch($key = "foobar")
    {
        return $this->_couchbaseClient->get($key);
    }

    /**
     * @throws \Exception
     */
    public function fetchOne()
    {
        throw new \Exception("Not implemented");
    }

    /**
     * @throws \Exception
     */
    public function fetchAll()
    {
        throw new \Exception("Not implemented");
    }

    /**
     * @param string $key
     * @param array  $value
     * @param int    $expiredTime
     *
     * @return int
     */
    public function insert($key = "foobar", $value = array(), $expiredTime = 1)
    {
        return $this->_couchbaseClient->set($key, $value, $expiredTime);
    }

    /**
     * @param array $keys
     *
     * @return mixed
     */
    public function getMultipleByKey(array $keys)
    {
        $stupidPHP = null;
        return $this->_couchbaseClient->getMulti($keys, $stupidPHP, \Memcached::GET_PRESERVE_ORDER);
    }

    /**
     * @throws \Exception
     */
    public function update()
    {
        throw new \Exception("Not implemented");
    }

    /**
     * @return bool
     */
    public function flush()
    {
        return $this->_couchbaseClient->flush();
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function delete($key)
    {
        return $this->_couchbaseClient->delete($key);
    }
}
