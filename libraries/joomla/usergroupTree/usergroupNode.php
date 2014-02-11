<?php
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once JPATH_LIBRARIES.DS.'joomla'.DS.'usergroupTree'.DS.'permissionNode.php';

class JUsergroupNode
{
    private $_id;
    private $_parentId; /* is calculated after construct */
    private $_name;
    private $_lft;
    private $_rgt;
    private $_value;
    private $_chietKhau;
    private $_chucDanh;
    private $_level; /* is calculated after construct */
    private $_isLeaf; /* is calculated after construct */
    private $_permissionNodes = array();

    public function __construct($id, $name, $lft, $rgt, $value, $chietKhau, $chucDanh, $ruleData = null)
    {
        $this->_id = $id;
        $this->_name = $name;
        $this->_lft = $lft;
        $this->_rgt = $rgt;
        $this->_value = $value;
        $this->_chietKhau = $chietKhau;
        $this->_chucDanh = $chucDanh;

        if (!empty($ruleData))
        {
            foreach ($ruleData as $ruleDataItem)
            {
                $name = $ruleDataItem['name'];
                $value = $ruleDataItem['value'];
                $permissionStatus = JAccess::getPermissionStatusOnGroup($id, $name);
                if ($permissionStatus == 'inherited')
                {
                    if (JAccess::checkGroup($id, $name))
                    {
                        $status = 'allowed';
                    }
                    else
                    {
                        $status = 'denied';
                    }
                }
                else
                {
                    $status = $permissionStatus;
                }
                $permissionNode = new JPermissionNode($name, $value, $status, $permissionStatus);

                $this->_permissionNodes[] = $permissionNode;
            }
        }
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function setParentId($parentId)
    {
        $this->_parentId = $parentId;
    }

    public function getParentId()
    {
        return $this->_parentId;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setName($name)
    {
        $this->_name = $name;
    }

    public function getLft()
    {
        return $this->_lft;
    }

    public function setLft($lft)
    {
        $this->_lft = $lft;
    }

    public function getRgt()
    {
        return $this->_rgt;
    }

    public function setRgt($rgt)
    {
        $this->_rgt = $rgt;
    }

    public function getValue()
    {
        return $this->_value;
    }

    public function setValue($value)
    {
        $this->_value = $value;
    }

    public function getChietKhau()
    {
        return $this->_chietKhau;
    }

    public function setChietKhau($chietKhau)
    {
        $this->_chietKhau = $chietKhau;
    }

    public function getLevel()
    {
        return $this->_level;
    }

    public function setLevel($level)
    {
        $this->_level = $level;
    }

    public function getChucDanh()
    {
        return $this->_chucDanh;
    }

    public function setChucDanh($chucDanh)
    {
        $this->_chucDanh = $chucDanh;
    }

    public function getIsLeaf()
    {
        return $this->_isLeaf;
    }

    public function setIsLeaf($isLeaf)
    {
        $this->_isLeaf = $isLeaf;
    }

    public function getPermissionNodeData()
    {
        $data = array();

        for ($i = 0; $i < count($this->_permissionNodes); $i++)
        {
            $permissionNode = $this->_permissionNodes[$i];

            $data[$i]['name'] = $permissionNode->getName();
            $data[$i]['value'] = $permissionNode->getValue();
            $data[$i]['status'] = $permissionNode->getStatus();
            $data[$i]['permissionStatus'] = $permissionNode->getPermissionStatus();
        }

        return $data;
    }

    public function setPermissionNodeData($data)
    {
        for ($i = 0; $i < count($this->_permissionNodes); $i++)
        {
            $permissionNode = $this->_permissionNodes[$i];

            $permissionNode->setName($data[$i]['name']);
            $permissionNode->setValue($data[$i]['value']);
            $permissionNode->setStatus($data[$i]['status']);
            $permissionNode->setPermissionStatus($data[$i]['permissionStatus']);
        }
    }
}
?>