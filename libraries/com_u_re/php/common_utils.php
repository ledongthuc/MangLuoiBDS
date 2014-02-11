<?php

// TODO: define common model path as constant
require_once(  JPATH_ROOT.DS.'libraries/com_u_re/models/properties.php');
require_once( JPATH_ROOT.DS.'libraries/com_u_re/models/projects.php');
require_once( JPATH_ROOT.DS.'includes/ham_tien_ich.php');
jimport('joomla.application.component.view');

//require_once('components/com_u_re/config.php');

//require_once( JPATH_ROOT.DS.'components/com_u_re/config.php');
require_once(JPATH_ROOT.DS.'libraries'.DS.'com_u_re'.DS.'php'.DS.'config.php');

//print_r(JPATH_ROOT.DS);

class ilandCommonUtils
{

	/*
	 * Chau: rewrite function formatPrice
	 * Format 3 000 000 VND to 3 trieu
	 */
	function reFormatPrice($price)
	{
		$price = str_replace(',','',number_format($price, 2, '.', ''));
		// only VND format or price is 0
	//	if ($price_unit != "VND" || intval($price) == 0)
	//	{
	//		return $price;
	//	}
	
	 	
		if (intval($price) == 0)
		{
			return $price;
		}
		// if price is 0 ==> return 0;
		
		// trim decimal part after "."
		$dec_sepa = strpos($price, ".", 0);
		if ($dec_sepa > 0)
		{
			$price = substr($price, 0, $dec_sepa);
		}
		
		$result = "";
		$length = strlen($price);
		$price_str_arr = array("", "ngàn", "triệu", "tỷ");
		$str_ind = 0;
		$i = $length;
		
		while ($i > 0)
		{
			$temppos = $i - 3;
			if ($temppos < 0)
			{
				$temppos = 0;
			}
			$tempstr = substr($price, $temppos, $i - $temppos);
			
			$tempstr = intval($tempstr);
			
			if ($tempstr > 0)
			{
				$result = $tempstr . " " . $price_str_arr[$str_ind] . " " . $result;
			}
			$str_ind ++;
			$i = $temppos;
		}
		return $result;
	}

	function changePrice($price, $rate1, $rate2)
	{
		$middlePrice = $price * $rate1;
		//return $rate2/$middlePrice;
	//	return $middlePrice/$rate2;
		return round($middlePrice/$rate2,2);
	}

