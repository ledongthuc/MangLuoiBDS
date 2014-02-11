<link href="components/com_config/assets/css/style.css" rel="stylesheet" type="text/css" />

<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<fieldset class="adminform">
    <legend><?php echo JText::_( 'Permissions' ); ?></legend>
    <?php
    $configModelAplication = new ConfigModelApplication();

    $usergroupData = $configModelAplication->getUsergroupData();
    $ruleData = $configModelAplication->getRuleData();

    $usergroupTree = new JUsergroupTree($usergroupData, $ruleData);
    $usergroupTreeData = $usergroupTree->getUsergroupTreeData('', 'true');
    unset($usergroupTreeData[0]);
    unset($usergroupTreeData[1]);
    $html = '';
    $html = $html.'<div id="accordion">';
    foreach ($usergroupTreeData as $usergroupTreeDataItem)
    {
        $branch = '';
        /*
        for ($i = 0;  $i < $usergroupTreeDataItem['level']; $i++)
        {
            $branch = $branch.'|- ';
        }
        */
        $html = $html.
            '<h2>'.$branch.$usergroupTreeDataItem['name'].'</h2>'.
            '<div class="content">'.
            '<table>'.
            '<th width="750px">Action</th><th width="300px">Select New Setting</th><th width="200px">Calculated Setting</th>';
        foreach ($usergroupTreeDataItem['permissions'] as $permission)
        {
            $html = $html.
                '<tr>'.
                '<td>'.$permission['value'].'</td>'.
                '<td>'.
                '<select name="comboBox_'.$usergroupTreeDataItem['id'].'_'.$permission['name'].'">';
            if ($permission['permissionStatus'] == 'inherited')
            {
                $html = $html.
                    '<option>allowed</option>'.
                    '<option selected=1>denied</option>';
            }
            else if ($permission['permissionStatus'] == 'allowed')
            {
                $html = $html.
                    '<option selected=1>allowed</option>'.
                    '<option>denied</option>';
            }
            else if ($permission['permissionStatus'] == 'denied')
            {
                $html = $html.
                    '<option>allowed</option>'.
                    '<option selected=1>denied</option>';
            }
            if ($permission['status'] == 'allowed')
            {
                $html = $html.
                    '</select>'.
                    '</td>'.
                    '<td>'.'<img src="components/com_config/assets/images/icon-16-allow.png" />'.' '.$permission['status'].'</td>'.
                    '</tr>';
            }
            else if ($permission['status'] == 'denied')
            {
                $html = $html.
                    '</select>'.
                    '</td>'.
                    '<td>'.'<img src="components/com_config/assets/images/icon-16-deny.png" />'.' '.$permission['status'].'</td>'.
                    '</tr>';
            }
        }
        $html = $html.
            '</table>'.
            '</div>';
    }
    $html = $html.'</div>';

    echo $html;
    ?>
</fieldset>

<script type="text/javascript">
    window.addEvent('domready', function(){
        new Fx.Accordion($('accordion'), '#accordion h2', '#accordion .content');
    });
</script>