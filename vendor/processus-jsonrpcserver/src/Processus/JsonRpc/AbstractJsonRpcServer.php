<?php

namespace Processus\Abstracts\JsonRpc
{

    abstract class AbstractJsonRpcServer extends \Zend\Json\Server\Server
    {
        /**
         * @var array
         */
        protected $_config;

        // #########################################################

        /**
         * @return array
         */
        public function getConfig()
        {
            return $this->_config;
        }


        /**
         * @return bool
         */
        public function hasNamespace()
        {
            if ($this->getRequest()->getSpecifiedNamespace()) {
                return TRUE;
            }

            return FALSE;
        }

        // #########################################################


        /**
         * @return bool
         * @throws \Processus\Exceptions\JsonRpc\ValidJsonRpcRequest
         */
        public function isValidClass()
        {
            if ($this->validateConfigKey('validClasses') && in_array($this->getRequest()->getClass(), $this->getConfigValue('validClasses'))) {
                return TRUE;
            } else {
                $exception = new \Processus\Exceptions\JsonRpc\ValidJsonRpcRequest("Is not a valid class!", "PRC-2001_" . __METHOD__, "10", __FILE__, __LINE__);
                throw $exception;
            }
        }

        // #########################################################


        /**
         * @return bool
         * @throws \Exception
         */
        public function isValidRequest()
        {
            if ($this->hasNamespace() && $this->isValidClass()) {
                return TRUE;
            } else {
                throw new \Exception("Is not a valid request!");
            }
        }

        // #########################################################


        /**
         * @return null|\Zend\Json\Server\Zend\Json\Server\Response
         * @throws \Processus\Exceptions\JsonRpc\ServerException
         */
        public function run()
        {
            // if valid request let it handle via Zend\Json\Server\Server
            if ($this->isValidRequest() === TRUE) {
                // set class
                $this->setClass($this->getRequest()->getSpecifiedServiceClassName());

                // Handle the request:
                return $this->handle();
            } else {
                $exception = new \Processus\Exceptions\JsonRpc\ServerException("Invalid Server Class.");
                $exception->setMethod(__METHOD__);
                throw $exception;
            }
        }

        // #########################################################


        /**
         * @return \Processus\Abstracts\JsonRpc\AbstractJsonRpcRequest
         */
        public function getRequest()
        {
            return parent::getRequest();
        }

        // #########################################################


        /**
         * @param $key
         *
         * @return mixed | bool
         */
        private function getConfigValue($key)
        {
            if (array_key_exists($key, $this->getConfig())) {
                return $this->_config[$key];
            }

            return FALSE;
        }

        /**
         *
         * Get response object
         *
         * @return \Processus\Abstracts\JsonRpc\AbstractJsonRpcResponse
         */
        public function getResponse()
        {
            if (NULL === ($response = $this->_response)) {

                $responseClass = $this->getConfigValue('namespace') . "\\" . "Response";
                $responseFile  = str_replace("\\", "/", $this->getConfigValue('namespace') . "\\" . "Response");
                $classExist    = file_exists(PATH_APP . "/" . $responseFile . '.php');

                if ($classExist) {

                    try {

                        /** @var $responseClass \Processus\Abstracts\JsonRpc\AbstractJsonRpcResponse */
                        $this->_response = new $responseClass();
                        $this->setResponse($this->_response);

                        return $this->_response;

                    } catch (\Exception $error) {
                        throw $error;
                    }

                }
            }

            return $this->_response;
        }

        /**
         * @param \Processus\Abstracts\JsonRpc\AbstractJsonRpcResponse $response
         *
         * @return AbstractJsonRpcServer
         */
        public function setResponse(AbstractJsonRpcResponse $response)
        {
            $this->_response = $response;

            return $this;
        }

        /**
         * Set response state
         *
         * @return Zend\Json\Server\Response
         */
        protected function _getReadyResponse()
        {
            $request  = $this->getRequest();
            $response = $this->getResponse();

            $response->setServiceMap($this->getServiceMap());

            if (NULL !== ($id = $request->getId())) {
                $response->setId($id);
            }
            if (NULL !== ($version = $request->getVersion())) {
                $response->setVersion($version);
            }

            return $response;
        }

        /**
         * @param null $key
         *
         * @return bool
         */
        private function validateConfigKey($key = NULL)
        {
            if (array_key_exists($key, $this->getConfig())) {
                return TRUE;
            }

            return FALSE;
        }
    }
}

?>