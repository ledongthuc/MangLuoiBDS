<?php
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once JPATH_LIBRARIES . DS . 'joomla' . DS . 'usergroupTree' . DS . 'usergroupNode.php';

class JUsergroupTree
{
    private $_usergroupNodes = array();

    public function __construct($usergroupData, $ruleData = null)
    {
        foreach ($usergroupData as $usergroupDataItem)
        {
            $id = $usergroupDataItem['id'];
            //parent_id will be calculated after
            $name = $usergroupDataItem['name'];
            $lft = $usergroupDataItem['lft'];
            $rgt = $usergroupDataItem['rgt'];
            $value = $usergroupDataItem['value'];
            $chietKhau = $usergroupDataItem['chietKhau'];
            $chucDanh = $usergroupDataItem['chucDanh'];
            //level will be calculated after
            //isLeaft will be calculated after
            $usergroupNode = new JUsergroupNode($id, $name, $lft, $rgt, $value, $chietKhau, $chucDanh, $ruleData);

            $this->_usergroupNodes[] = $usergroupNode;
        }

        $this->buildTree();
    }	

    private function buildTree()
    {
        $nNumberOfNodes = $this->getNumberOfNodes();

        for ($i = 0; $i < $nNumberOfNodes - 1; $i++)
        {
            for ($j = $i + 1; $j < $nNumberOfNodes; $j++)
            {
                if ($this->_usergroupNodes[$i]->getLft() > $this->_usergroupNodes[$j]->getLft())
                {
                    $temp = $this->_usergroupNodes[$i];
                    $this->_usergroupNodes[$i] = $this->_usergroupNodes[$j];
                    $this->_usergroupNodes[$j] = $temp;
                }
            }
        }

        $parentId = 0;
        $level = 0;
        for ($i = 0; $i < $nNumberOfNodes; $i++)
        {
            $currLft = $this->_usergroupNodes[$i]->getLft();
            $currRgt = $this->_usergroupNodes[$i]->getRgt();

            if ($i > 0)
            {
                $prevLft = $this->_usergroupNodes[$i - 1]->getLft();
                $prevRgt = $this->_usergroupNodes[$i - 1]->getRgt();

                if ($currLft > $prevLft && $currRgt < $prevRgt)
                {
                    $parentId = $this->_usergroupNodes[$i - 1]->getId();
                    $level++;
                }
                else
                {
                    for ($j = $i - 1; $j >= 0; $j--)
                    {
                        if ($j == 0)
                        {
                            $level = 0;
                        }

                        $prevLft = $this->_usergroupNodes[$j]->getLft();
                        $prevRgt = $this->_usergroupNodes[$j]->getRgt();
                        if ($currLft > $prevLft && $currRgt < $prevRgt)
                        {
                            $level = $this->_usergroupNodes[$j]->getLevel() + 1;
                            break;
                        }
                    }
                }
            }

            $this->_usergroupNodes[$i]->setParentId($parentId);
            $this->_usergroupNodes[$i]->setLevel($level);
        }

        for ($i = 0; $i < $this->getNumberOfNodes() - 1; $i++)
        {
            $isLeaf = true;

            if ($this->_usergroupNodes[$i + 1]->getLevel() > $this->_usergroupNodes[$i]->getLevel())
            {
                $isLeaf = false;
            }

            $this->_usergroupNodes[$i]->setIsLeaf($isLeaf);
        }
        $this->_usergroupNodes[$this->getNumberOfNodes() - 1]->setIsLeaf(true);
    }

