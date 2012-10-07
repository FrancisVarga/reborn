<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 4/3/12
 * Time: 8:31 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\GA;
interface InterfaceGoogleAnalyticsData extends \Processus\Interfaces\InterfaceVo
{

    /**
     * @abstract
     *
     * @param string $host
     *
     * @return mixed
     */
    public function setHost($host);

    /**
     * @abstract
     * @return string
     */
    public function getHost();

    /**
     * @abstract
     *
     * @param string $uid
     *
     * @return mixed
     */
    public function setGaUid($uid);

    /**
     * @abstract
     * @return string
     */
    public function getGaUid();

    /**
     * @abstract
     * @return \UnitedPrototype\GoogleAnalytics\Visitor
     */
    public function getVisitor();

    /**
     * @abstract
     * @return \UnitedPrototype\GoogleAnalytics\Tracker
     */
    public function getTracker();

    /**
     * @abstract
     *
     * @param string $pageToTrack
     *
     * @return mixed
     */
    public function getPage($pageToTrack = "/");

    /**
     * @abstract
     * @return \UnitedPrototype\GoogleAnalytics\Session
     */
    public function getSession();

}