 	/* hoan bat dong san lien quan 2010-10-26 */
    function getSamLand($keytown_id=NULL, $keykind_id=NULL, $keytype_id=NULL, $tigia=NULL, $slht=NULL,
    				$id=NULL, $khoanggia=NULL, $keyarea_id=NULL, $realtor =NULL, $price = NULL, $CurrenPage = NULL)
    {
		$db =& JFactory::getDBO();
        $query  = "SELECT * FROM #__jea_price_units ORDER BY ordering DESC";
        $db->setQuery($query);
		$result = $db->loadObjectList();
		foreach ($result as $row)
			{
				if($row->id==$tigia)
				{
					$tigia= $row->rate;
				}
				$rate[0]= $row->rate;
					
			}
      /* chuyen doi ve tien viet */
       $keyprice= changePrice($price,$tigia,$rate[0]);
		//print_r($keyprice);
			
			
		if( $keyprice > 0)
		{
			$keypricea = $keyprice;
		}
			else
		{
			$keypricea = 1;
		}
			
		if( $keytown_id || $keytype_id || $keykind_id || $khoanggia > 0)
		{
			$sql ="SELECT tp.ref,tp.kind_id,tp.price,tp.type_id, tp.id,tp.price_area_unit,tp.price_unit,
						tp.address, tp.living_space,tp.phuongxa AS phuongxa, tp.duongpho AS duongpho,
						tto.value AS `town`,area.value AS `area`
					FROM #__jea_properties AS tp
					LEFT JOIN #__jea_towns AS tto ON tto.id = tp.town_id
					LEFT JOIN #__jea_areas AS area ON area.id = tp.area_id
					LEFT JOIN #__jea_price_units AS pri ON pri.id=tp.price_unit
					WHERE tp.id <> $id AND tp.success = 0 AND tp.published=1 AND ( ";

			if($keytown_id)
    		{
    			$sql .= "  tp.town_id LIKE '%$keytown_id%'";
    		}
    		if($keykind_id)
    		{
    			if($keytown_id)
    			{
    				$sql.=" OR ";
    			}
    			$sql .= " kind_id LIKE '%$keykind_id%'";
    		}
    		
   			if($keytype_id)
    		{
    			if($keykind_id || $keytown_id ){$sql.=" OR ";}
    			$sql .= " type_id LIKE '%$keytype_id%'";
    		}
    		
     		if($khoanggia > 0)
    		{
    			
    			if($keytype_id || $keykind_id || $keytown_id ){$sql.=" OR ";}
       			$sql.=	" ABS( $keyprice - IF( tp.price_unit=1,tp.price,tp.price*pri.rate )) < ( $keypricea * $khoanggia / 100 ) ";
       		
       			
    		}
    		$sql.=" ) ";
    		if($realtor)
    		{
    			 $sql .= ' AND realtor_id = '.$realtor;
    		}
	    		$sql.=" GROUP BY tp.id";
	    		$sql.=" ORDER BY IF( tp.price_unit=1,tp.price,tp.price*pri.rate )";
			$result = array();
			$db->setQuery ($sql);
			
			$numrows = $db->loadObjectList() ;
			$result['TotalPage'] = ceil(count($numrows)/$slht);

			if(isset($CurrenPage))
			{
				$bd= $CurrenPage * $slht - $slht;
				$db->setQuery($sql,$bd,$slht);
			}
			else
			{
				$db->setQuery ( $sql,0,$slht );
			}
			$result['rows'] = $db->loadObjectList();
			//print_r($sql);
			return $result;
	  	 }
    }
	
	function getSelectBox( $table, $name, $title, $checked, $onchange=NULL, $townId =NULL, 
						   $style=NULL, $class = NULL, $language =NULL)
	{
/*
		echo "<pre>";
		print_r( $name.'----'.$class );
		echo "</pre>";
		*/
		if ($language == NULL )
		{
			$language = ilandCommonUtils::getLanguage();
		}
		
		// TODO: remove hardcode language
//		$language = 'en';
		
//		print_r($language);
		$propertyModel = new U_reModelProperties();
		$projectModel = new U_ReModelProjects();
		
		switch ( $table )
		{
			case 'loai_giao_dich':
				{
					$rows = $propertyModel->layDanhSachLoaiGiaoDich($language);
					//print_r($rows);
					//exit;
					break;
				}
			case 'phap_ly':
				{
					$rows = $propertyModel->layDanhSachPhapLy($language);
					break;
				}
			case 'vi_tri':
				{

					$rows = $propertyModel->layDanhSachTienIch('1', $language);
				//	print_r($rows);
				//	exit;
					break;
				}
			case 'huong':
				{
					$rows = $propertyModel->layDanhSachHuong($language);
					break;
				}
			case 'don_vi_dien_tich':
				{
					$temp = 1;
					if($checked==3||$checked==4){
						$temp =2;
					}
					$rows = $propertyModel->layDanhSachDonViDienTich($language,$temp);
					break;
				}
			case 'loai_bds':
				{
					$rows = $propertyModel->layDanhSachLoaiBatDongSan($language);
					break;
				}
			case 'tinh_thanh':
				{
					$rows = $propertyModel->layDanhSachTinhThanh( $language );
					break;
				}
			case 'quan_huyen':
				{
					$rows = $propertyModel->layDanhSachQuanHuyen($townId, $language);
					break;
				}
				
			case 'loai_tien_ich':
				{
					$DBConfig = ilandCommonUtils::getSiteDBConfig();
					$rows   = iland4_layDanhSachLoaiTienIch( $DBConfig, $language );				
					break;
				}
			case 'loai_du_an':
				{
//					$rows = $propertyModel->layDanhSachLoaiBatDongSan($language);
					$rows = $projectModel->laynhomduan($language);
				
					break;
				}
				
			case 'nha_moi_gioi':
				{
//					$rows = $propertyModel->layDanhSachLoaiBatDongSan($language);
					$realtorData = $projectModel->laynhamoigioi($language);
					$rows = $realtorData[3];
				//	print_r($rows);
					// exit;
					break;
				}
			case 'phuong_xa':
				{
					// get quan huyen id
					$rows = $propertyModel->layDanhSachPhuongXa( $townId );
					break;						
				}
			case 'duong_pho':
				{
					$rows = $propertyModel->layDanhSachDuongPho( $townId );
					break;
				}
				
			case 'nhom_du_an':
				{
				//	$rows =  $projectModel->laynhomduan($language);	
				//	break;
					
					$nhomduan =  $projectModel->laydanhsachduan();				
					$rows = $nhomduan[3];		
					break;
				}
			case 'du_an':
				{
					$rows= $projectModel->laydanhsachduan( $townId );
					break;
				}
		}
		/*
			case 'jea_type' : $rows = getTypeList($language);
			break;
			case 'jea_town' : $rows = getTownList(U_ReUtils::getSiteConfig(), $language);
			break;
			case 'jea_area' : $rows = getAreaList(U_ReUtils::getSiteConfig(), $Town_id, $language);
			break;
			
			case 'jea_project_type' : $rows = getProjectTypeList(U_ReUtils::getSiteConfig(), $language);
			break;
		*/
		if( empty($class))
		{
			$class = "class='inputbox'";
		}
		
		$html ='';
		$html .= "<select name='" . $name . "' id='" . $name . "' onchange='" . $onchange . "' ". $class . $style . ">";
	
		if( !empty ( $title ))
		{
			$html .= "<option value='0'>$title</option>";
		}
		if ( !empty($rows) )
		{
			foreach ( $rows as $row )
			{
				$selected = '';
				$selected = ( $row["id"]==$checked ) ? 'selected = selected':'';
				$html .= "<option  value=$row[id] $selected >$row[ten]</option>";
			}
		}
		
		$html .= "</select>";
		return $html;
	}
	
	function getSelectAdvantage($language, $advantage)
	{
		$html = '';
		$rows = U_reModelProperties::layDanhSachTienIch($language);
	
		$advantages = array();
		if ( !empty( $advantage ) )
		{
            $advantages = explode( '-' , $advantage );
        }
	
        foreach ( $rows as $k=> $row )
		{
            $checked = '';
            if ( in_array($row['id'], $advantages) )
			{
                $checked = 'checked="checked"' ;
            }
		
			$html .= '<label class="advantage">' . PHP_EOL
                  .'<input type="checkbox" id="advantages[' . $k . ']" name="advantagedValue[' . $k . ']" value="'
                  . $row['id']. '" ' . $checked . ' />' . PHP_EOL
                  . $row['ten'] . PHP_EOL
                  . '</label>' . PHP_EOL ;
        }
        return $html;
								  
	}
	
	function getRealtorImage( $realtorId )
	{
		// TODO: set alt & title for SEO advance

		global $u_reGlobalConfig;
		$propertyImagePath = JURI::root().$u_reGlobalConfig['IMAGE']['realtor_image_path'];
		$propertyImageUrlPath = JPATH_ROOT.'/'.$u_reGlobalConfig['IMAGE']['realtor_image_path'];
		$image = array();
		$image['avatar'] = $propertyImagePath . '/' . $realtorId . '/' .
										$u_reGlobalConfig['IMAGE']['realtor_image_avatar_name'];
										
		$image['thumbnail'] = $propertyImagePath . '/' . $realtorId . '/' .
										$u_reGlobalConfig['IMAGE']['realtor_image_thumbnail_name'];
		
		$image['alt'] = '';
		$image['title'] = '';
		$image['isfile'] = $propertyImageUrlPath. '/' . $realtorId . '/' .
										$u_reGlobalConfig['IMAGE']['realtor_image_avatar_name'];
		return $image;
	}
		
	/*
	* Description: Lấy hình ảnh chính
	* Author: Minh Chau
	* Version:
	* Date create: 23-03-2011
	* @return: Thông tin của hình ảnh chính
	* 	preview_url: Hình trung bình, dùng trong trang chi tiết bất động sản
	* 	min_url: Hình nhỏ, thumbnail
	* 	max_url: Hình lớn, dùng cho gallery
	* 	title: Dùng cho mục đích SEO advance
	* 	alt: Dùng cho mục đích SEO advance
	*/
	function getPropertyMainImage( $propertyId )
	{
		// TODO: set alt & title for SEO advance

		global $u_reGlobalConfig;
		$propertyImagePath = JURI::root().$u_reGlobalConfig['IMAGE']['property_image_path'];
		$propertyImageUrlPath = JPATH_ROOT.'/'.$u_reGlobalConfig['IMAGE']['property_image_path'];
		$image = array();
		$image['preview_url'] = $propertyImagePath . '/' . $propertyId . '/' .
										$u_reGlobalConfig['IMAGE']['property_image_preview_name'];
		$image['min_url'] = $propertyImagePath . '/' . $propertyId . '/' .
										$u_reGlobalConfig['IMAGE']['property_image_min_name'];
		$image['max_url'] = $propertyImagePath . '/' . $propertyId . '/' .
										$u_reGlobalConfig['IMAGE']['property_image_max_name'];
		if ( !is_file( $propertyImageUrlPath. '/' . 
						$propertyId . '/' . 
						$u_reGlobalConfig['IMAGE']['property_image_max_name']) )
						
		{
			$image['max_url'] = $image['preview_url'];
		}
		$image['alt'] = '';
		$image['title'] = '';
		$image['isfile'] = $propertyImageUrlPath. '/' . $propertyId . '/' .
										$u_reGlobalConfig['IMAGE']['property_image_min_name'];
		return $image;
	}
		
	function getPropertySubImages( $propertyId )
	{
		// TODO: set alt & title for SEO advance
		
		global $u_reGlobalConfig;
		$dir = JPATH_ROOT.'/'.$u_reGlobalConfig['IMAGE']['property_image_path'] . '/' . $propertyId . '/' .
									$u_reGlobalConfig['IMAGE']['property_image_secondary_dir_name'];
		$dir1 = JURI::root().$u_reGlobalConfig['IMAGE']['property_image_path'] . '/' . $propertyId . '/' .
									$u_reGlobalConfig['IMAGE']['property_image_secondary_dir_name'];		
					
		//secondaries images
        $images = array();
       
        jimport('joomla.filesystem.folder');
       
        if( JFolder::exists( $dir ) )
        {
        	
                
            $filesList = JFolder::files( $dir );

            $viewfilesList = array();
            foreach ( $filesList as $filename ) {
					
                $detail = array();
                $detail['title'] = '';
                $detail['alt'] = '';
                $detail['preview_url'] = $dir1 . '/preview/' . $filename;
                $detail['min_url'] = $dir1 . '/min/' . $filename ;
                $detail['max_url'] = $dir1 . '/large/' . $filename;
            	if ( !is_file( $dir . '/large/' . $filename ) )
                {
                	$detail['max_url'] = $detail['preview_url'];
                }
                
                $detail['name']=$filename;
                $viewfilesList[] = $detail ;
            }
            $images =  $viewfilesList ;
        }
		
          
		return $images;
	}
	
	function getProjectSubImages( $projectId )
	{
		// TODO: set alt & title for SEO advance
		global $u_reGlobalConfig;
		$dir = JPATH_ROOT.'/'.$u_reGlobalConfig['IMAGE']['project_image_path'] .DS . $projectId . '/' .
									$u_reGlobalConfig['IMAGE']['property_image_secondary_dir_name'];
		$dir1 = JURI::root().$u_reGlobalConfig['IMAGE']['project_image_path'] . DS. $projectId . '/' .
									$u_reGlobalConfig['IMAGE']['property_image_secondary_dir_name'];
		//secondaries images
        $images = array();
        jimport('joomla.filesystem.folder');
       
        if( JFolder::exists( $dir ) )
        {
                
            $filesList = JFolder::files( $dir );

            $viewfilesList = array();
            foreach ( $filesList as $filename ) {
					
                $detail = array();
                $detail['title'] = '';
                $detail['alt'] = '';
				$detail['min_url'] = $dir1 . '/min/' . $filename ;
				$detail['preview_url'] = $dir1 . '/preview/' . $filename;
                $detail['max_url'] = $dir1 . '/large/' . $filename;
				if ( !is_file( $dir . '/large/' . $filename ) )
                {
                	$detail['max_url'] = $detail['preview_url'];
                }                                
                $detail['name']=$filename;    
                $viewfilesList[] = $detail ;
            }
            $images =  $viewfilesList ;
        }
		return $images;
	}
	
	function getProjectMainImage( $projectId )
	{
		// TODO: set alt & title for SEO advance

		global $u_reGlobalConfig;
		$propertyImagePath = JURI::root().$u_reGlobalConfig['IMAGE']['project_image_path'];
		$propertyImageUrlPath = JPATH_ROOT.'/'.$u_reGlobalConfig['IMAGE']['project_image_path'];
		$image = array();
		$image['preview_url'] = $propertyImagePath . DS . $projectId . '/' .
										$u_reGlobalConfig['IMAGE']['property_image_preview_name'];
		$image['min_url'] = $propertyImagePath . DS . $projectId . '/' .
										$u_reGlobalConfig['IMAGE']['property_image_min_name'];
		$image['max_url'] = $propertyImagePath  .DS . $projectId . '/' .
										$u_reGlobalConfig['IMAGE']['property_image_max_name'];
		
		if ( !is_file( $propertyImageUrlPath. '/' . 
						$projectId . '/' . 
						$u_reGlobalConfig['IMAGE']['property_image_max_name']) )
						
		{
			$image['max_url'] = $image['preview_url'];
		}								
										
		$image['alt'] = '';
		$image['title'] = '';
		$image['isfile'] = $propertyImageUrlPath. '/' . $projectId . '/' .
										$u_reGlobalConfig['IMAGE']['property_image_min_name'];
			
		return $image;
	}
	/*
	* Description: Lấy thông số offset và limit
	* Author: Minh Chau
	* Version:
	* Date create: 25-03-2011
	* @return: array ( $offset, $limit )
	*/
	function getOffsetLimit( $page, $limit )
	{
		if ( $limit == 0 )
		{
			global $u_reGlobalConfig;
			$limit = $u_re_GlobalConfig['COMMON']['limit'];
		}
		if ( $page < 2 )
		{
			$offset = 0;
		}
		else
		{
			$offset = ( $page - 1 ) * $limit;
		}
		return $offset;
	}
	
	/*
	 * Description: Lay thong tin ket noi DB
	 * Author: Minh Chau
	 * Version:
	 * Date create: Apr 9, 2011
	 */
	 function getSiteDBConfig()
	 {
	 	$dbConfig = array();
		$dbConfig[] = U_ReConfig::getValueByKey( 'DB', 'host' );
		$dbConfig[] = U_ReConfig::getValueByKey( 'DB', 'user' );
		$dbConfig[] = U_ReConfig::getValueByKey( 'DB', 'pass' );
		$dbConfig[] = U_ReConfig::getValueByKey( 'DB', 'name' );
		
		return $dbConfig;
	 }
	 
	/*
	 * lay thong tin ngon ngu hien tai
	 * vietnam return vi...
	 */
	function getLanguage()
	{
		$lang =& JFactory::getLanguage();
		$language = substr($lang->getTag(),0,2);
		return $language ;
	}
	
	// function tam thoi
	function getArrayLanguage()
	{
		$n =array ();
		$n[]='vi';
		$n[]='en';
		return $n ;
	}
	
	/* phan trang */
	function getPage($total, $limit)
	{
		jimport('joomla.html.pagination');
		$limitstart =& JRequest::getVar('limitstart', 0);
		$pagination = new JPagination( $total , $limitstart, $limit );
		return   $pagination->getPagesLinks();
	}
	
	/*
	* Description: Fetch HTML from template
	* Author: Minh Chau
	* Version: 
	* Date create: 23-04-2011
	*/
	function fetchPropertiesTemplate( $templatePath, $templateName, $data )
	{
		$template = new JView();
		$template->addTemplatePath( $templatePath );
		$template->assignRef( 'data', $data );
		$hien_thi_luot_xem=0;
		if(U_ReConfig::getValueByKey( 'COMMON', 'luot_xem_ds_bds' ) == 1)
		{
			$hien_thi_luot_xem=1;	
		}
		else
		{
			$hien_thi_luot_xem=0;
		}
		$template->assignRef( 'ajaxPaging', $ajaxPaging );
		$template->assignRef( 'hien_thi_luot_xem', $hien_thi_luot_xem );
		$template->setLayout( $templateName );		
		return $template->loadTemplate();
	}
	
	/*
	* Description: Lay template tien te 
	* Author: Minh Chau
	* Version: 
	* Date create: 23-04-2011
	*/
	function fetchCurrencyTemplate( $property, $templatePath, $moduleId, $template_tien_te=NULL )
	{
		
		if ( !empty( $property['don_vi_tien'] ) )
		{
			$donViTienChinh = $property['don_vi_tien'];
		}
		else 
		{
			// TODO: Set default don vi tien theo ngon ngu hoac theo cau hinh.
			$donViTienChinh = 'VND';			
		}

		$donViTienList = U_ReModelProperties::layDanhSachDonViTien();
		
		
		$donViTienArr = array();
		foreach ( $donViTienList as $dv )
		{
			$donViTienArr[$dv['ten']] = $dv['ti_gia'];
		}
		
		if ( isset($template_tien_te) || trim($template_tien_te) !=NULL )
		{
			$tienTemplate = 	$template_tien_te ;
		}
		else
		{
			$tienTemplate = U_ReConfig::getValueByKey( 'PROPERTY', 'tien_template' );
		}
		
		$tiGiaChinh = $donViTienArr[$donViTienChinh];
		
		$giaArr = array();			
		
		foreach ( $donViTienArr as $key => $value )
		{
			$giaArr[$key] = (( $property['gia'] * $tiGiaChinh ) / $value );
			$giaArr[$key] = round( $giaArr[$key], 2);  
		}
		
		// truong hop dac biet
		$giaArr['VND'] = ilandCommonUtils::reFormatPrice( $giaArr['VND'] );
		
		$donviChinh = ilandCommonUtils::layGiaTien( array('don_vi_tien_id'=>$property['don_vi_tien_id'], 
												'don_vi_dien_tich_id'=>$property['don_vi_dien_tich_id'],
											 									'gia'=>$property['gia']) );
		
		// $giaChinh = $giaArr[$donViTienChinh];
		$giaChinh = $donviChinh;
			
			
		$template = new JView();
		$template->addTemplatePath( $templatePath );
		$template->assignRef( 'giaArr', $giaArr );
		$template->assignRef( 'id', $property['id'] );
		$template->assignRef( 'donViTienChinh', $donViTienChinh );
		$template->assignRef( 'giaChinh', $giaChinh );
		$template->assignRef( 'moduleId', $moduleId );
		$template->assignRef( 'don_vi_dien_tich_id', $property['don_vi_dien_tich_id'] );
		$template->setLayout( $tienTemplate );
		return $template->loadTemplate();
	}

	/*
	* Description: Get ajax pagination 
	* Author: Minh Chau
	* Version: 
	* Date create: 24-04-2011
	*/
	function getAjaxPagination( $idContentElement, $url, $currentPage, $totalPage, 
								$templatePath, $templateName )
	{
		// xu ly url + trang
		
		$prePage = $currentPage - 1;
		$nextPage = $currentPage + 1;
		if ( $prePage < 1 )
		{
			$prePage = 1; 
		}
		if ( $nextPage > $totalPage )
		{
			$nextPage = $totalPage;	
		}
		
		$template = new JView();
		$template->addTemplatePath( $templatePath );
		$template->assignRef( 'url', $url );
		$template->assignRef( 'currentPage', $currentPage );
		$template->assignRef( 'totalPage', $totalPage );
		$template->assignRef( 'prePage', $prePage );
		$template->assignRef( 'nextPage', $nextPage );
		$template->assignRef( 'idElement', $idContentElement );
		$template->setLayout( $templateName );
		
		return $template->loadTemplate();
	}
	
	/*
	* Description: generate chuoi dieu kien lay bat dong san lien quan 
	* Author: Minh Chau
	* Version: 
	* Date create: 26-04-2011
	*/
	function genBDSLQConditionParam( $conditionStr, $propertyData )
	{
		$conditionParamArr = explode( ',', $conditionStr );

		$conditionParamStr = ' 1 ';
		if ( !empty($propertyData['id']) )
		{
        	$conditionParamStr .= " AND id != '" . $propertyData['id'] . "' ";
		}

		$chenhLechGia = U_ReConfig::getValueByKey( 'PROPERTY', 'chenh_lech_gia' );
		if ( (!empty( $chenhLechGia ) ) )
		{
			// lay tong gia
			$tongGia = $propertyData['tong_gia_tri'];
			
			$giaThap = $tongGia * (1 - $chenhLechGia);
			$giaCao = $tongGia * (1 + $chenhLechGia);

			$conditionParamStr .= 'AND tong_gia_tri BETWEEN ' . $giaThap . ' AND ' . $giaCao . ' ';
		}
		
        $length = count( $conditionParamArr );
        
        for ( $i = 0; $i < $length; $i++ )
        {
        	if ( !empty( $propertyData[$conditionParamArr[$i]] ) ) 
        	{
				$conditionParamStr .= ' AND ';
				$conditionParamStr .= $conditionParamArr[$i] . '=' . $propertyData[$conditionParamArr[$i]];
        	}
        }
        
        return $conditionParamStr;
	}
	
    function delete_img( $id, $image='' )
    {  
	    $image	= JRequest::getVar( 'image' , '');
	    
		global $u_reGlobalConfig;
		$propertyImagePath = $u_reGlobalConfig['IMAGE']['property_image_path'];
		$deleteFiles = array();
		$dir = JPATH_ROOT . DS . $propertyImagePath .DS. $id .DS ;
		
		if( !$image ){
			//main image to delete
			$deleteFiles[] = $dir.'main.jpg';
			$deleteFiles[] = $dir.'preview.jpg';
			$deleteFiles[] = $dir.'min.jpg';
		}
		else 
		{
			
			//secondary image to delete
			if ( !strpos($image, '/') )
			{
				$deleteFiles[] = $dir.'secondary'.DS.$image;
				$deleteFiles[] = $dir.'secondary'.DS.'preview'.DS.$image;
				$deleteFiles[] = $dir.'secondary'.DS.'min'.DS.$image;	
				$deleteFiles[] = $dir.'secondary'.DS.'large'.DS.$image;		
			}
			else 
			{
				$imagePathArr = explode('/', $image);
				$deleteFiles[] = $dir. $image;
				$deleteFiles[] = $dir.$imagePathArr[0] . DS . 'preview' . DS . $imagePathArr[1];
				$deleteFiles[] = $dir.$imagePathArr[0].DS.'min'.DS.$imagePathArr[1];	
				$deleteFiles[] = $dir.$imagePathArr[0].DS.'large'.DS.$imagePathArr[1];
				
				
			}
		}
		
		foreach($deleteFiles as $file)
		{
			if( is_file($file) ) @unlink($file);
		}
		
		return true;
			
    }
    
  /*
   * lay gia chuyen doi thanh chu ( SJC==> luong, VND ==>thi bo )
   * param truyen vao
   * 	+ gia
   * 	+ don_vi_tien_id
   * 	+ don_vi_dien_tich_id
   */
	 function layGiaTien( $param )
	 {	
	
	 	switch( $param['don_vi_tien_id'] )
		{
			case 1 : $donvitien="";
			break;
			case 2 : $donvitien= "USD";
			break;
			case 3 : $donvitien=" lượng";
			break;
			default: $donvitien="";
			break;
		}		
		
		switch( $param['don_vi_dien_tich_id'] )
		{
			case 1 : $donvidat="/m<sup>2</sup>";
			break;
			case 2 : $donvidat="";
			break;
			case 3 : $donvidat="/tháng";
			break;
			default: $donvidat="";
			break;
		}
		if ( $param['don_vi_tien_id'] ==1 )
		{	
			$gia=ilandCommonUtils::reFormatPrice( $param['gia'] );
		}
		else 
		{
			$gia = $param['gia'];
		}
		
		if( $param['gia'] > 0)
		{
			/*
			$dau = '';
			if ( $donvitien != "" && $donvidat != "")
			$dau = '/';
			
			$hientien = $gia.$donvitien.$dau.$donvidat;
			*/
			$hientien = $gia.$donvitien.$donvidat;
		}
		else
		{
			$hientien= "Thương lượng";
		}
		
			return $hientien;
	 
	}
	
	/*
	* Description: Lấy thumbnail cua hinh anh chinh 
	* Author: Minh Chau
	* Version:
	* Date create: 23-03-2011
	* @return: Đường dẫn hình ảnh thumbnail
	*/
	function getPropertyThumbnail( $propertyId )
	{
		// TODO: set alt & title for SEO advance

		global $u_reGlobalConfig;
		
		$urlRoot = U_ReConfig::getValueByKey( 'COMMON', 'root' );
		
		$propertyImagePath = U_ReConfig::getValueByKey( 'IMAGE', 'property_image_path' );
		
		$image = array();
		$image['min_url'] = $propertyImagePath . '/' . $propertyId . '/' .
										U_ReConfig::getValueByKey( 'IMAGE', 'property_image_min_name' );
										
		// check if have image, if no, get default image
		if ( !file_exists( $image['min_url'] ) )
		{
			$image['min_url'] = COM_U_RE_PROPERTY_IMAGE_NO_PHOTO_THUMBNAIL;			
			return $image;
		}
										
		$image['alt'] = '';
		$image['title'] = '';
		
		return $image;
	}
	
	/*
	* Description: Tao link cho bds 
	* Author: Minh Chau
	* Version: 
	* Date create: 27-04-2011 
	*/
	function getPropertyLink( $alias, $id, $itemId = '' )
	{
		/*return "index.php?option=com_u_re&task=viewDetail&view=properties&id=" . 
						$id . '&Itemid=' . $itemId;*/
		global $u_reGlobalConfig;
		$rootLink = U_ReConfig::getValueByKey( 'COMMON', 'root' );
		$itemId = U_ReConfig::getValueByKey( 'PROPERTY', 'itemid_chi_tiet_BDS' );
		//$itemIds = '186';
		return $rootLink . "nhadat/" . trim($alias) . "/viewDetail/" . $itemId . "/" . $id;
	}
	
	function getProjectLink( $alias, $id, $itemId = '193' )
	{
		global $u_reGlobalConfig;
		$rootLink = $u_reGlobalConfig['COMMON']['root'];
		return $rootLink . "duan/" . trim($alias) . "/" . $itemId . "/" . $id;
	}
	
	/*
	* Description: Lay link va hinh anh cho danh sach bat dong san 
	* Author: Minh Chau
	* Version: 
	* Date create: 27-04-2011
	*/
	function getPropertyLinkAndImage( $propertyList )
	{
		$count = count( $propertyList );
		for ( $i = 0; $i < $count ; $i++ )
		{
			$tempImage = ilandCommonUtils::getPropertyThumbnail( $propertyList[$i]['id'] );
			$propertyList[$i]['image'] = $tempImage['min_url'];
			$propertyList[$i]['link'] = ilandCommonUtils::getPropertyLink( $propertyList[$i]['id'] );
		}
		return $propertyList;		
	}
	
	/* Hàm cut string*/
	function getcutstr($text,$length=64,$tail="...")
      {
	      $text = trim($text);
	      $txtl = strlen($text);
	      if($txtl > $length)
	      {
	     	for($i=1;$text[$length-$i]!=" ";$i++)
	     	{
	      		if($i == $length)
	      		{
	      			return substr($text,0,$length) . $tail;
	     		 }
	      	}
     	for(;$text[$length-$i]=="," || $text[$length-$i]=="." || $text[$length-$i]==" ";$i++) {;}
	      $text = substr($text,0,$length-$i+1) . $tail;
	      }
	      return $text;
      } 
	
    
	function getTiGia( $ten, $donViTienList )
	{
		foreach ( $donViTienList as $d )
		{
			if ( $d['ten'] == $ten )
			{
				return $d['ti_gia'];
			}
		}
		return 1;	
	}
	
	function ketHopDiaChi( $soNha, $duongPho, $phuongXa, $quanHuyen, $tinhThanh )
	{
		$dauQuanHuyen = '';
		$dauPhuongXa = '';
		$dauDuongPho = '';		
		$dauSoNha = '';
		
		if ( $soNha )
		{
			$dauSoNha = ' ';
		}
		
		if ( $quanHuyen )
		{
			$dauQuanHuyen = ', ';
		}
		
		if ( $phuongXa )
		{
			$dauPhuongXa = ', ';
		}
		
		if ( $duongPho )
		{
			$dauDuongPho = ', ';
		}
		
		return $soNha . $dauSoNha . $duongPho .	$dauDuongPho . $phuongXa . $dauPhuongXa . 
						$quanHuyen . $dauQuanHuyen . $tinhThanh;
	}
	
	function boSungThongTinBDS( $propertyList, $templatePath, $moduleId, $tempalateName=NULL )
	{
		$propertyListCount = count( $propertyList );
		
		for ( $i = 0; $i < $propertyListCount; $i++ )
		{
			// lay link va hinh anh thumbnail
			$tempImage = ilandCommonUtils::getPropertyThumbnail( $propertyList[$i]['id'] );
			$propertyList[$i]['image'] = $tempImage['min_url'];
			if ( empty( $propertyList[$i]['alias'] ) )
			{
				$propertyList[$i]['alias'] = unicode($propertyList[$i]['tieu_de']);
			}
			$propertyList[$i]['link'] = ilandCommonUtils::getPropertyLink( $propertyList[$i]['alias'], 
																			$propertyList[$i]['id'] );
			
			// lay template tien te
			$propertyList[$i]['tien_te_HTML'] = ilandCommonUtils::fetchCurrencyTemplate( 
																$propertyList[$i], $templatePath, $moduleId, $tempalateName );
			if ( !empty( $propertyList[$i]['ngay_dang'] ) )
			{
				$propertyList[$i]['ngay_dang'] = date( 'd-m-Y', $propertyList[$i]['ngay_dang'] );
			}
			if ( !empty( $propertyList[$i]['ngay_chinh_sua'] ) )
			{
				$propertyList[$i]['ngay_chinh_sua'] = date( 'd-m-Y', $propertyList[$i]['ngay_chinh_sua'] );
			}		
			
			$propertyList[$i]['dia_chi'] = ilandCommonUtils::ketHopDiaChi( $propertyList[$i]['so_nha'], 
													 $propertyList[$i]['duong_pho'],
													 $propertyList[$i]['phuong_xa'],
													 $propertyList[$i]['quan_huyen'],
													 $propertyList[$i]['tinh_thanh'] );
													 
			$propertyList[$i]['gia_m2'] = ilandCommonUtils::reFormatPrice($propertyList[$i]['gia_m2']);
			$propertyList[$i]['gia_nguyen_can'] = ilandCommonUtils::reFormatPrice($propertyList[$i]['gia_nguyen_can']);
			
			/*									 
			if($propertyList[$i]['don_vi_dien_tich_id']==1||$propertyList[$i]['don_vi_dien_tich_id']==3){
				$propertyList[$i]['gia_nguyen_can'] =  ilandCommonUtils::layGiaNguyenCan( array('dien_tich_su_dung'=>$propertyList[$i]['dien_tich_su_dung'],
											 									'gia'=>$propertyList[$i]['gia']) );
			}
			else if($propertyList[$i]['don_vi_dien_tich_id']==2||$propertyList[$i]['don_vi_dien_tich_id']==4){
				$propertyList[$i]['gia_m2'] =  ilandCommonUtils::layGiaM2( array('dien_tich_su_dung'=>$propertyList[$i]['dien_tich_su_dung'], 
											 									'gia'=>$propertyList[$i]['gia']) );
			}
			* 
			 */
			$propertyList[$i]['gia'] =  ilandCommonUtils::layGiaTien( array('don_vi_tien_id'=>$propertyList[$i]['don_vi_tien_id'], 
												'don_vi_dien_tich_id'=>$propertyList[$i]['don_vi_dien_tich_id'],
											 									'gia'=>$propertyList[$i]['gia']) );
			//$propertyList[$i]['gia'] = ilandCommonUtils::reFormatPrice($propertyList[$i]['gia']);
			$propertyList[$i]['luot_xem'] = ilandCommonUtils::demLuotXemBDS($propertyList[$i]['id']);
			 
		}
		return $propertyList;	
	}
	function layGiaNguyenCan($param){
		if($param['dien_tich_su_dung']==0){
			$gia='Thương lượng';
		}else{
			$gia=ilandCommonUtils::reFormatPrice($param['gia']*$param['dien_tich_su_dung']);
		}	
		return $gia;	
	}
	function layGiaM2($param){
		if($param['dien_tich_su_dung']==0){
			$gia='Thương lượng';
		}else{
			$gia=ilandCommonUtils::reFormatPrice(round(($param['gia']/$param['dien_tich_su_dung']),-3));
		}	
		return $gia;	
	}
	
	function boSungLuotXemBDS( $propertyList)
	{
		$propertyListCount = count( $propertyList );
		
		for ( $i = 0; $i < $propertyListCount; $i++ )
		{			
			$propertyList[$i]['luot_xem'] = ilandCommonUtils::demLuotXemBDS($propertyList[$i]['id']);
		}
		return $propertyList;	
	}
	
	function boSungThongTinDuAn( $projectList )
	{
		$projectListCount = count( $projectList );
		
		for ( $i = 0; $i < $projectListCount; $i++ )
		{
			// lay link va hinh anh thumbnail
			$projectList[$i]['luot_xem'] = ilandCommonUtils::demLuotXemDuAn($projectList[$i]['id']);
			
		}
		return $projectList;	
	}
	
	function layOrdering( $table )
	{
		$language = ilandCommonUtils::getLanguage();
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	    	
		switch ( $table )
		{
			case 'bat_dong_san':
				{
					$ordering = iland4_layDanhSachBDS($DBConfig, 'MAX(ordering) AS ordering', '1' ,1, 1, '', $language);
					break;
				}
			case 'du_an':
				{
					$ordering = iland4_layDanhSachDuAn($DBConfig, 'MAX(ordering) AS ordering', '1' ,1, 1, '', $language);
					break;
				}
		
			/*
			case 'nha_moi_gioi':
				{
//					$rows = $propertyModel->layDanhSachLoaiBatDongSan($language);
					$realtorData = $projectModel->laynhamoigioi($language);
					$rows = $realtorData[3];
				//	print_r($rows);
					// exit;
					break;
				}
			*/
			
		}
		
		$stt =  $ordering[3][0]['ordering'];
		if ( $stt == NULL )
		{
			$stt = 0;
		}
		
		return $stt+1;				
	}
	
	function layMaSo( $table='bat_dong_san' )
	{
		$language = ilandCommonUtils::getLanguage();
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	    	
		switch ( $table )
		{
			case 'bat_dong_san':
				{
					$value = iland4_layDanhSachBDS($DBConfig, 'MAX(id) AS id', '1' ,1, 1, '', $language);
					break;
				}
			case 'du_an':
				{
					$value = iland4_layDanhSachDuAn($DBConfig, 'MAX(id) AS id', '1' ,1, 1, '', $language);
					break;
				}			
		}
		
		$stt =  $value[3][0]['id'];
		if ( $stt == NULL )
		{
			$stt = 0;
		}
		
		return $stt+1;
	}
	
	function ktMaSo($id ,$ma_so='0' )
	{
		$language ='vi';// ilandCommonUtils::getLanguage(); vanganh fix
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	$condition="ma_so like '$ma_so'";
    	if($id!=''){
    		$condition="id!=$id and ".$condition;
    	}
		$value = iland4_layDanhSachBDS($DBConfig, 'id', $condition ,1, 10, '', $language);	
		//return $value;
		if ( count($value[3]) >= 1 )
			return 1;
		else
			return 0;
	}
	
/*
 * Description: Luot xem bds
 * Author: vanganh
 * Date create : 26-8-2011
 */	
	/*function themLuotXemBDS($bds_id='0')
	{		
		$result = 0;
		global $u_reGlobalConfig;
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		
		$iplifetime = (int) $u_reGlobalConfig['COMMON']['time_exprie_session'];
		$iplifetime	=	$iplifetime * 60;
		
		$ip = "0.0.0.0";
		if( !empty($_SERVER['REMOTE_ADDR']) ) $ip = $_SERVER['REMOTE_ADDR'];

		$now = time();
		
		$returnfield='count(*) as so_luong';
		//$returnfield='*';
		
		$condition = '1';
		$condition .= " AND ip = '" . $ip . "' ";
		$condition.= ' AND bds_id='.$bds_id;
		$condition.= ' AND (thoi_gian_xem + '.$iplifetime.') >= '.$now;
		
		$arr = iland4_layLuotXemBDS($DBConfig,$returnfield,$condition);
		if(empty($arr) || $arr[0]['so_luong']== '0')
		{
			$data = array (
				'bds_id' => $bds_id,
				'ip' => $ip,
				'thoi_gian_xem' => ''.$now
			);
			$paramfield= 'bds_id,ip,thoi_gian_xem';
			$result = iland4_themLuotXemBDS($DBConfig,$paramfield,$data);
		}		
		return $result;
		
	}*/
	
	function themLuotXemBDS( $bdsId, $luotXem )
	{
		global $u_reGlobalConfig;
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		
		// tinh so tang luot xem
		$luotXemStep = $u_reGlobalConfig['PROPERTY']['luot_xem_step'];
		if ( !empty( $luotXemStep ) && $luotXemStep > 1 )
		{
			// random tu 1 ... luot xem step
			$luotXemStep = rand( 1, $luotXemStep );
		}
		else 
		{
			$luotXemStep = 1;
		}
		
		// check SESSION
		$ip = $_SERVER['REMOTE_ADDR'];
		$session = JFactory::getSession();
		$ipSession = $session->get( 'bds_' . $bdsId );
		if ( empty( $ipSession ) || $ipSession != $ip )
		{
			if ( empty( $luotXem ) )
			{
				$luotXem = 1;
			}
			else 
			{
				$luotXem = $luotXem + 1;
			}
			
			$param = ' luot_xem = ' . $luotXem;
			// update property
			$propertyModel = new U_reModelProperties();
			$propertyModel->getUpdateProperties( $bdsId, $param, 'vi' );
			$session->set( 'bds_' . $bdsId, $ip);
		}
	}
		
	function demLuotXemBDS($bds_id='0', $initValue = 0)
	{
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		return iland4_demLuotXemBDS($DBConfig,$bds_id) + $initValue;
		/*
		$db = &JFactory::getDBO();
		$sql = "select luot_xem from iland4_bat_dong_san_vi where id = $bds_id";
		$db->setQuery($sql);
		$db->query();
		$row = $db->loadRow();
		return $row[0];
		*/
	}
	
/*
 * Description: Luot xem du an
 * Author: vanganh
 * Date create : 29-8-2011
 */
	/*function themLuotXemDuAn($du_an_id='0')
	{		
		$result = 0;
		global $u_reGlobalConfig;
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		
		$iplifetime = (int) $u_reGlobalConfig['COMMON']['time_exprie_session'];
		$iplifetime	=	$iplifetime * 60;
		
		$ip = "0.0.0.0";
		if( !empty($_SERVER['REMOTE_ADDR']) ) $ip = $_SERVER['REMOTE_ADDR'];

		$now = time();
		
		$returnfield='count(*) as so_luong';
		//$returnfield='*';
		
		$condition = '1';
		$condition .= " AND ip = '" . $ip . "' ";
		$condition.= ' AND du_an_id='.$du_an_id;
		$condition.= ' AND (thoi_gian_xem + '.$iplifetime.') >= '.$now;
		
		$arr = iland4_layLuotXemDuAn($DBConfig,$returnfield,$condition);
		
		
		
		if(empty($arr) || $arr[0]['so_luong']== '0')
		{
			$data = array (
				'du_an_id' => $du_an_id,
				'ip' => $ip,
				'thoi_gian_xem' => ''.$now
			);
			$paramfield= 'du_an_id,ip,thoi_gian_xem';
			
			// $result = iland4_themLuotXemDuAn($DBConfig,$paramfield,$data);
			// viet tam 1 ham de them du lieu xuong db
			$con = mysql_connect($DBConfig[0], $DBConfig[1], $DBConfig[2]);
			if (!$con)
			  {
			  die('Could not connect: ' . mysql_error());
			  }
			
			mysql_select_db($DBConfig[3], $con);
			
			$query = "INSERT INTO iland4_luot_xem_du_an VALUES (null, '" . $data['du_an_id'] . "',' 
							" . $data['ip'] . "', '" . $data['thoi_gian_xem'] . "')";
			
			mysql_query( $query );
			
			mysql_close($con);
			
			
		}		
		return $result;
		
	}*/
	
	function themLuotXemDuAn( $duAnId, $luotXem = 1 )
	{
		global $u_reGlobalConfig;
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		
		// tinh so tang luot xem
		$luotXemStep = $u_reGlobalConfig['PROJECT']['luot_xem_step'];
		if ( !empty( $luotXemStep ) && $luotXemStep > 1 )
		{
			// random tu 1 ... luot xem step
			$luotXemStep = rand( 1, $luotXemStep );
		}
		else 
		{
			$luotXemStep = 1;
		}
		
		// check SESSION
		$ip = $_SERVER['REMOTE_ADDR'];
		$session = JFactory::getSession();
		$ipSession = $session->get( 'duan_' . $duAnId );
		if ( empty( $ipSession ) || $ipSession != $ip )
		{
			if ( empty( $luotXem ) )
			{
				$luotXem = 1;
			}
			else 
			{
				$luotXem += $luotXemStep;
			}
			
			$param = ' luot_xem = ' . $luotXem;
			
			// update property
			$propertyModel = new U_reModelProjects();
			$propertyModel->updateProject( $duAnId, $param, 'vi' );
			$session->set( 'duan_' . $duAnId, $ip);
		}
	}
		
	function demLuotXemDuAn($du_an_id='0', $initValue = 100)
	{
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		return iland4_demLuotXemDuAn($DBConfig,$du_an_id) + $initValue;
	}
	
	
	function getCurrentPageURL() 
	{
		$pageURL = 'http://';
		
	 	if ( $_SERVER["SERVER_PORT"] != "80" ) 
	 	{
	  		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 	} 
	 	else 
	 	{
	  	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 	}
	 	return $pageURL;
	}
	
	function genConditionParam( $params )
	{
		if ( empty( $params ) )
		{
			return ' 1 AND 1 ';
		}
		$result = '1 AND 1 ';
		foreach ( $params as $key => $value )
		{
			$result .= ' AND ' . $key . '=' . $value;
		}
		return $result;
	}
	
	/*
	* Description: 
	* Author: Minh Chau
	* Version: 
	* Date create: 11-07-2011
	*/
	function fetchImageBlockTemplate( $templatePath, $templateName, $data = null )
	{
		// Xu li data truoc khi truyen du lieu vao template
		// Neu data = null return empty string
				
		if ( empty( $data ) )
		{
			return '';			
		} 
		
		$template = new JView();
		$template->addTemplatePath( $templatePath );
		$template->assignRef( 'data', $data );
		$template->setLayout( $templateName );		
		return $template->loadTemplate();
	}
	
	function stripWordContent( $text )
	{
		$result = $text;
		$str=1;
		$end=1;
		$flag=true;
		while($str!==false)
		{	
			$str=JString::strpos($result,'<!--');
			$end=JString::strpos($result,'[endif]-->');
			
			if($str!==false)
			{
				$delStr=JString::substr($result,$str,$end + 10 - $str);
				$result=str_replace($delStr,'', $result);
			}
			
		}
		return $result;
	}
	
	function layThoiGianConLai($thoi_han=0){
		
		$hom_nay=time();
		$tg_con_lai=$thoi_han-$hom_nay;
		
		$tg = Array();
		$tg['gio']=0;
		$tg['phut']=0;
		$tg['giay']=0;
		$tg['ngay'] = 0; 
		
		if($tg_con_lai>0){
			$tg['ngay'] = intval($tg_con_lai/(86400));
			$tg['gio']=intval($tg_con_lai/(3600));
			if($tg['gio']>0){
				$tg_con_lai=$tg_con_lai%3600;
			}	
			$tg['phut']=intval($tg_con_lai/(60));
			if($tg['phut']>0){
				$tg_con_lai=$tg_con_lai%60;
			}	
			$tg['giay']=$tg_con_lai;
		}
		if($tg['gio']<10){
			$tg['gio']='0'.$tg['gio'];
		}
		if($tg['phut']<10){
			$tg['phut']='0'.$tg['phut'];
		}
		if($tg['giay']<10){
			$tg['giay']='0'.$tg['giay'];
		}
		return $tg;
	}
	
	function xulyDuLieuDatCho($data)
	{
			if($data['gia_ban_le'] == '')
			{
				$data['gia_ban_le'] = 0;
			}
			if($data['gia_ban_si'] == '')
			{
				$data['gia_ban_si'] = 0;
			}
			if($data['han_mua'] == '')
			{
				$data['han_mua']=0;
			}
				
			if($data['gia_ban_le'] == 0 )
			{
				$data['tiet_kiem'] = 0;
			}
			else
			{
				$data['tiet_kiem'] = ( 100 * ( $data['gia_ban_le'] 
														- $data['gia_ban_si'] ) 
													) / $data['gia_ban_le'];
													
				if ( !is_int( $data['tiet_kiem'] ) )									
				$data['tiet_kiem'] = number_format( $data['tiet_kiem'], 1 );
				
			$data['thoi_gian_con_lai'] = ilandCommonUtils::layThoiGianConLai($data['han_mua']);
			$data['so_nguoi_dat'] = ilandCommonUtils::laySoNguoiDatCho($data['id']);
			$data['so_nguoi_con'] = $data['so_nguoi_mua_toi_thieu'] - $data['so_nguoi_dat']; 
			$data['link'] = ilandCommonUtils::layLinkChiTietDuAn($data['id']);
		}		
		return $data;
	}
	
	function layLinkChiTietDuAn( $id )
	{
		return "index.php?option=com_u_re&controller=projects&Itemid=236&id=" . $id;
	}
	
	function laySoNguoiDatCho($id)
	{
		$db	= & JFactory::getDBO();
		
		$dieu_kien = 'du_an_id=' . $id;
		$dieu_kien .= ' AND dat_cho=1';
		
		$query = 'SELECT COUNT(*) FROM #__thong_tin_dat_cho_du_an';
		$query .= ' WHERE '.$dieu_kien;		
		$db->setQuery($query);
		$items = $db->loadResult();
		return $items;
	}
	
	function fetchTemplateDatChoDuAn( $templatePath, $templateName, $data = null )
	{
		// Xu li data truoc khi truyen du lieu vao template
		// Neu data = null return empty string				
		if ( empty( $data ) )
		{
			return '';			
		} 
		
		$template = new JView();
		$template->addTemplatePath( $templatePath );
		$template->assignRef( 'status', $data['status'] );
		$template->assignRef( 'data', $data );
		$template->setLayout( $templateName );		
		return $template->loadTemplate();		
	}
	
	function fetchTemplateChiaSe( $templatePath, $templateName, $data = null )
	{
		$template = new JView();
		$template->addTemplatePath( $templatePath );
		if( !empty( $data ) )
		{
			$template->assignRef( 'data', $data );
		}
		$template->setLayout( $templateName );		
		return $template->loadTemplate();		
	}
	
	function loadModuleTimDuAn()
	{
		$modTimDuAn = JModuleHelper::getModule('tim_du_an', 'Tìm dự án'); 

        $attribs['style'] = 'raw';        
		$dataHTML = JModuleHelper::renderModule( $modTimDuAn, $attribs );
		
		return $dataHTML;
	}
	
	function getShortDescription( $content, $length )
	{
		if ( mb_strlen( $content, 'utf-8' ) < $length )
		{
			return $content;
		}
		$string = strip_tags(str_replace('[...]', '...', $content));
		$tempStr = mb_substr($string, 0, $length, 'utf-8'); 
		return mb_substr($tempStr, 0, mb_strrpos($tempStr, " ", -1, 'utf-8'), 'utf-8') . " ...";
	}
	
	// lay hinh anh dac biet
	function layHinhAnhDacBiet( $folderName )
	{
		return ilandCommonUtils::getImagesFromFolder( $folderName );
	} 
	
	// lay list hinh anh tu 1 thu muc
	function getImagesFromFolder( $folderName )
	{
		jimport('joomla.filesystem.folder');
		
		$folderPath = JPATH_ROOT . DS . $folderName;
		$uri = JURI::root();
		
		$images = '';
		
        if( JFolder::exists( $folderPath ) )
        {
            $filesList = JFolder::files( $folderPath );

            $images = array();
            foreach ( $filesList as $filename ) 
            {
            	$image = array();
            	$image['min_url'] = $uri . $folderName . 'min' . DS . $filename;
            	$image['preview_url'] = $uri . $folderName . 'preview' . DS . $filename;
            	$image['max_url'] = $uri . $folderName . 'large' . DS . $filename;
            	$image['org'] = $uri . $folderName . $filename;
            	$image['name'] = $filename;
            	
                $images[] = $image;
            }
        }
          
		return $images;
	}
	
	function layHinhAnhSoDoMatBang( $id, $type = 'property' )
	{
		$folderPath = 'images/' . $type . '/' . $id . '/sodomatbang/';
		return ilandCommonUtils::layHinhAnhDacBiet( $folderPath );
	}
	
	function layHinhAnhNoiThat( $id, $type = 'property' )
	{
		$folderPath = 'images/' . $type . '/' . $id . '/noithat/';
		return ilandCommonUtils::layHinhAnhDacBiet( $folderPath );
	}
	
	function layHinhAnhNgoaiThat( $id, $type = 'property' )
	{
		$folderPath = 'images/' . $type . '/' . $id . '/ngoaithat/';
		return ilandCommonUtils::layHinhAnhDacBiet( $folderPath );
	}
	
	// lay binh luan
	function getComment( $id, $topicName, $componentName = 'bds' )
	{
		// tieu de mod comment 
		$modCommentTitle = 'BÌNH LUẬN';
		
		$modComment = JModuleHelper::getModule('commentbox', $modCommentTitle);
		$modComment = JModuleHelper::getModule('commentbox'); 
		
		$modParams = 'id=' . $id . "\n\r" . 'component_name=' . $componentName . "\n\r" . 'sotin=10' . "\n\r" . 
						'topic_name=' . $topicName;
		$modComment->params = $modParams;
		
      $attribs['style'] = 'raw';
        
		$dataHTML = JModuleHelper::renderModule( $modComment, $attribs );
		return $dataHTML;
	}
	
	// module tim kiem bat dong san
	function getModuleTimKiemBDS( $moduleTitle )
	{
		// tieu de mod comment 
		//$modSearchTitle = 'TÌM KIẾM BẤT ĐỘNG SẢN TRANG CHI TIẾT';
		
		$modSearch = JModuleHelper::getModule('jea_search', $moduleTitle); 
		
		$modSearch->title = 'TÌM KIẾM BẤT ĐỘNG SẢN';
		$modSearch->showtitle = 1;
		
        $attribs['style'] = 'raw';
        
		$dataHTML = JModuleHelper::renderModule( $modSearch, $attribs );
		
		return $dataHTML;
	}
	
	function getModuleQuangCao( $moduleTitle )
	{
		$modSearch = JModuleHelper::getModule('custom', $moduleTitle); 
		
		$modSearch->title = 'QUẢNG CÁO BẤT ĐỘNG SẢN';
		$modSearch->showtitle = 0;
		
        $attribs['style'] = 'raw';
        
		$dataHTML = JModuleHelper::renderModule( $modSearch, $attribs );
		
		return $dataHTML;
	}
	function getChiaSe( $moduleTitle )
	{
		$modSearch = JModuleHelper::getModule('socialbds', $moduleTitle); 
		
		$modSearch->title = 'Chia sẻ';
		$modSearch->showtitle = 0;
		
        $attribs['style'] = 'raw';
        
		$dataHTML = JModuleHelper::renderModule( $modSearch, $attribs );
		
		return $dataHTML;
	}
}
?>
