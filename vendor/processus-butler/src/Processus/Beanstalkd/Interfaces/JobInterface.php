<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 3/16/12
 * Time: 11:26 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Beanstalkd\Interfaces;
interface InterfaceJob
{
    /**
     * @abstract
     * @return mixed
     */
    public function startJob();
}
