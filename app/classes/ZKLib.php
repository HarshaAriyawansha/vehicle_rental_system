<?php
namespace App\Classes;
require(__DIR__ . '/vendor/autoload.php');

use ZK\Util;

class ZKLib
{
    public $_ip;
    public $_port;
    public $_zkclient;

    public $_data_recv = '';
    public $_session_id = 0;
    public $_section = '';

    /**
     * ZKLib constructor.
     * @param string $ip Device IP
     * @param integer $port Default: 4370
     */
    public function __construct($ip, $port = 4370)
    {
        $this->_ip = $ip;
        $this->_port = $port;

        $this->_zkclient = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

        $timeout = ['sec' => 60, 'usec' => 500000];
        socket_set_option($this->_zkclient, SOL_SOCKET, SO_RCVTIMEO, $timeout);

    }

    /**
     * Create and send command to device
     *
     * @param string $command
     * @param string $command_string
     * @param string $type
     * @return bool|mixed
     */
    public function _command($command, $command_string, $type = Util::COMMAND_TYPE_GENERAL)
    {
        $chksum = 0;
        $session_id = $this->_session_id;

        $u = unpack('H2h1/H2h2/H2h3/H2h4/H2h5/H2h6/H2h7/H2h8', substr($this->_data_recv, 0, 8));
        $reply_id = hexdec($u['h8'] . $u['h7']);

        $buf = Util::createHeader($command, $chksum, $session_id, $reply_id, $command_string);

        socket_sendto($this->_zkclient, $buf, strlen($buf), 0, $this->_ip, $this->_port);

        try {
            @socket_recvfrom($this->_zkclient, $this->_data_recv, 1024, 0, $this->_ip, $this->_port);

            $u = unpack('H2h1/H2h2/H2h3/H2h4/H2h5/H2h6', substr($this->_data_recv, 0, 8));

            $ret = false;
            $session = hexdec($u['h6'] . $u['h5']);

            if ($type === Util::COMMAND_TYPE_GENERAL && $session_id === $session) {
                $ret = substr($this->_data_recv, 8);
            } else if ($type === Util::COMMAND_TYPE_DATA && !empty($session)) {
                $ret = $session;
            }

            return $ret;
        } catch (ErrorException $e) {
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Connect to device
     *
     * @return bool
     */
    public function connect()
    {
        return (new ZK\Connect())->connect($this);
    }

    /**
     * Disconnect from device
     *
     * @return bool
     */
    public function disconnect()
    {
        return (new ZK\Connect())->disconnect($this);
    }

    /**
     * Get device version
     *
     * @return bool|mixed
     */
    public function version()
    {
        return (new ZK\Version())->get($this);
    }

    /**
     * Get OS version
     *
     * @return bool|mixed
     */
    public function osVersion()
    {
        return (new ZK\Os())->get($this);
    }

    /**
     * Get platform
     *
     * @return bool|mixed
     */
    public function platform()
    {
        return (new ZK\Platform())->get($this);
    }

    /**
     * Get firmware version
     *
     * @return bool|mixed
     */
    public function fmVersion()
    {
        return (new ZK\Platform())->getVersion($this);
    }

    /**
     * Get work code
     *
     * @return bool|mixed
     */
    public function workCode()
    {
        return (new ZK\WorkCode())->get($this);
    }

    /**
     * Get SSR
     *
     * @return bool|mixed
     */
    public function ssr()
    {
        return (new ZK\Ssr())->get($this);
    }

    /**
     * Get pin width
     *
     * @return bool|mixed
     */
    public function pinWidth()
    {
        return (new ZK\Pin())->width($this);
    }

    /**
     * @return bool|mixed
     */
    public function faceFunctionOn()
    {
        return (new ZK\Face())->on($this);
    }

    /**
     * Get device serial number
     *
     * @return bool|mixed
     */
    public function serialNumber()
    {
        return (new ZK\SerialNumber())->get($this);
    }

    /**
     * Get device name
     *
     * @return bool|mixed
     */
    public function deviceName()
    {
        return (new ZK\Device())->name($this);
    }

    /**
     * Disable device
     *
     * @return bool|mixed
     */
    public function disableDevice()
    {
        return (new ZK\Device())->disable($this);
    }

    /**
     * Enable device
     *
     * @return bool|mixed
     */
    public function enableDevice()
    {
        return (new ZK\Device())->enable($this);
    }

    /**
     * Get users data
     *
     * @return array [userid, name, cardno, uid, role, password]
     */
    public function getUser()
    {
        return (new ZK\User())->get($this);
    }

    /**
     * Set user data
     *
     * @param int $uid Unique ID (max 65535)
     * @param int|string $userid ID in DB (same like $uid, max length = 9, only numbers - depends device setting)
     * @param string $name (max length = 24)
     * @param int|string $password (max length = 8, only numbers - depends device setting)
     * @param int $role Default Util::LEVEL_USER
     * @param int $cardno Default 0 (max length = 10, only numbers)
     * @return bool|mixed
     */
    public function setUser($uid, $userid, $name, $password, $role = Util::LEVEL_USER, $cardno = 0)
    {
        return (new ZK\User())->set($this, $uid, $userid, $name, $password, $role, $cardno);
    }

    /**
     * Get fingerprint data array by UID
     * TODO: Can get data, but don't know how to parse the data. Need more documentation about it...
     *
     * @param integer $uid Unique ID (max 65535)
     * @return array Binary fingerprint data array (where key is finger ID (0-9))
     */
    public function getFingerprint($uid)
    {
        return (new ZK\Fingerprint())->get($this, $uid);
    }

    /**
     * Set fingerprint data array
     * TODO: Still can not set fingerprint. Need more documentation about it...
     *
     * @param integer $uid Unique ID (max 65535)
     * @param array $data Binary fingerprint data array (where key is finger ID (0-9) same like returned array from 'getFingerprint' method)
     * @return int Count of added fingerprints
     */
    public function setFingerprint($uid, array $data)
    {
        return (new ZK\Fingerprint())->set($this, $uid, $data);
    }

    /**
     * Remove fingerprint by UID and fingers ID array
     *
     * @param integer $uid Unique ID (max 65535)
     * @param array $data Fingers ID array (0-9)
     * @return int Count of deleted fingerprints
     */
    public function removeFingerprint($uid, array $data)
    {
        return (new ZK\Fingerprint())->remove($this, $uid, $data);
    }

    /**
     * Remove All users
     *
     * @return bool|mixed
     */
    public function clearUsers()
    {
        return (new ZK\User())->clear($this);
    }

    /**
     * Remove admin
     *
     * @return bool|mixed
     */
    public function clearAdmin()
    {
        return (new ZK\User())->clearAdmin($this);
    }

    /**
     * Remove user by UID
     *
     * @param integer $uid
     * @return bool|mixed
     */
    public function removeUser($uid)
    {
        return (new ZK\User())->remove($this, $uid);
    }

    /**
     * Get attendance log
     *
     * @return array [uid, id, state, timestamp]
     */
    public function getAttendance()
    {
        return (new ZK\Attendance())->get($this);
    }

    /**
     * Clear attendance log
     *
     * @return bool|mixed
     */
    public function clearAttendance()
    {
        return (new ZK\Attendance())->clear($this);
    }

    /**
     * Set device time
     *
     * @param string $t Format: "Y-m-d H:i:s"
     * @return bool|mixed
     */
    public function setTime($t)
    {
        return (new ZK\Time())->set($this, $t);
    }

    /**
     * Get device time
     *
     * @return bool|mixed Format: "Y-m-d H:i:s"
     */
    public function getTime()
    {
        return (new ZK\Time())->get($this);
    }
}