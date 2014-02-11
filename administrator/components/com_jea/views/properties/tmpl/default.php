<?php

//    print_r($this->rows);


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::stylesheet('jea.admin.css', 'media/com_jea/css/');
//$rowsCount = count( $this->rows ) ;
$altrow = 1;
include_once('libraries/js/ham-tien-ich-php.php');
include_once('../includes/ham_tien_ich.php');
include_once ('../libraries/unisonlib/com_jea_lib.php');
$user		= & JFactory::getUser();
$userapproved = $user->get('approved');
?>


<form action="index.php?option=com_jea&controller=properties&cat=<?php echo $this->cat ?>" method="post" name="adminForm" id="adminForm">
<script type="text/javascript" src="<?php JURI::base()?>components/com_jea/views/properties/tmpl/js/jquery.js"></script>
<script type="text/javascript" src="<?php JURI::base()?>components/com_jea/views/properties/tmpl/js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="<?php JURI::base()?>components/com_jea/views/properties/tmpl/css/jquery.lightbox-0.5.css" media="screen" />
<script>
jQuery.noConflict();
jQuery(function() {
		for(var i=0;i<20;i++){
			jQuery("#gallery"+i+" a").lightBox();
		}
    });
</script>

<table class="adminheading">
	<tr>
		<td width="100%">
			<label for="search" ><?php echo JText::_('TIM_TIEU_DE')." hoặc mã số tin" ?></label> :
			<input type="text" id="search" name="search" size="60" value="<?php echo $this->search ?>" />
			<input type="submit" value="<?php echo JText::_('TIM');?>" />
		</td>
		<td nowrap="nowrap">
			<?php echo JText::_('Filter') ?> :
			<?php echo  $this->loai_bds ?>
			<?php echo  $this->towns ?>
			<?php echo  $this->areas ?>
            <select name="published" onchange="document.adminForm.submit();">
            	<option value="-1" <?php echo ($this->published)?'selected="selected"':''?>>- Chọn trạng thái -</option>
            	<option value="1" <?php echo ($this->published==1)?'selected="selected"':''?>>Đã được bật</option>
                <option value="0" <?php echo ($this->published==0)?'selected="selected"':''?>>Đã được tắt</option>
            </select>
            <select name="emphasis" onchange="document.adminForm.submit();">
            	<option value="-1">- Nổi bật -</option>
            	<option value="1" <?php echo ($this->emphasis==1)?'selected="selected"':''?>>Có</option>
                <option value="0" <?php echo ($this->emphasis==0)?'selected="selected"':''?>>Không</option>
            </select>
             <select name="spam" onchange="document.adminForm.submit();">
            	<option value="-1">Báo cáo sai phạm</option>
            	<option value="1" <?php echo ($this->spam==1)?'selected="selected"':''?>>Có</option>
                <option value="0" <?php echo ($this->spam==0)?'selected="selected"':''?>>Không</option>
            </select>
            <?php //echo $this->getListUser($this->created_by)?>
            <span id="view_area_dangtin"></span>

		</td>
	</tr>
</table>

