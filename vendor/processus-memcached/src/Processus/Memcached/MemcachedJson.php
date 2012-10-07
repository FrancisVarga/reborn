<?php

namespace Processus\Memcached;
class MemcachedJson extends Memcached
{
    /**
     * @param $key
     *
     * @return mixed
     */
    public function fetch($key = "foobar")
    {
        return json_decode($this->_memcachedClient->get($key));
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
        if (class_exists($value, FALSE)) {
            throw new \Processus\Exceptions\JsonRpc\ServerException("Can't json_encode a class!");
        }
        $jsonDoc = json_encode($value);
        $this->_memcachedClient->set($key, $jsonDoc, $expiredTime);

        return $this->_memcachedClient->getResultCode();
    }

    /**
     * @param array $keys
     *
     * @return mixed
     */
    public function getMultipleByKey(array $keys)
    {
        $stupidPHP = NULL;

        return json_decode($this->_memcachedClient->getMulti($keys, $stupidPHP, \Memcached::GET_PRESERVE_ORDER));
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
        return $this->_memcachedClient->flush();
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function delete($key)
    {
        return $this->_memcachedClient->delete($key);
    }
}

?>