    public function getUsergroupTreeData($searchKeyWords = '', $filterKeyWords = 'all', $filterOrder = '', $filterOrderDir = '', $getOnlyLeaf = false)
    {
        $usergroupTreeData = array();

        $j = 0;
        for ($i = 0; $i < $this->getNumberOfNodes(); $i++)
        {
            $usergroupNode = $this->_usergroupNodes[$i];

            if (!empty($searchKeyWords))
            {
                if (!is_numeric(strpos(strtolower($usergroupNode->getName()), strtolower($searchKeyWords))))
                    continue;
            }

            if ($filterKeyWords != 'all')
            {
                if ($filterKeyWords == "true")
                {
                    if (!$usergroupNode->getChucDanh())
                        continue;
                }
                else if ($filterKeyWords == "false")
                {
                    if ($usergroupNode->getChucDanh())
                        continue;
                }
            }

            if ($getOnlyLeaf)
            {
                if (!$usergroupNode->getIsLeaf())
                    continue;
            }

            $usergroupTreeData[$j]['id'] = $usergroupNode->getId();
            $usergroupTreeData[$j]['name'] = $usergroupNode->getName();
            $usergroupTreeData[$j]['chietKhau'] = $usergroupNode->getChietKhau();
            $usergroupTreeData[$j]['permissions'] = $usergroupNode->getPermissionNodeData();
            $usergroupTreeData[$j]['level'] = $usergroupNode->getLevel();
            $j++;
        }

        if ($filterOrder != '' || $filterOrderDir != '')
        {
            if (!in_array($filterOrder, array('id', 'name', 'chietKhau', 'level')))
            {
                $filterOrder = '';
            }

            if (!in_array($filterOrderDir, array('asc', 'desc')))
            {
                $filterOrderDir = '';
            }
        }

        if ($filterOrder != '' && $filterOrderDir != '')
        {
            for ($i = 0; $i < count($usergroupTreeData) - 1; $i++)
            {
                for ($j = $i + 1; $j < count($usergroupTreeData); $j++)
                {
                    $res = strcmp($usergroupTreeData[$i][$filterOrder], $usergroupTreeData[$j][$filterOrder]);

                    if (($res > 0 && $filterOrderDir == 'asc') || ($res < 0 && $filterOrderDir == 'desc'))
                    {
                        $temp = $usergroupTreeData[$i];
                        $usergroupTreeData[$i] = $usergroupTreeData[$j];
                        $usergroupTreeData[$j] = $temp;
                    }
                }
            }
        }

        return $usergroupTreeData;
    }

    public function getNumberOfNodes()
    {
        return count($this->_usergroupNodes);
    }

    public function getUsergroupNodeIndex($id)
    {
        foreach ($this->_usergroupNodes as $index => $usergroupNode)
        {
            if ($id == $usergroupNode->getId())
            {
                return $index;
            }
        }

        return -1;
    }

    public function getUsergroupNode($id)
    {
        $usergroupNodeIndex = $this->getUsergroupNodeIndex($id);

        if ($usergroupNodeIndex >= 0)
        {
            return $this->_usergroupNodes[$usergroupNodeIndex];
        }

        return null;
    }

    public function getParentNode($id)
    {
        //NOTE: the tree must be built before
        $childUsergroupNodeIndex = $this->getUsergroupNodeIndex($id);

        if ($childUsergroupNodeIndex > 0)
        {
            $childLft = $this->_usergroupNodes[$childUsergroupNodeIndex]->getLft();
            $childRgt = $this->_usergroupNodes[$childUsergroupNodeIndex]->getRgt();
            for ($i = $childUsergroupNodeIndex; $i >= 0; $i--)
            {
                $lft = $this->_usergroupNodes[$i]->getLft();
                $rgt = $this->_usergroupNodes[$i]->getRgt();

                if ($lft < $childLft && $rgt > $childRgt)
                {
                    return $this->_usergroupNodes[$i];
                }
            }
        }

        return null;
    }

    public function getUsergroupNodesInBranch($id)
    {
        //NOTE: the tree must be built before
        $usergroupNodesInBranch = array();

        $rootUsergroupNode = $this->getUsergroupNode($id);
        if ($rootUsergroupNode != null)
        {
            $selectedUsergroupNodeLftIndex = $rootUsergroupNode->getLft();
            $selectedUsergroupNodeRgtIndex = $rootUsergroupNode->getRgt();

            foreach ($this->_usergroupNodes as $usergroupNode)
            {
                $lft = $usergroupNode->getLft();
                $rgt = $usergroupNode->getRgt();

                if ($selectedUsergroupNodeLftIndex < $lft && $selectedUsergroupNodeRgtIndex > $rgt)
                {
                    $usergroupNodesInBranch[] = $usergroupNode;
                }
            }

            $usergroupNodesInBranch[] = $rootUsergroupNode;
        }

        return $usergroupNodesInBranch;
    }

