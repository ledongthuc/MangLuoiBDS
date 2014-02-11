<?php
$online;
 $online_visitors ;
 ?>
  
  <?php	defined('_JEXEC') or die('Restricted access'); ?>
<?php
function format_gia($tietkiem_so)
		{
			$tietkiem_leng = strlen($tietkiem_so);
			$k = 0;
			$t_kiem = '';
			$tietkiem_arr =array();
			while($k <= $tietkiem_leng - 3)
			{
				$k += 3;
				
				$temp = substr($tietkiem_so,-$k,3);
				
				$tietkiem_arr[]= $temp;
				
			}
			
			if ( $k > $tietkiem_leng - 3 )
			{
				$temp = substr($tietkiem_so,0, $tietkiem_leng - $k);
				$tietkiem_arr[]= $temp;
			}
			
			for ($i=count($tietkiem_arr)-1 ;$i>=0; $i--)
			{
				$t_kiem.=' '.$tietkiem_arr[$i];
			}
			//$t_kiem.='.00';
			return $t_kiem;
		}
?>
<div class="div_songuoitruycap">

	<!-- So nguoi dang online -->
		<span class="songuoionlinetitle">
				<?php echo JText::_('Đang online');?>:
		</span>		
		<span class='songuoitruycap'>
			<?php 
						// echo $online ;
						echo $online_visitors; 
			?>
		</span>		
		</br>
	<!-- So luot truy cap -->	
		<span class="songuoionlinetitle">
				<?php echo JText::_('Số lượt truy cập');?>:
		</span>		
		<span class='songuoitruycap'>
			<?php 	
				$arr = & modVisitCounterHelper::getDigits( $all_visitors,$number_digits );	
				$ShowVisiteUser ='';
				foreach ($arr as $digit)
				{
					$ShowVisiteUser .= $digit;
					// echo modVisitCounterHelper::showDigitImage( $digit_type, $digit );
				}
				echo format_gia($ShowVisiteUser);	
			 ?>
		</span>
		
</div>

		