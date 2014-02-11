<?php
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once JPATH_LIBRARIES.DS.'joomla'.DS.'access'.DS.'rules.php';

class JAccess
{
    protected static $_assetRules = array();
    protected static $_groupsByUser = array();
    protected static $_userGroups = array();
    protected static $_userGroupPaths = array();

    public static function checkUser($userId, $action, $asset = null)
    {
        $userId = (int)$userId;

        if ($userId == 0)
        {
            return JAccess::checkGroup(0, $action, $asset);
        }

        $action = strtolower(trim($action));
        $asset = strtolower(trim($asset));

        if (empty($asset))
        {
            $asset = 1;
        }

        if (empty(JAccess::$_assetRules[$asset]))
        {
            JAccess::$_assetRules[$asset] = JAccess::getAssetRules($asset);
        }

        $identities = JAccess::getGroupByUsers($userId);
        array_unshift($identities, $userId * -1);

        return JAccess::$_assetRules[$asset]->allow($action, $identities);
    }

    public static function checkGroup($groupId, $action, $asset = null)
    {
        $groupId = (int)$groupId;

        if ($groupId == 0)
        {
            $groupId = 17; //ROOT
        }

        $action = strtolower($action);
        $asset = strtolower($asset);

        if (empty($asset))
        {
            $asset = 1;
        }

        if (empty(JAccess::$_assetRules[$asset]))
        {
            JAccess::$_assetRules[$asset] = JAccess::getAssetRules($asset);
        }

        $groupPath = JAccess::getGroupPath($groupId);

        return JAccess::$_assetRules[$asset]->allow($action, $groupPath);
    }

    public static function getPermissionStatusOnGroup($groupId, $action)
    {
        $db = JFactory::getDBO();

        $query = "SELECT rules
                  FROM #__assets
                  WHERE  id='1'";
        $db->setQuery($query);

        $result = $db->loadResult();

        $permissions = json_decode($result);

        $status = 'inherited';
        foreach ($permissions as $rule => $groupStates)
        {
            if ($rule == $action)
            {
                foreach ($groupStates as $group => $checked)
                {
                    if ($groupId == $group)
                    {
                        if ($checked == 0)
                        {
                            $status = 'denied';
                        }
                        else
                        {
                            $status = 'allowed';
                        }
                    }
                }
            }
        }

        return $status;
    }

    private static function getAssetRules($asset)
    {
        $db = JFactory::getDBO();

        if (is_numeric($asset))
        {
            $query = "SELECT b.rules
                      FROM #__assets AS a LEFT JOIN #__assets AS b ON b.lft <= a.lft AND b.rgt >= a.rgt
                      WHERE (a.id = '$asset' OR a.parent_id=0) GROUP BY b.id, b.rules, b.lft ORDER BY b.lft";
        }
        else
        {
            $query = "SELECT b.rules
                      FROM #__assets AS a LEFT JOIN #__assets AS b ON b.lft <= a.lft AND b.rgt >= a.rgt
                      WHERE (a.name = '$asset' OR a.parent_id=0) GROUP BY b.id, b.rules, b.lft ORDER BY b.lft";
        }
        $db->setQuery($query);

        $result = $db->loadResultArray();

        if (empty($result))
        {
            $query = "SELECT rules
                      FROM #__assets
                      WHERE parent_id=0";
            $db->setQuery($query);
            $result = $db->loadResultArray();
        }

        $rules = new JAccessRules();
        $rules->mergeCollection($result);

        return $rules;
    }

    private static function getGroupByUsers($userId)
    {
        $storeId = $userId.':'.true;

        if (!isset(JAccess::$_groupsByUser[$storeId]))
        {
            //BEGIN: get groupId
            $db = JFactory::getDBO();

            $firstQuery = "SELECT gid FROM #__users WHERE id='$userId'";
            $db->setQuery($firstQuery);

            $groupId = $db->loadResult();
            //END get groupId

            //BEGIN: get groupId list
            $secondQuery = "SELECT b.id
                            FROM #__core_acl_aro_groups AS a LEFT JOIN #__core_acl_aro_groups AS b ON b.lft <= a.lft AND b.rgt >= a.rgt
                            WHERE a.id = '$groupId'";
            $db->setQuery($secondQuery);

            $result = $db->loadResultArray();
            //END: get groupId list

            JAccess::$_groupsByUser[$storeId] = $result;
        }

        return JAccess::$_groupsByUser[$storeId];
    }

    private static function getGroupPath($groupId)
    {
        if (empty(JAccess::$_userGroups))
        {
            $db = JFactory::getDBO();

            $query = "SELECT parent.id, parent.lft, parent.rgt
                      FROM #__core_acl_aro_groups AS parent ORDER BY parent.lft";
            $db->setQuery($query);

            JAccess::$_userGroups = $db->loadObjectList('id');
        }

        if (!array_key_exists($groupId, JAccess::$_userGroups))
        {
            return array();
        }

        if (!isset(JAccess::$_userGroupPaths[$groupId]))
        {
            JAccess::$_userGroupPaths[$groupId] = array();

            foreach (JAccess::$_userGroups as $group)
            {
                if ($group->lft <= JAccess::$_userGroups[$groupId]->lft && $group->rgt >= JAccess::$_userGroups[$groupId]->rgt)
                {
                    JAccess::$_userGroupPaths[$groupId][] = $group->id;
                }
            }
        }

        return JAccess::$_userGroupPaths[$groupId];
    }
}
?>