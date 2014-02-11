<?php
	defined('_JEXEC') or die('Restricted access');
	
	$moduleclass_sfx = $params->get('moduleclass_sfx','');
	
    // Yahoo
    $yahooID = trim($params->get('yahooID', ''));
    $nameYahoo = trim($params->get('nameYahoo', ''));
    $telYahoo = trim($params->get('telYahoo', ''));
    $showYahoo = intval($params->get('showYahoo', 1));
    $typeYahoo = intval($params->get('typeYahoo', 2));
    // Skype
    $skypeID = trim($params->get('skypeID', ''));
    $nameSkype = trim($params->get('nameSkype', ''));
    $telSkype = trim($params->get('telSkype', ''));
    $showSkype = intval($params->get('showSkype', 1));
    $typeSkype = trim($params->get('typeSkype', ''));

    // Thông tin khác
    $showName = intval($params->get('showName', 1));
    $showTel = intval($params->get('showTel', 0));
?>
<div align="center" class="<?php echo $moduleclass_sfx; ?>">
<?php
	Xu_ly_yahoo($yahooID, $nameYahoo, $telYahoo, $showYahoo, $typeYahoo, $showName, $showTel);
	Xu_ly_skype($skypeID, $nameSkype, $telSkype, $showSkype, $typeSkype, $showSkype, $showSkype);
?>
</div>

<?php
	function Xu_ly_yahoo($yahooID, $nameYahoo, $telYahoo, $showYahoo, $typeYahoo, $showName, $showTel)
	{
		if($showYahoo==1)
		{
			$array_yahooID = split(',',$yahooID);
			$array_nameYahoo = split(',',$nameYahoo);
			$array_telYahoo = split(',',$telYahoo);
			$count = count($array_yahooID);
			for($i=0;$i<$count;$i++)
			{
			?>
				<div><a href="ymsgr:sendIM?<?php echo trim($array_yahooID[$i]); ?>">
				<img title="" alt="" src="http://opi.yahoo.com/online?u=<?php echo trim($array_yahooID[$i]); ?>&amp;m=g&amp;t=<?php echo $typeYahoo; ?>" border="0">
				</a>
				<a href = 'http://www.itnameserver.com' title = 'thiet ke web - hosting - domain - itnameserver.com' alt = 'thiet ke web - hosting - domain - itnameserver.com'>&nbsp;</a></div>
				<?php if($showName==1){ ?>
				<div><?php echo $array_nameYahoo[$i];  ?> </div>
				<?php } if($showTel==1){ ?>
				<div><?php echo $array_telYahoo[$i];  ?> </div>
			<?php
				}
			}
		}
	}

	function Xu_ly_skype($skypeID, $nameSkype, $telSkype, $showSkype, $typeSkype, $showName, $showTel)
	{
        if($showSkype==1)
		{
			$array_skypeID = split(',',$skypeID);
			$array_nameSkype = split(',',$nameSkype);
			$array_telSkype = split(',',$telSkype);
			$count = count($array_skypeID);
			for($i=0;$i<$count;$i++)
			{
			?>
				<div><a href="skype:<?php echo trim($array_skypeID[$i]); ?>?call">
				<img title="" src="http://mystatus.skype.com/<?php echo $typeSkype; ?>/<?php echo trim($array_skypeID[$i]); ?>" alt="thiet ke web - hosting - domain - itnameserver.com" title="thiet ke web - hosting - domain - itnameserver.com" border="0" ></a><a href = 'http://www.itnameserver.com' title = 'thiet ke web - hosting - domain - itnameserver.com' alt = 'thiet ke web - hosting - domain - itnameserver.com'>&nbsp;</a>
				</div>
				<?php if($showName==1){ ?>
				<div><?php echo $array_nameSkype[$i];  ?> </div>
				<?php } if($showTel==1){ ?>
				<div><?php echo $array_telSkype[$i];  ?> </div>
			<?php
				}
			}
		}
	}
?>