<table class="adminlist">
	<thead>
		<tr>
        <th>#</th>
        <th>Mã tin</th>
			<th style="text-align:left"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $this->tongDong ?>);" /></th>
			
			<th nowrap="nowrap" width="350px">
				<?php echo JText::_('Reference') ?>
			</th>
			
			<th nowrap="nowrap"><?php echo JText::_('MO_TA') ?></th>
			<th nowrap="nowrap">Hình Ảnh</th>
			<td style="display: none"><?php echo $row['tinh_thanh'] ?></td>
			<td style="display: none"><?php echo $row['quan_huyen']?></td>
		<?php 	/*
			<th nowrap="nowrap">
				<?php echo JText::_('PRICE') ?>
			</th>
			
			<th nowrap="nowrap">
				<?php echo JText::_('EMPHASIS') ?>
			</th>
			
			<th nowrap="nowrap">
			<?php echo JText::_('NEWSEST') ?>
			</th>
			*/?>
			
			<th nowrap="nowrap">
					<?php echo JText::_('PUBLISHED') ?>
			</th>
			<!-- 
			<th nowrap="nowrap">
					<?php echo JText::_('DA_BAN') ?>
			</th>
			 -->
			<th nowrap="nowrap">
				<?php echo JText::_('CREATE_BY') ?>
            </th>
            
            <th nowrap="nowrap">
				<?php echo JText::_('Chính chủ') ?>
            </th>
            <th nowrap="nowrap">
				<?php echo JText::_('Speak English') ?>
            </th>
            
			<th nowrap="nowrap">
				<?php echo JText::_('DATE_CREATE') ?>
			</th>
			<?php /*?>
			 <th nowrap="nowrap"  colspan="4" >
	        	<?php echo JText::_( 'ORDERING' ); ?>
	        </th>
			
			<th nowrap="nowrap"  colspan="2">
				<?php echo JText::_('LUOT_XEM') ?>
			</th>
			
            <th><?php echo JText::_('ID') ?></th>*/ ?>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<td colspan="11">
				<del class="container">
					<div class="pagination">
						<div class="limit">
						<?php echo $this->pagination->getPagesLinks()?>
							<?php //echo JText::_('Items per page')?> 
							<?php //echo $this->pagination->getLimitBox() ?>
						</div>
						<?php //echo $this->pagination->getPagesLinks() ?>
						<div class="limit"><?php //echo $this->pagination->getPagesCounter() ?></div>
					</div>
				</del>
			</td>
		</tr>
	</tfoot>

	<tbody>
	<?php if(!empty($this->rows)){?>
	<?php foreach ($this->rows as $k => $row) :?>

	<?php $altrow = ( $altrow == 1 )? 0 : 1;
		
	
	?>

		<tr class="row<?php echo $altrow ?>">
			<td><?=$k+1?></td>
			<td> <?php echo $this->rows[$k]['id']; ?></td>
			<td><?php echo JHTML::_('grid.id', $k, $row['id'] ) ?></td>
			
			<td>
			<?php if ($this->is_checkout($row['id'])) : ?>
			<?php echo $row['tieu_de'] //name ?>
			<?php else : ?>
				<a href="#edit" onclick="return listItemTask('cb<?php echo $k ?>','edit')">
				<?php echo $row['tieu_de'] //short_description ?></a><span>
			<?php endif ?>
			</td>
			
			<td class="font11"><?php echo strip_tags(getShortDescription($row['mo_ta_chi_tiet'],150))  ?></td>
			<?php /*?><td class="font11"><img src="../images/property/<?php echo $row['id']?>/preview.jpg" /></td> */?>
			<?php /*?>
			<td>
			<?php
			//tam thoi
				//echo $row['gia'].' '.$row['don_vi_tien'].'/'.$row['don_vi_dien_tich'];
				//echo $row[$k]['gia'];
				echo $this->rows[$k]['gia'];
			//	 print_r($this->rows[3]['gia']);
			//	echo $this->test4;
			?>
			</td>
			
			*/
			$sohinh = count($row['hinhanh']);
			$hinh = $row['hinhanh'];
			?>
			<td valign="bottom">
			<div id="gallery<?php echo $k?>">
				<?php if($sohinh>0){?>
				<a href="<?php echo $row['hinhanh1']['max_url']?>">Xem thêm</a>
				<?php }?>
				<div style="display: none">
				<?php for ($i=0;$i<$sohinh;$i++){?>
					<a href="<?php echo $hinh[$i]['max_url']?>" onclick="return false;">
						<img alt="" src="<?php echo $hinh[$i]['max_url']?>" width="105px" height="80px"  style="float:right;margin-right:5px">
					</a>
				<?php }?>
				</div>
					<img alt="" src="<?php echo $row['hinhanh1']['max_url']?>" width="105px" height="80px" style="float:right;margin-right:5px">
			</div>
			</td>
			<td align="center" style="display: none">
				<?php $task_emphasis = $row['noi_bat'] ? 'unemphasis' : 'emphasis';		?>
				<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $k ?>','<?php echo $task_emphasis ?>')">
				<img src="images/<?php echo ( $row['noi_bat'] ) ? 'tick.png' : 'publish_x.png';?>"
				width="16" height="16" border="0" alt="<?php echo $row['noi_bat'] ? JText::_('Yes') : JText::_('No') ?>" />
				</a>
			</td>
			
			<td align="center" style="display: none">
				<?php $task_newsest = $row['moi_nhat'] ? 'unnewsest ' : 'newsest ';		?>
				<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $k ?>','<?php echo $task_newsest ?>')">
				<img src="images/<?php echo ( $row['moi_nhat'] ) ? 'tick.png' : 'publish_x.png';?>"
				width="16" height="16" border="0" alt="<?php echo $row['moi_nhat'] ? JText::_('Yes') : JText::_('No') ?>" />
				</a>
			</td>
			<td align="center">		
			<?php 
			if ( $userapproved == 0 ) 
			{
			?>
			
				<?php $task_publish 	= $row['hien_thi_ra_ngoai'] ? 'unpublish' : 'publish';		?>
				<a href="#" onclick="return listItemTask('cb<?php echo $k ?>','<?php echo $task_publish ?>')">
					<img src="images/<?php echo ( $row['hien_thi_ra_ngoai'] ) ? 'tick.png' : 'publish_x.png';?>"
					width="16" height="16" border="0" alt="<?php echo $row['hien_thi_ra_ngoai'] ? JText::_('Yes') : JText::_('No') ?>" />
				</a>	
			
			<?php 
			}
			else 
			{
			?>			
				<a href="#"
					onclick="alert('<?php echo JText::_('BAN_KHONG_CO_QUYEN' ) ?>')">
					<img src="images/<?php echo ( $row['hien_thi_ra_ngoai'] ) ? 'tick.png' : 'publish_x.png';?>"
					width="16" height="16" border="0" alt="<?php echo $row['hien_thi_ra_ngoai'] ? JText::_('Yes') : JText::_('No') ?>" />
			</a>			
			<?php 
			}
			?>
			</td>
			<td align="center" style="display: none" >
				<?php $task_spam = $row['bao_cao_sai_pham'] ? 'unspam' : 'spam';		?>
				<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $k ?>','<?php echo $task_spam ?>')">
				<img src="images/<?php echo ( $row['bao_cao_sai_pham'] ) ? 'tick.png' : 'publish_x.png';?>"
				width="16" height="16" border="0" alt="<?php echo $row['bao_cao_sai_pham'] ? JText::_('Yes') : JText::_('No') ?>" />
				</a>
			</td>
			<!-- 
			<td align="center">
				<?php $task_da_ban = $row['da_ban'] ? 'unda_ban ' : 'da_ban ';		?>
				<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $k ?>','<?php echo $task_da_ban ?>')">
				<img src="images/<?php echo ( $row['da_ban'] ) ? 'tick.png' : 'publish_x.png';?>"
				width="16" height="16" border="0" alt="<?php echo $row['da_ban'] ? JText::_('Yes') : JText::_('No') ?>" />
				</a>
			</td>
			 -->

<!--			<td align="center"><?php // echo $this->pagination->orderUpIcon( $k ) ?></td>-->

<!--			<td align="center"><?php //echo $this->pagination->orderDownIcon( $k, $rowsCount ) ?></td>-->
			
			<td>
			<?php //if ( $this->user->authorize( 'com_users', 'manage' ) ): ?>
			<!--
                 <a href="<?php echo JRoute::_( 'index.php?option=com_users&task=edit&cid[]='. $row->created_by )  ?>"
                    title="<?php echo JText::_( 'Edit User' ) ?> "><?php echo $this->escape( $row->author ) ?></a>
                     -->
            <?php //else :
            //hoan dang lam
            //echo "tac gia";
			echo $this->rows[$k]['ten_nguoi_dang'];
             //echo $this->escape( $row[property_field_created_by] ) ?>
			<?php //endif ?>
			</td>
			<td>
			<?php if($this->rows[$k]['chinh_chu'])echo 'chính chủ'; else echo ''; ?>
			</td>
			<td>
			<?php if($this->rows[$k]['speak_english'])echo 'speak english'; else echo ''; ?>
			</td>
			<td><?php echo JHTML::_('date',  $row['ngay_dang'], JText::_('DATE_FORMAT_LC4') ); ?></td>
<?php /*?>
<!-- dang lam -->
			<td align="center"><?php  echo $this->pagination->orderUpIcon( $k ) ?></td>

			<td align="center"><?php echo $this->pagination->orderDownIcon( $k, $this->tongDong ) ?></td>
			<td>
				<input type="text" style="width:35px" value="<?php echo $row['ordering'] ?>" name="ordering_<?php echo $row['id']?>" />
			</td>
			
			<td>
				 <a href="#edit" onclick="return listItemTask('cb<?php echo $k ?>','ordering')">
	        		<img src="../images/filesave.png"  style="cursor:pointer" />
	       		 </a>
			</td>

<!-- dang lam -->			
			
			<td>
				<input type="text" style="width:35px" value="<?php echo $row['luot_xem'] ?>" name="luot_xem_<?php echo $row['id']?>" />
			</td>
			<td>
				 <a href="#edit" onclick="return listItemTask('cb<?php echo $k ?>','luot_xem')">
	        		<img src="../images/filesave.png"  style="cursor:pointer" />
	       		 </a>
			</td>
			
            <td><?php echo $row['id'] ?></td>
            */?>
		</tr>

		<?php endforeach ?>
<?php } //end if emplty  ?>
	</tbody>

</table>

<div>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="ordering" value="ordering" />
	<input type="hidden" name="filter_order" value="<?php echo $this->order ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->order_dir ?>" />
	<input type="hidden" name="limitstart" value="<?php echo $this->limitstart ?>" />
	<?php echo JHTML::_( 'form.token' ) ?>
</div>

</form>
