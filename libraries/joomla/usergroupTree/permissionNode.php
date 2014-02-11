<?php
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class JPermissionNode
{
    private $_name;
    private $_value;
    private $_status; //allowed or denied
    private $_permissionStatus; //inherited, allowed or denied

    public function __construct($name, $value, $status, $permissionStatus)
    {
        $this->_name = $name;
        $this->_value = $value;
        $this->_status = $status;
        $this->_permissionStatus = $permissionStatus;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setValue($value)
    {
        $this->_value = $value;
    }

    public function getValue()
    {
        return $this->_value;
    }

    public function setName($name)
    {
        $this->_name = $name;
    }

    public function getStatus()
    {
        return $this->_status;
    }

    public function setStatus($status)
    {
        $this->_status = $status;
    }

    public function getPermissionStatus()
    {
        return $this->_permissionStatus;
    }

    public function setPermissionStatus($permissionStatus)
    {
        $this->_permissionStatus = $permissionStatus;
    }
}
?>