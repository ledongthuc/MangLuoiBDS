<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

require_once JPATH_COMPONENT.DS.'models'.DS.'usergroups.php';

class UsergroupsController extends JController
{
    function __construct($config = array())
    {
        parent::__construct($config);

        $this->registerTask('add', 'display');
        $this->registerTask('remove', 'remove');
        $this->registerTask('edit', 'display');
        $this->registerTask('save', 'save');
        $this->registerTask('apply', 'save');
        $this->registerTask('cancel', 'cancel');
    }

    function display()
    {
        switch ($this->getTask())
        {
            case 'add':
                JRequest::setVar('hidemainmenu', 1);
                JRequest::setVar('view', 'usergroup');
                JRequest::setVar('edit', false);
                break;
            case 'edit':
                JRequest::setVar('hidemainmenu', 1);
                JRequest::setVar('view', 'usergroup');
                JRequest::setVar('edit', true);
                break;
        }

        parent::display();
    }

    function remove()
    {
        $cid = JRequest::getVar('cid', array(), '', 'array');

        //BEGIN: cannot remove super administartor group
        foreach ($cid as $id)
        {
            if ($id == '24') // ADMINISTRATOR
            {
                $msg = 'Cannot remove Administrator group';
                $this->setRedirect('index.php?option=com_usergroups', $msg);

                return;
            }
            else if ($id == '25') // SUPER ADMINISTRATOR
            {
                $msg = 'Cannot remove Super Administrator group';
                $this->setRedirect('index.php?option=com_usergroups', $msg);

                return;
            }
            else if ($id == '31') // USERGROUP
            {
                $msg = 'Cannot remove User group';
                $this->setRedirect('index.php?option=com_usergroups', $msg);

                return;
            }
        }
        //END: cannot remove super administartor group

        //BEGIN: remove all checked usergroups
        $usergroupsModelUsergroups = new UsergroupsModelUsergroups();

        //BEGIN: update lft rgt on usergroup tree
        $usergroupData = $usergroupsModelUsergroups->getUsergroupData();

        $usergroupTree = new JUsergroupTree($usergroupData);

        $usergroupTree->removeUsergroupNodes($cid);
        $usergroupTree->getLftRgtData();

        $lftRgtData = $usergroupTree->getLftRgtData();

        $usergroupsModelUsergroups->updateLftRgtData($lftRgtData);
        //END: update lft rgt on usergroup tree

        $usergroupsModelUsergroups->removeUsergroups($cid);

        $msg = 'Removed successfully';
        $this->setRedirect('index.php?option=com_usergroups', $msg);
        //END: remove all checked usergroups
    }

    function save()
    {
        JRequest::checkToken() or jexit('Invalid Token');

        $id = JRequest::getVar('id');

        $usergroupsModelUsergroups = new UsergroupsModelUsergroups();
        $usergroupData = $usergroupsModelUsergroups->getUsergroupData();
        $usergroupTree = new JUsergroupTree($usergroupData);
        if (empty($id))
        {
            $usergroupNodeDataItem['parentId'] = 31; //User
            $usergroupNodeDataItem['name'] = JRequest::getVar('name');
            $usergroupNodeDataItem['value'] = JRequest::getVar('name');
            $usergroupNodeDataItem['chietKhau'] = JRequest::getVar('chietKhau');
            $usergroupNodeDataItem['chucDanh'] = 0;
            $newId = $usergroupTree->addUsergroupNode($usergroupNodeDataItem);

            $usergroupNode = $usergroupTree->getUsergroupNode($newId);
            $usergroupDataItem['id'] = $usergroupNode->getId();
            $usergroupDataItem['parent_id'] = $usergroupNode->getParentId();
            $usergroupDataItem['name'] = $usergroupNode->getName();
            $usergroupDataItem['lft'] = $usergroupNode->getLft();
            $usergroupDataItem['rgt'] = $usergroupNode->getRgt();
            $usergroupDataItem['value'] = $usergroupNode->getValue();
            $usergroupDataItem['chietKhau'] = $usergroupNode->getChietKhau();
            $usergroupDataItem['chucDanh'] = $usergroupNode->getChucDanh();

            $usergroupsModelUsergroups->addUsergroup($usergroupDataItem);

            $lftRgtData = $usergroupTree->getLftRgtData();

            $usergroupsModelUsergroups->updateLftRgtData($lftRgtData);
        }
        else
        {
            $usergroupNodeDataItem['id'] = $id;
            $usergroupNodeDataItem['parentId'] = JRequest::getVar('parentId');
            $usergroupNodeDataItem['name'] = JRequest::getVar('name');
            $usergroupNodeDataItem['value'] = JRequest::getVar('name');
            $usergroupNodeDataItem['chietKhau'] = JRequest::getVar('chietKhau');
            $usergroupNodeDataItem['chucDanh'] = 0;
            $usergroupTree->updateUsergroupNode($usergroupNodeDataItem);

            $usergroupNode = $usergroupTree->getUsergroupNode($id);
            $usergroupDataItem['id'] = $usergroupNode->getId();
            $usergroupDataItem['parent_id'] = $usergroupNode->getParentId();
            $usergroupDataItem['name'] = $usergroupNode->getName();
            $usergroupDataItem['lft'] = $usergroupNode->getLft();
            $usergroupDataItem['rgt'] = $usergroupNode->getRgt();
            $usergroupDataItem['value'] = $usergroupNode->getValue();
            $usergroupDataItem['chietKhau'] = $usergroupNode->getChietKhau();
            $usergroupDataItem['chucDanh'] = $usergroupNode->getChucDanh();

            $usergroupsModelUsergroups->updateUsergroup($usergroupDataItem);

            $lftRgtData = $usergroupTree->getLftRgtData();

            $usergroupsModelUsergroups->updateLftRgtData($lftRgtData);
        }

        if ($this->getTask() == 'save')
        {
            $msg = 'Successfully Saved Group';
            $this->setRedirect('index.php?option=com_usergroups', $msg);
        }
        else if ($this->getTask() == 'apply')
        {
            if (empty($usergroupData['id']))
            {
                $msg = 'Successfully Saved Group';
                $this->setRedirect('index.php?option=com_usergroups', $msg);

                return;
            }

            $msg = 'Successfully Saved changes to Group';
            $this->setRedirect('index.php?option=com_usergroups&view=usergroup&task=edit&cid[]='.$id, $msg);
        }
    }

    function cancel()
    {
        $this->setRedirect('index.php?option=com_usergroups');
    }
}