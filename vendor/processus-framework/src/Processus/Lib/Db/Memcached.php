<?php

namespace Processus\Lib\Db
{
    class Memcached implements \Processus\Interfaces\InterfaceDatabase
    {
        /**
         * @var \Memcached
         */
        private $_memcachedClient;

        /**
         * @var int
         */
        private $_maxPool = 10;

        /**
         * @param string $host
         * @param string $port
         * @param string $id
         */
        public function __construct(\string $host, \string $port, $id = "default")
        {
            $this->_memcachedClient = new \Memcached($id);

            $this->_memcachedClient->setOption(\Memcached::OPT_COMPRESSION, FALSE);
            $this->_memcachedClient->setOption(\Memcached::OPT_CONNECT_TIMEOUT, 500);
            $this->_memcachedClient->setOption(\Memcached::OPT_TCP_NODELAY, TRUE);
            $this->_memcachedClient->setOption(\Memcached::OPT_CACHE_LOOKUPS, TRUE);
            $this->_memcachedClient->setOption(\Memcached::OPT_NO_BLOCK, TRUE);
            $this->_memcachedClient->setOption(\Memcached::OPT_POLL_TIMEOUT, 500);

            if (count($this->_memcachedClient->getServerList()) <= 1) {
                $this->_memcachedClient->addServer($host, $port);
            }

        }

        /**
         * @return \Memcached
         */
        public function getMemClient()
        {
            return $this->_memcachedClient;
        }

        /**
         * @return array
         */
        public function getStats()
        {
            return $this->_memcachedClient->getStats();
        }

        /**
         * @param $key
         *
         * @return mixed
         */
        public function fetch($key = "foobar")
        {
            return $this->_memcachedClient->get($key);
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
            return $this->_memcachedClient->fetchAll();
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
            $this->_memcachedClient->set($key, $value, $expiredTime);
            $resultCode = $this->_memcachedClient->getResultCode();

            return $resultCode;
        }

        /**
         * @param array $keys
         *
         * @return mixed
         */
        public function getMultipleByKey(array $keys)
        {
            $stupidPHP = NULL;

            return $this->_memcachedClient->getMulti($keys, $stupidPHP, \Memcached::GET_PRESERVE_ORDER);
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

        /**
         * @param $key
         * @param $value
         * @return bool
         */
        public function append($key, $value)
        {
            return $this->_memcachedClient->append($key, $value);
        }
    }
}

?>