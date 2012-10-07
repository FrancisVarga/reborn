<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 4/18/12
 * Time: 2:27 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Abstracts\Vo;
class AbstractJsonMVO extends AbstractMVO
{
    /**
     * @return object
     */
    public function getFromMem()
    {
        $this->_data = json_decode($this->getMemcachedClient()->fetch($this->getMemId()));
        return $this->_data;
    }

    /**
     * @return Memcached|\Processus\Lib\Db\Memcached
     * @throws \Exception
     */
    public function getMemcachedClient()
    {
        if (!$this->_memcachedClient) {
            try {

                $this->_memcachedClient = \Processus\Lib\Server\ServerFactory::memcachedFactory(
                    $this->getMembaseHost(), $this->getDataBucketPort(),
                    \Processus\Consta\MemcachedFactoryType::MEMCACHED_JSON
                );

            }
            catch (\Exception $error) {

                throw $error;

            }
        }
        return $this->_memcachedClient;
    }

    /**
     * @return int
     * @throws \Processus\Exceptions\MvoException
     */
    public function saveInMem()
    {
        if (!$this->getMemId()) {

            $errorData            = array();
            $errorData['message'] = "Mvo has no Id ";
            $errorData['stack']   = debug_backtrace();

            $mvoException = new \Processus\Exceptions\MvoException();
            $mvoException->setClass(__CLASS__)
                ->setMessage(json_encode($errorData))
                ->setMethod(__METHOD__)
                ->setExtendData(json_encode($this->getData()));

            throw $mvoException;
        }

        $resultCode = $this->getMemcachedClient()->insert(
            $this->getMemId(), json_encode($this->getData()), $this->getExpiredTime()
        );
        $this->_checkResultCode($resultCode);
        $this->_updated();
        return $resultCode;
    }

    /**
     * @param string $mId
     *
     * @return AbstractJsonMVO
     */
    public function setMemId($mId)
    {
        $this->_id = $mId;
        parent::setMemId($mId);
        return $this;
    }
}