    private function getMaxGroupId()
    {
        $maxId = 0;

        foreach ($this->_usergroupNodes as $usergroupNode)
        {
            $id = $usergroupNode->getId();

            if ($id > $maxId)
            {
                $maxId = $id;
            }
        }

        return $maxId;
    }

    private function createNewGroupId()
    {
        return $this->getMaxGroupId() + 1;
    }

    private function getTraversalPath()
    {
        $path = array(2 * $this->getNumberOfNodes());
        $capacity = array(2 * $this->getNumberOfNodes());

        for ($i = 0; $i < $this->getNumberOfNodes(); $i++)
        {
            $path[2 * $i] = $i;
            $path[2 * $i + 1] = $i;
            $capacity[2 * $i] = $this->_usergroupNodes[$i]->getLft();
            $capacity[2 * $i + 1] = $this->_usergroupNodes[$i]->getRgt();
        }

        for ($i = 0; $i < count($path) - 1; $i++)
        {
            for ($j = $i + 1; $j < count($path); $j++)
            {
                if ($capacity[$i] > $capacity[$j])
                {
                    $cTemp = $capacity[$i];
                    $capacity[$i] = $capacity[$j];
                    $capacity[$j] = $cTemp;

                    $pTemp = $path[$i];
                    $path[$i] = $path[$j];
                    $path[$j] = $pTemp;
                }
            }
        }

        return $path;
    }

    private function updateLftRgt($usergroupNode, $offset)
    {
        if ($usergroupNode == null)
            return;

        $traservalPath = $this->getTraversalPath();
        for ($i = count($traservalPath) - 1; $i >= 0; $i--)
        {
            if ($usergroupNode->getId() == $this->_usergroupNodes[$traservalPath[$i]]->getId())
            {
                for ($j = $i; $j < count($traservalPath); $j++)
                {
                    echo $this->_usergroupNodes[$traservalPath[$j]]->getName().' ';

                    $currNodeIndex = $traservalPath[$j];
                    $currLft = $this->_usergroupNodes[$currNodeIndex]->getLft();
                    $currRgt = $this->_usergroupNodes[$currNodeIndex]->getRgt();
                    $currLevel = $this->_usergroupNodes[$currNodeIndex]->getLevel();

                    $prevNodeIndex = $traservalPath[$j - 1];
                    $prevLevel = $this->_usergroupNodes[$prevNodeIndex]->getLevel();

                    if ($currLevel > $prevLevel)
                    {
                        $currLft += $offset;
                    }
                    else if ($currLevel == $prevLevel)
                    {
                        if ($this->_usergroupNodes[$currNodeIndex] == $this->_usergroupNodes[$prevNodeIndex])
                        {
                            $currRgt += $offset;
                        }
                        else if ($this->_usergroupNodes[$currNodeIndex] != $this->_usergroupNodes[$prevNodeIndex])
                        {
                            $currLft += $offset;
                        }
                    }
                    else if ($currLevel < $prevLevel)
                    {
                        $currRgt += $offset;
                    }

                    $this->_usergroupNodes[$currNodeIndex]->setLft($currLft);
                    $this->_usergroupNodes[$currNodeIndex]->setRgt($currRgt);
                }

                break;
            }
        }
    }

