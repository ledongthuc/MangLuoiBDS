<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model');

class UsergroupsModelUsergroups extends JModel
{
    public function getUsergroupData()
    {
        $db = JFactory::getDBO();

        $query = "SELECT *
                  FROM #__core_acl_aro_groups";
        $db->setQuery($query);

        $usergroupData = $db->loadAssocList();

        return $usergroupData;
    }

    public function getUsergroupName($id)
    {
        $db = JFactory::getDBO();

        $query = "SELECT name
                  FROM #__core_acl_aro_groups
                  WHERE id='$id'";
        $db->setQuery($query);

        $name = $db->loadResult();

        return $name;
    }

    public function getChietKhau($id)
    {
        $db = JFactory::getDBO();

        $query = "SELECT chietKhau
                  FROM #__core_acl_aro_groups
                  WHERE id='$id'";
        $db->setQuery($query);

        $chietKhau = $db->loadResult();

        return $chietKhau;
    }

    public function getChucDanh($id)
    {
        $db = JFactory::getDBO();

        $query = "SELECT chucDanh
                  FROM #__core_acl_aro_groups
                  WHERE id='$id'";
        $db->setQuery($query);

        $chucDanh = $db->loadResult();

        return $chucDanh;
    }

    public function getParentId($id)
    {
        $db = JFactory::getDBO();

        $query = "SELECT parent_id
                  FROM #__core_acl_aro_groups
                  WHERE id='$id'";
        $db->setQuery($query);

        $parentId = $db->loadResult();

        return $parentId;
    }

    public function getValidUsergroupData()
    {
        $db = JFactory::getDBO();

        $query = "SELECT *
                  FROM #__core_acl_aro_groups
                  WHERE chucDanh = '1'
                  ORDER BY lft";
        $db->setQuery($query);

        $danhSachIdHopLe = $db->loadAssocList();

        return $danhSachIdHopLe;
    }

    public function addUsergroup($usergroupDataItem)
    {
        $db = JFactory::getDBO();

        $id = $usergroupDataItem['id'];
        $parent_id = $usergroupDataItem['parent_id'];
        $name = $usergroupDataItem['name'];
        $lft = $usergroupDataItem['lft'];
        $rgt = $usergroupDataItem['rgt'];
        $value = $usergroupDataItem['value'];
        $chietKhau = $usergroupDataItem['chietKhau'];
        $chucDanh = $usergroupDataItem['chucDanh'];

        $query = "INSERT INTO #__core_acl_aro_groups(id, parent_id, name, lft, rgt, value, chietKhau, chucDanh)
                  VALUES ('$id', '$parent_id', '$name', '$lft', '$rgt', '$value', '$chietKhau', '$chucDanh')";
        $db->setQuery($query);

        $db->query();
    }

    public function removeUsergroup($id)
    {
        $db = JFactory::getDBO();

        $query = "DELETE
                  FROM #__core_acl_aro_groups
                  WHERE id='$id'";
        $db->setQuery($query);

        $db->query();
    }

    public function removeUsergroups($ids)
    {
        foreach ($ids as $id)
        {
            $this->removeUsergroup($id);
        }
    }

    public function updateUsergroup($usergroupDataItem)
    {
        $db = JFactory::getDBO();

        $id = $usergroupDataItem['id'];
        $parent_id = $usergroupDataItem['parent_id'];
        $name = $usergroupDataItem['name'];
        $lft = $usergroupDataItem['lft'];
        $rgt = $usergroupDataItem['rgt'];
        $value = $usergroupDataItem['value'];
        $chietKhau = $usergroupDataItem['chietKhau'];
        $chucDanh = $usergroupDataItem['chucDanh'];

        $query = "UPDATE #__core_acl_aro_groups
                  SET parent_id = '$parent_id', name = '$name',
                      lft = '$lft', rgt = '$rgt', value = '$value',
                      chietKhau = '$chietKhau', chucDanh = '$chucDanh'
                  WHERE id = '$id'";
        $db->setQuery($query);

        $db->query();
    }

    public function updateLftRgtData($lftRgtData)
    {
        $db = JFactory::getDBO();

        foreach ($lftRgtData as $lftRgtDataItem)
        {
            $id = $lftRgtDataItem['id'];
            $lft = $lftRgtDataItem['lft'];
            $rgt = $lftRgtDataItem['rgt'];

            $query = "UPDATE #__core_acl_aro_groups
                      SET lft='$lft', rgt='$rgt'
                      WHERE id='$id';";
            $db->setQuery($query);

            $db->query();
        }
    }
}
?>