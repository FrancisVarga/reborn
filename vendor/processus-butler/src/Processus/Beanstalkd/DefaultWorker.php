<?php
/**
 * Created by IntelliJ IDEA.
 * User: francis
 * Date: 9/25/11
 * Time: 4:28 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Processus\Lib\Beanstalkd
{
    class DefaultWorker extends AbstractWorker
    {

        public function startWorker()
        {

        }

        /**
         * @return string
         */
        protected function _getLogTable()
        {
            // TODO: Implement _getLogTable() method.
        }

        /**
         *
         * @param $rawObject
         *
         * @return array
         */
        protected function _getSqlLogParams($rawObject)
        {
            // TODO: Implement _getSqlLogParams() method.
        }
    }
}