    public function addUsergroupNode($usergroupNodeDataItem)
    {
        //BEGIN: find where we will add new node
        $parentId = $usergroupNodeDataItem['parentId'];
        $parentNode = $this->getUsergroupNode($parentId);
        //END: find where we will add new node

        $this->updateLftRgt($parentNode, 2); /* update lft rgt values */

        //BEGIN: add new usergroup node and rebuild the tree
        $id = $this->createNewGroupId();
        $name = $usergroupNodeDataItem['name'];
        $lft = $parentNode->getRgt() - 2;
        $rgt = $lft + 1;
        $value = $usergroupNodeDataItem['value'];
        $chietKhau = $usergroupNodeDataItem['chietKhau'];
        $chucDanh = $usergroupNodeDataItem['chucDanh'];

        $newUsergroupNode = new JUsergroupNode($id, $name, $lft, $rgt, $value, $chietKhau, $chucDanh);
        $this->_usergroupNodes[$this->getNumberOfNodes()] = $newUsergroupNode;
        $this->buildTree();
        //END: add new usergroup node and rebuild the tree

        return $id;
    }

    public function removeUsergroupNode($id)
    {
        $usergroupNodeInRemovedBranch = $this->getUsergroupNodesInBranch($id);

        if (count($usergroupNodeInRemovedBranch) == 0)
            return;

        $this->updateLftRgt($this->getUsergroupNode($id), count($usergroupNodeInRemovedBranch) * (-2));

        //BEGIN: remove branch and rebuild the tree
        foreach ($usergroupNodeInRemovedBranch as $removedUsergroupNode)
        {
            $removedUsergroupNodeIndex = $this->getUsergroupNodeIndex($removedUsergroupNode->getId());

            $this->_usergroupNodes[$removedUsergroupNodeIndex] = $this->_usergroupNodes[$this->getNumberOfNodes() - 1];
            unset($this->_usergroupNodes[$this->getNumberOfNodes() - 1]);
        }

        $this->buildTree();
        //END: remove branch and rebuild the tree
    }

    public function removeUsergroupNodes($ids)
    {
        foreach ($ids as $id)
        {
            $this->removeUsergroupNode($id);
        }
    }

    public function isAncestor($idOne, $idTwo)
    {
        if ($this->getUsergroupNodeIndex($idOne) == -1)
        {
            return false;
        }

        if ($this->getUsergroupNodeIndex($idTwo) == -1)
        {
            return false;
        }

        $lftOne = $this->getUsergroupNode($idOne)->getLft();
        $rgtOne = $this->getUsergroupNode($idOne)->getRgt();
        $lftTwo = $this->getUsergroupNode($idTwo)->getLft();
        $rgtTwo = $this->getUsergroupNode($idTwo)->getRgt();

        if ($lftOne < $lftTwo and $rgtOne > $rgtTwo)
        {
            return true;
        }

        return false;
    }

    public function updateUsergroupNode($usergroupNodeDataItem)
    {
        $id = $usergroupNodeDataItem['id'];

        $newParentId = $usergroupNodeDataItem['parentId'];
        $newName = $usergroupNodeDataItem['name'];
        $newValue = $usergroupNodeDataItem['value'];
        $newChietKhau = $usergroupNodeDataItem['chietKhau'];
        $newChucDanh = $usergroupNodeDataItem['chucDanh'];

        $updatedUsergroupNode = $this->getUsergroupNode($id);

        if ($updatedUsergroupNode == null)
        {
            return;
        }

        //parent Id is updated after
        $updatedUsergroupNode->setName($newName);
        $updatedUsergroupNode->setValue($newValue);
        $updatedUsergroupNode->setChietKhau($newChietKhau);
        $updatedUsergroupNode->setChucDanh($newChucDanh);
    }

    public function getLftRgtData()
    {
        $lftRgtData = array();

        for ($i = 0; $i < $this->getNumberOfNodes(); $i++)
        {
            $lftRgtData[$i]['id'] = $this->_usergroupNodes[$i]->getId();
            $lftRgtData[$i]['lft'] = $this->_usergroupNodes[$i]->getLft();
            $lftRgtData[$i]['rgt'] = $this->_usergroupNodes[$i]->getRgt();
        }

        return $lftRgtData;
    }
}
?>