<?php
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class ConfigModelApplication extends JModel
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

    public function getRuleData()
    {
        $rules = array();

        $dom = new DOMDocument();
        $dom->load(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_config'.DS.'models'.DS.'forms'.DS.'application.xml');

        $root = $dom->documentElement;

        $ruleNodeList = $root->getElementsByTagName("rule");
        for ($i = 0; $i < $ruleNodeList->length; $i++)
        {
            $rules[$i]['name'] = $ruleNodeList->item($i)->getAttribute("name");
            $rules[$i]['value'] = $ruleNodeList->item($i)->getAttribute("value");
        }

        return $rules;
    }

    public function updatePermissions($data, $asset = null)
    {
        if ($asset == null)
        {
            $db = JFactory::getDBO();

            $query = "UPDATE #__assets
                      SET rules='".json_encode($data)."'
                      WHERE id='1'";
            $db->setQuery($query);

            $db->query();
        }
    }
}
?>