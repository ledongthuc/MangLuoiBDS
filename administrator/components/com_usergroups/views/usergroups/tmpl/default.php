<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php  JHTML::_('behavior.tooltip');  ?>

<?php
JToolBarHelper::title( JText::_( 'Usergroup Manager' ), 'user.png' );
JToolBarHelper::addNewX();
JToolBarHelper::deleteList();
JToolBarHelper::editListX();
?>

<?php
$usergroupsModelUsergroups = new UsergroupsModelUsergroups();

$usergroupData = $usergroupsModelUsergroups->getUsergroupData();

$usergroupTree = new JUsergroupTree($usergroupData);

$searchKeyWords = JRequest::getVar('search');
$filterKeyWords = JRequest::getVar('filter');
$filterWordList = array('<option value="all">Chọn nhóm</option>', '<option value="true">Nhóm quản trị</option>', '<option value="false">Nhóm người dùng</option>');
if ($filterKeyWords == 'all')
{
    $filterWordList[0] = '<option selected="all" value=""> Chọn nhóm </option>';
}
else
{
    if ($filterKeyWords == "true")
    {
        $filterWordList[1] = '<option selected="true" value="true">Nhóm quản trị</option>';
    }
    else if ($filterKeyWords == "false")
    {
        $filterWordList[2] = '<option selected="false" value="false">Nhóm người dùng</option>';
    }
}
$filter_order = JRequest::getVar('filter_order');
$filter_order_Dir = JRequest::getVar('filter_order_Dir');

$usergroupTreeData = $usergroupTree->getUsergroupTreeData($searchKeyWords, $filterKeyWords, $filter_order, $filter_order_Dir, true);
?>

<form action="index.php?option=com_usergroups" method="post" name="adminForm">
    <table>
        <tr>
            <td width="100%">
                <?php echo JText::_( 'Filter' ); ?>:
                <input  id="search" class="text_area" type="text" name="search" value="<?php if(!empty($searchKeyWords)) echo $searchKeyWords; ?>" onchange="document.adminForm.submit();" />
                <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
                <button onclick="document.getElementById('search').value = '';
                                 document.getElementById('filter').value = 'all';
                                 document.getElementsByName('filter_order')[0].value = '';
                                 document.getElementsByName('filter_order_Dir')[0].value = '';
                                 this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
            </td>
            <td nowrap="nowrap">
                <select id="filter" name="filter"
                        onchange="this.form.submit();">
                    <?php
                    foreach ($filterWordList as $filterWordListItem)
                    {
                        echo $filterWordListItem;
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <table class="adminlist" cellpadding="1">
        <thead>
        <tr>
            <th width="2%">
                <?php echo JText::_( 'NUM' ); ?>
            </th>
            <th width="3%">
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($usergroupTreeData); ?>);" />
            </th>
            <th class="title">
                <?php echo JHTML::_('grid.sort',   'Name', 'name', $filter_order_Dir, $filter_order ); ?>
            </th>
            <th class="title" width="7%">
                <?php echo JHTML::_('grid.sort',   'Chiết Khấu (%)', 'chietKhau', $filter_order_Dir, $filter_order ); ?>
            </th>
            </th>
            <th class="title" width="3%">
                <?php echo JHTML::_('grid.sort',   'Id', 'id', $filter_order_Dir, $filter_order ); ?>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        $k = 0;
        for ($i = 0; $i < count($usergroupTreeData); $i++)
        {
            $usergroupTreeDataItem = $usergroupTreeData[$i];

            if ($usergroupTreeDataItem['id'] == '21') //PUBLISHER
            {
                continue;
            }
        ?>
        <tr class="<?php echo "row$k"; ?>">
            <td align="center">
                <?php echo $i ;?>
            </td>
            <td align="center">
                <?php echo JHTML::_('grid.id', $i, $usergroupTreeDataItem['id'] ); ?>
            </td>
            <td style="padding-left: 41%;">
                <a href="<?php echo 'index.php?option=com_usergroups&view=usergroup&task=edit&cid[]='.$usergroupTreeDataItem['id']; ?>">
                    <?php echo $usergroupTreeDataItem['name']; ?>
                </a>
            </td>
            <td align="center">
                <?php echo $usergroupTreeDataItem['chietKhau']; ?>
            </td>
            <td align="center">
                <?php echo $usergroupTreeDataItem['id']; ?>
            </td>
        </tr>
        <?php
            $k = 1 - $k;
        }
        ?>
        </tbody>
    </table>
    <input type="hidden" name="option" value="com_usergroups" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="filter_order" value="<?php echo $filter_order; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $filter_order_Dir; ?>" />
    <?php echo JHTML::_('form.token'); ?>
</form>