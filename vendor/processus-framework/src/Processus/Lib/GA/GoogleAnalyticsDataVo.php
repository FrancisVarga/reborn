<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 3/28/12
 * Time: 11:14 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib;
class GoogleAnalyticsDataVo extends \Processus\Abstracts\Vo\AbstractVO
    implements \Processus\Lib\GA\InterfaceGoogleAnalyticsData
{

    /**
     * @var string
     */
    private $_host;

    /**
     *
     * @param string $host
     *
     * @return mixed
     */
    public function setHost($host)
    {
        $this->_host = $host;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getHost()
    {
        if (!$this->_host) {
            throw new \Exception("Missing host!");
        }

        return $this->_host;
    }

    /**
     * @var string
     */
    private $_gaUid;

    /**
     * @param $uid
     */
    public function setGaUid($uid)
    {
        $this->_gaUid = $uid;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getGaUid()
    {
        if (!$this->_gaUid) {
            throw new \Exception("Missing GA UID");
        }

        return $this->_gaUid;
    }

    /**
     * @var \UnitedPrototype\GoogleAnalytics\Visitor
     */
    private $_visitor;

    /**
     * @return \UnitedPrototype\GoogleAnalytics\Visitor
     */
    public function getVisitor()
    {
        if (!$this->_visitor) {
            $this->_visitor = new \UnitedPrototype\GoogleAnalytics\Visitor();
        }

        return $this->_visitor;
    }

    /**
     * @var \UnitedPrototype\GoogleAnalytics\Tracker
     */
    private $_tracker;

    /**
     * @return \UnitedPrototype\GoogleAnalytics\Tracker
     */
    public function getTracker()
    {
        if (!$this->_tracker) {
            $this->_tracker = new \UnitedPrototype\GoogleAnalytics\Tracker($this->getGaUid(), $this->getHost());
        }

        return $this->_tracker;
    }

    /**
     * @var \UnitedPrototype\GoogleAnalytics\Page
     */
    private $_page;

    /**
     * @param string $pageToTrack
     *
     * @return \UnitedPrototype\GoogleAnalytics\Page
     */
    public function getPage($pageToTrack = "/")
    {
        if (!$this->_page) {
            $this->_page = new \UnitedPrototype\GoogleAnalytics\Page($pageToTrack);
        }

        return $this->_page;
    }

    /**
     * @var \UnitedPrototype\GoogleAnalytics\Session
     */
    private $_session;

    /**
     * @return \UnitedPrototype\GoogleAnalytics\Session
     */
    public function getSession()
    {
        if (!$this->_session) {
            $this->_session = new \UnitedPrototype\GoogleAnalytics\Session();
        }

        return $this->_session;
    }
}
