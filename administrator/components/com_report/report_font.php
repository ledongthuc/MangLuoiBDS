<?php	 
	require_once  JPATH_ROOT.'/configuration.php';
	require_once  JPATH_ROOT.'/administrator/components/com_report/excel_xml.php';
	jimport( 'joomla.application.component.view' ); 
	JToolBarHelper::title( JText::_( 'Kết xuất báo cáo thị trường' ),'generic.png' ); 
	
	$config=new JConfig;
	mysql_connect('localhost',$config->user ,$config->password);
	mysql_select_db($config->db);
	mysql_query('SET NAMES "utf8"');
	$filename = JPATH_ROOT.'/administrator/components/com_report/files/report.zip';
	function renderTienich($tienich){
		$tienich_1 = explode(',', $tienich);
		array_pop($tienich_1);
		$tien_ich_array = array('1-1','1-2','1-3','1-4','1-5','1-6','1-7','1-8','1-9','1-10','1-11','1-13');    
		$tien_ich_item = array();
		for($i=0;$i<count($tien_ich_array);$i++){
			if(in_array($tien_ich_array[$i], $tienich_1)){ 
				array_push($tien_ich_item, 'y');
			}else{ 
				array_push($tien_ich_item, ' ');
			}
		}
		return $tien_ich_item;
	}
	
	function getNameuser($id){ 
		$sql = "select name from jos_users where id=$id";
		$db = JFactory::getDBO(); 
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadResult();
		if($result == '' ){
			$result = '';
		}
		return $result;		
	}
	
	function getEmailuser($id){
		$sql = "select email from jos_users where id=$id";
		$db = JFactory::getDBO(); 
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadResult();
		if($result == '' ){
			$result = '';
		}
		return $result;		
	}
	function getPhoneuser($id){
		$sql = "select phone from jos_users where id=$id";
		$db = JFactory::getDBO(); 
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadResult();
		if($result == '' ){
			$result = '';
		}else{
			$result = "'".$result;
		}
		return $result;		
	}
	function getOwneruser($id){
		$sql = "select chinh_chu from jos_users where id=$id";
		$db = JFactory::getDBO(); 
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadResult();
		if($result == '' ) {
			$result = 'Khách';
		}
		return $result;		
	}
	function getSpeakuser($id){
		$sql = "select speak_english from jos_users where id=$id";
		$db = JFactory::getDBO(); 
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadResult();
		if($result == '' ){
			$result = 'Khách';
		}
		return $result;		
	}
	function getQuanHuyen($id){
		$sql = "select ten from iland4_quan_huyen where id=$id";
		$db = JFactory::getDBO();
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadResult();
		return $result;		
	}
	function getData($id,$table){
		$sql = "select ten from ".$table." where id=$id";
		$db = JFactory::getDBO();
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadResult();
		return $result;		
	}
	function getDanhSachQH($quan){
		$quan = explode(',', $quan);
		$quan_huyen = '';
		for($i=0;$i<count($quan);$i++){
			if($i!=0){
				$phay = ', ';
			}
			$quan_huyen .= $phay.getQuanHuyen($quan[$i]);
		}
		return $quan_huyen;
	}
	
	function changeDayf($input){
		if ($input==0) return -1;
		$date = explode('/',$input);
		$day = $date[1].'/'.$date[0].'/'.$date[2];  
		return strtotime($day);
	}
	
	function changeDayt($input){
		if ($input==0) return 999999999999;
		$date = explode('/',$input);
		$day = $date[1].'/'.$date[0].'/'.$date[2];
		return strtotime($day)+86399;
	}
	function checkData($data){
		if(isset($data)){
			$dataout = $data;
		}else{
			$dataout = '';
		}
		return $dataout;
	}
	// render exel
	
		function renderExel($datas,$file_name){
			$i=0;
			$dataout = array();
			foreach($datas as $data) {
				$i++;			
				$dataout[$i]['maso'] = checkData($data->ma_so);
				$dataout[$i]['ngay_dang'] = date('d/m/Y',$data->ngay_dang);
				$dataout[$i]['email'] = getEmailuser(checkData($data->ma_nguoi_dang)); 
				$dataout[$i]['ten'] = getNameuser(checkData($data->ma_nguoi_dang));
				$dataout[$i]['phone'] = getPhoneuser(checkData($data->ma_nguoi_dang));
				if($data->chinh_chu==1){
					$dataout[$i]['chinh_chu'] = 'y';
				}else{
					$dataout[$i]['chinh_chu'] = '';
				}
				if($data->speak_english==1){
					$dataout[$i]['speak_english'] = 'y';
				}else{
					$dataout[$i]['speak_english'] = '';
				}
				
				$dataout[$i]['loai_giao_dich'] = checkData($data->loai_giao_dich);
				$dataout[$i]['loai_bds'] = checkData($data->loai_bds);
				$dataout[$i]['tinh_thanh'] = checkData($data->tinh_thanh);
				$dataout[$i]['quan_huyen'] = checkData($data->quan_huyen);
				$dataout[$i]['duong_pho'] = checkData($data->dia_chi);
				$dataout[$i]['thuoc_du_an'] = checkData($data->du_an);
				$dataout[$i]['gia_m2'] = number_format(checkData($data->gia_m2));
				$dataout[$i]['gia_m2_tu'] = ''; 
				$dataout[$i]['gia_m2_den'] = '';
				$dataout[$i]['gia_nguyen_can'] = number_format(checkData($data->gia_nguyen_can));
				$dataout[$i]['gia_nguyen_can_tu'] = '';
				$dataout[$i]['gia_nguyen_can_den'] = ''; 
				$dataout[$i]['don_vi_gia'] = checkData($data->don_vi_dien_tich);
				$dataout[$i]['phap_ly'] = checkData($data->phap_ly);
				$dataout[$i]['huong'] = checkData($data->huong);
				$dataout[$i]['dien_tich_san'] = checkData($data->dien_tich_khuon_vien);
				$dataout[$i]['dien_tich_san_tu'] = '';
				$dataout[$i]['dien_tich_san_den'] = '';
				$dataout[$i]['dien_tich_su_dung'] = checkData($data->dien_tich_su_dung);
				$dataout[$i]['dien_tich_su_dung_tu'] = '';
				$dataout[$i]['dien_tich_su_dung_den'] = '';
				$dataout[$i]['phong_tam'] = checkData($data->phong_tam);
				$dataout[$i]['phong_tam_tu'] = '';
				$dataout[$i]['phong_tam_den'] = '';
				$dataout[$i]['phong_ngu'] = checkData($data->phong_ngu);
				$dataout[$i]['phong_ngu_tu'] = '';
				$dataout[$i]['phong_ngu_den'] = '';
				$dataout[$i]['phong_khac'] = checkData($data->phong_khac);
				$dataout[$i]['so_tang'] = checkData($data->so_tang);
				$dataout[$i]['so_tang_tu'] = '';
				$dataout[$i]['so_tang_den'] = '';
				$tien_ich_item = renderTienich(checkData($data->tien_ich_id));
				$dataout[$i]['thich_hop_o'] = $tien_ich_item[0]; 
				$dataout[$i]['thich_hop_kd'] = $tien_ich_item[1];
				$dataout[$i]['thich_hop_sx'] = $tien_ich_item[2];
				$dataout[$i]['dau_xe'] = $tien_ich_item[3];
				$dataout[$i]['gan_truong'] = $tien_ich_item[4];
				$dataout[$i]['gan_cho'] = $tien_ich_item[5];
				$dataout[$i]['benh_vien'] = $tien_ich_item[6];
				$dataout[$i]['nhin_ra_vuon'] = $tien_ich_item[7];
				$dataout[$i]['an_ninh'] = $tien_ich_item[8];
				$dataout[$i]['ho_boi'] = $tien_ich_item[9];
				$dataout[$i]['san_tennis'] = $tien_ich_item[10];
				$dataout[$i]['cong_vien'] = $tien_ich_item[11];
			}		
			$excel = new excel_xml;
			$header_style = array(
			    'bold'       => 1,
			    'size'       => '12',
				'font'		 => 'Calibri',
			    'color'      => '#FFFFFF',
			    'bgcolor'    => '#4F81BD'
			);
			$excel->add_style('header', $header_style);
			$excel->add_row(array(
				'Mã số',
				'Ngày',
				'Email',
				'Tên',
				'Số điện thoại',
				'Chính chủ',
				'Speak english',
				'Loại giao dịch',
				'Loại bất động sản',
				'Tỉnh thành',
				'Quận huyện',
				'Đường phố',
				'Thuộc dự án',
				'Giá theo m2',
				'Giá theo m2 từ',
				'Giá theo m2 đến',
				'Giá nguyên căn',
				'Giá nguyên căn từ',
				'Giá nguyên căn đến',
				'Đơn vị giá',
				'Pháp lý',
				'Hướng',
				'Diện tích sàn',
				'Diện tích sàn từ',
				'Diện tích sàn đến',
				'Diện tích sử dụng',
				'Diện tích sử dụng từ',
				'Diện tích sử dụng đến',
				'Phòng tắm',
				'Phòng tắm từ',
				'Phòng tắm đến',
				'Phòng ngủ',
				'Phòng ngủ từ',
				'Phòng ngủ đến',
				'Phòng khác',
				'Số tầng',
				'Số tầng từ',
				'Số tầng đến',
				'Thích hợp ở',
				'Thích hợp kinh doanh',
				'Thích hợp sản xuất',
				'Chỗ đậu xe hơi',
				'Gần trường',
				'Gầnchợ/siêu thị',
				'Gần bệnh viện',
				'Nhìn ra vườn',
				'An ninh tốt',
				'Hồ bơi',
				'Sân tennis',
				'Gần công viên'
			),'header');
			foreach ($dataout as $k => $v){
                $excel->add_row ($v);
			}
			$excel->create_worksheet('Tin dang');
			$xml = $excel->generate();
			$excel->download($file_name);
		}
	
		function renderExelKyGui($datas,$file_name){
			$i=0;
			$dataout = array();
			foreach($datas as $data) {
				$i++;			
				$dataout[$i]['maso'] = '';
				$dataout[$i]['ngay_dang'] = date('d/m/Y',$data->ngay_dang);
				$dataout[$i]['email'] = $data->email; 
				$dataout[$i]['ten'] = getNameuser(checkData($data->user_id));
				if($dataout[$i]['ten']==''){
					$dataout[$i]['ten'] = checkData($data->name);
				}
				if(isset($data->phone)){
					$dataout[$i]['phone'] = "'".$data->phone;
				}else{
					$dataout[$i]['phone'] = '';
				}
				if($data->chinh_chu==1){
					$dataout[$i]['chinh_chu'] = 'y';
				}else{
					$dataout[$i]['chinh_chu'] = '';
				}
				if($data->speak_english==1){
					$dataout[$i]['speak_english'] = 'y';
				}else{
					$dataout[$i]['speak_english'] = '';
				}
				
				$dataout[$i]['loai_giao_dich'] = getData($data->loai_giao_dich_id,'iland4_loai_giao_dich_vi');
				$dataout[$i]['loai_bds'] = getData($data->loai_bds_id,'iland4_loai_bds_vi');
				$dataout[$i]['tinh_thanh'] = getData($data->tinh_thanh_id,'iland4_tinh_thanh');
				$dataout[$i]['quan_huyen'] = getDanhSachQH($data->quan_huyen_id);
				$dataout[$i]['duong_pho'] = checkData($data->dia_chi);
				$dataout[$i]['du_an']=getData($data->du_an_id,'iland4_du_an_vi');
				if($data->loai_gia_nc == 'nguyen_can'){
					$dataout[$i]['gia_m2'] ='';
					$dataout[$i]['gia_m2_tu']= '';
					$dataout[$i]['gia_m2_den']= ''; 
					$dataout[$i]['gia_nguyen_can']= "";
					$dataout[$i]['gia_nguyen_can_tu']= $data->muc_gia_tu;
					$dataout[$i]['gia_nguyen_can_den']= $data->muc_gia_den;
					if($data->loai_giao_dich_id==1){
						$dataout[$i]['don_vi_gia']= "nguyên căn";
					}else{
						$dataout[$i]['don_vi_gia']= "nguyên căn/th";
					}
				}else{
					$dataout[$i]['gia_m2']= "";
					$dataout[$i]['gia_m2_tu']=$data->muc_gia_tu;
					$dataout[$i]['gia_m2_den']=$data->muc_gia_den;
					$dataout[$i]['gia_nguyen_can'] = '';
					$dataout[$i]['gia_nguyen_can_tu']= "";
					$dataout[$i]['gia_nguyen_can_den']= "";
					if($data->loai_giao_dich_id==1){
						$dataout[$i]['don_vi_gia']= "m2";
					}else{
						$dataout[$i]['don_vi_gia']= "m2/th";
					}
				}
				$dataout[$i]['phap_ly'] = '';
				$dataout[$i]['huong']= getData($data->huong_id,'iland4_huong_vi');
				$dataout[$i]['dien_tich_khuon_vien']= '';
				$dataout[$i]['dien_tich_khuon_vien_tu']=$data->dien_tich_san_tu;
				$dataout[$i]['dien_tich_khuon_vien_den']=$data->dien_tich_san_den;		
				$dataout[$i]['dien_tich_su_dung'] = '';
				$dataout[$i]['dien_tich_su_dung_tu'] = '';
				$dataout[$i]['dien_tich_su_dung_den'] = '';
				$dataout[$i]['phong_tam']='';
				$dataout[$i]['phong_tam_tu']=$data->phong_tam_tu;
				$dataout[$i]['phong_tam_den']=$data->phong_tam_den;
				$dataout[$i]['phong_ngu']= '';
				$dataout[$i]['phong_ngu_tu']= $data->phong_tam_tu;
				$dataout[$i]['phong_ngu_den']= $data->phong_tam_den;
				$dataout[$i]['phong_khac'] = '';
				$dataout[$i]['so_tang'] = "";
				$dataout[$i]['so_tang_tu'] = $data->so_tang_tu;
				$dataout[$i]['so_tang_den'] = $data->so_tang_den;
				$tien_ich_item = renderTienich(checkData($data->tien_ich_id));
				$dataout[$i]['thich_hop_o'] = $tien_ich_item[0]; 
				$dataout[$i]['thich_hop_kd'] = $tien_ich_item[1];
				$dataout[$i]['thich_hop_sx'] = $tien_ich_item[2];
				$dataout[$i]['dau_xe'] = $tien_ich_item[3];
				$dataout[$i]['gan_truong'] = $tien_ich_item[4];
				$dataout[$i]['gan_cho'] = $tien_ich_item[5];
				$dataout[$i]['benh_vien'] = $tien_ich_item[6];
				$dataout[$i]['nhin_ra_vuon'] = $tien_ich_item[7];
				$dataout[$i]['an_ninh'] = $tien_ich_item[8];
				$dataout[$i]['ho_boi'] = $tien_ich_item[9];
				$dataout[$i]['san_tennis'] = $tien_ich_item[10];
				$dataout[$i]['cong_vien'] = $tien_ich_item[11];
			}		
			$excel = new excel_xml;
			$header_style = array(
			    'bold'       => 1,
			    'size'       => '12',
				'font'		 => 'Calibri',
			    'color'      => '#FFFFFF',
			    'bgcolor'    => '#4F81BD'
			);
			$excel->add_style('header', $header_style);
			$excel->add_row(array(
				'Mã số',
				'Ngày',
				'Email',
				'Tên',
				'Số điện thoại',
				'Chính chủ',
				'Speak english',
				'Loại giao dịch',
				'Loại bất động sản',
				'Tỉnh thành',
				'Quận huyện',
				'Đường phố',
				'Thuộc dự án',
				'Giá theo m2',
				'Giá theo m2 từ',
				'Giá theo m2 đến',
				'Giá nguyên căn',
				'Giá nguyên căn từ',
				'Giá nguyên căn đến',
				'Đơn vị giá',
				'Pháp lý',
				'Hướng',
				'Diện tích sàn',
				'Diện tích sàn từ',
				'Diện tích sàn đến',
				'Diện tích sử dụng',
				'Diện tích sử dụng từ',
				'Diện tích sử dụng đến',
				'Phòng tắm',
				'Phòng tắm từ',
				'Phòng tắm đến',
				'Phòng ngủ',
				'Phòng ngủ từ',
				'Phòng ngủ đến',
				'Phòng khác',
				'Số tầng',
				'Số tầng từ',
				'Số tầng đến',
				'Thích hợp ở',
				'Thích hợp kinh doanh',
				'Thích hợp sản xuất',
				'Chỗ đậu xe hơi',
				'Gần trường',
				'Gầnchợ/siêu thị',
				'Gần bệnh viện',
				'Nhìn ra vườn',
				'An ninh tốt',
				'Hồ bơi',
				'Sân tennis',
				'Gần công viên'
			),'header');
			foreach ($dataout as $k => $v){
                $excel->add_row ($v);
			}
			$excel->create_worksheet('Ky Gui');
			$xml = $excel->generate();
			$excel->download($file_name);
		}
	
	
	
	
	
	
	if (isset($_POST['submit'])){
	        $zip = new ZipArchive();				
		if (!$zip->open($filename, ZIPARCHIVE::CREATE)){
			exit("cannot open <$filename>\n");
		}	
		if (isset($_POST['tindang'])) {
			$tu_ngay = changeDayf($_POST['tu_ngay_dang_bds']);
			$den_ngay = changeDayt($_POST['den_ngay_dang_bds']);
			
			$file=''; 
			$cmd="SELECT *
				FROM `iland4_bat_dong_san_vi` 
				WHERE ngay_dang>$tu_ngay AND ngay_dang<$den_ngay 
				ORDER BY ngay_dang ASC";
		    $db = &JFactory::getDBO(); 
			$db->setQuery($cmd);
			$db->query(); 
			$datas = $db->loadObjectList();
			renderExel($datas,'mlbds_tin_dang.xls');
		}
		
		if (isset($_POST['kygui'])) {
			$tu_ngay = changeDayf($_POST['tu_ngay_ky_gui']); 
			$den_ngay = changeDayt($_POST['den_ngay_ky_gui']); 
			$file='';
			$cmd="SELECT *
			FROM jos_yeu_cau_bds
			WHERE ngay_dang>$tu_ngay
			AND ngay_dang<$den_ngay 
			ORDER BY ngay_dang ASC";
			
			$db = &JFactory::getDBO();
			$db->setQuery($cmd);
			$db->query();
			$datas = $db->loadObjectList();
			renderExelKyGui($datas, 'mlbds_ky_gui_bds');
		} 
		
		if (isset($_POST['timkiem'])) {
			$tu_ngay = changeDayf($_POST['tu_ngay_tim_kiem']);
			$den_ngay = changeDayt($_POST['den_ngay_tim_kiem']);
			$file='';
			$cmd="SELECT *
			FROM jos_tim_kiem_bds
			WHERE ngay_dang>$tu_ngay
			AND ngay_dang<$den_ngay 
			ORDER BY ngay_dang ASC";
			
			$db = &JFactory::getDBO();
			$db->setQuery($cmd);
			$db->query();
			$datas = $db->loadObjectList();
			renderExelKyGui($datas, 'mlbds_tim_kiem_bds');
		}
		if (isset($_POST['bantin'])){
			
			$tu_ngay = changeDayf($_POST['tu_ngay_nhan_ky_gui']);
			$den_ngay = changeDayt($_POST['den_ngay_nhan_ky_gui']); 
			
			$file='';
			$cmd="SELECT * FROM `jos_yeu_cau_bds` WHERE nhan_mail=1 AND ngay_dang>$tu_ngay AND ngay_dang<$den_ngay ORDER BY ngay_dang ASC";
			$db = &JFactory::getDBO();
			$db->setQuery($cmd);
			$db->query();
			$datas = $db->loadObjectList();
			renderExelKyGui($datas, 'mlbds_danh_sach_nhan_mail_ycbds.xls');	
		}
		///alltv
		if (isset($_POST['alltv'])) { 
			$db = JFactory::getDBO();
			
			$tu_ngay = changeDayf($_POST['tu_ngay_dang_ky']);
			$den_ngay = changeDayt($_POST['den_ngay_dang_ky']); 
			
			$query = "SELECT * FROM `jos_users` WHERE UNIX_TIMESTAMP(registerDate)>$tu_ngay AND UNIX_TIMESTAMP(registerDate)<$den_ngay ORDER BY UNIX_TIMESTAMP(registerDate) ASC";
			$db->setQuery($query);   
			$row = $db->loadObjectList();
			$dem=0;
			$time=time();  
			foreach($row as $info) {
				$dem++; 
				$data[$dem]['email']=$info->email;
				$data[$dem]['name']=$info->name;
				$data[$dem]['address']=$info->address;
				$data[$dem]['phone']="'".$info->phone; 
				$data[$dem]['usertype']=$info->usertype; 
				$data[$dem]['registerDate']=$info->registerDate;
				$data[$dem]['chinh_chu']=$info->chinh_chu;
				if($data[$dem]['chinh_chu']==1){
					$data[$dem]['chinh_chu'] = 'y';
				}else{
					$data[$dem]['chinh_chu']='';
				}
				$data[$dem]['speak_english']=$info->speak_english;
				if($data[$dem]['speak_english']==1){
					$data[$dem]['speak_english'] = 'y';
				}else{
					$data[$dem]['speak_english']='';
				}
				$data[$dem]['nhan_mail']=$info->nhan_mail;
				if($data[$dem]['nhan_mail']==1){
					$data[$dem]['nhan_mail'] = 'y';
				}else{
					$data[$dem]['nhan_mail']='';
				}
			}		
			$excel = new excel_xml;     
			$header_style = array(
			    'bold'       => 1,
			    'size'       => '12', 
				'font'		 => 'Calibri',
			    'color'      => '#FFFFFF',
			    'bgcolor'    => '#4F81BD'
			);
			$excel->add_style('header', $header_style);
			$excel->add_row(array(
					'Email',
					'Tên',
					'Địa chỉ', 
					'Điện thoại', 
					'Nhóm',
					'Ngày đăng ký',
					'Chính chủ',
					'Speak English',
					'Nhận báo cáo hàng tháng'
				),  'header');
			foreach ($data as $k => $v){
                $excel->add_row ($v); 
			} 
			$excel->create_worksheet('Danh sach thanh vien');
			$xml = $excel->generate();
			$excel->download('mlbds_danh_sach_thanh_vien.xls');

		}
		////
		
		if (isset($_POST['thitruong'])) { 
			$db = JFactory::getDBO();
			    
			$tu_ngay = changeDayf($_POST['tu_ngay_nhan_ky_gui']);
			$den_ngay = changeDayt($_POST['den_ngay_nhan_ky_gui']);  
			 
			$query = "SELECT * FROM `jos_users` WHERE nhan_mail=1 AND UNIX_TIMESTAMP(registerDate)>$tu_ngay AND UNIX_TIMESTAMP(registerDate)<$den_ngay ORDER BY UNIX_TIMESTAMP(registerDate) ASC"; 
			$db->setQuery($query); 
			$row = $db->loadObjectList();
			$dem=0;
			$time=time();  
			foreach($row as $info) {
				$dem++; 
				$data[$dem]['email']=$info->email;
				$data[$dem]['name']=$info->name;
				$data[$dem]['address']=$info->address;
				$data[$dem]['phone']="'".$info->phone; 
				$data[$dem]['usertype']=$info->usertype;
				$data[$dem]['registerDate']=$info->registerDate;
				$data[$dem]['chinh_chu']=$info->chinh_chu;
				if($data[$dem]['chinh_chu']==1){
					$data[$dem]['chinh_chu'] = 'y';
				}else{
					$data[$dem]['chinh_chu']='';
				}
				$data[$dem]['speak_english']=$info->speak_english;
				if($data[$dem]['speak_english']==1){
					$data[$dem]['speak_english'] = 'y';
				}else{
					$data[$dem]['speak_english']='';
				}
				$data[$dem]['nhan_mail']=$info->nhan_mail;
				if($data[$dem]['nhan_mail']==1){
					$data[$dem]['nhan_mail'] = 'y';
				}else{
					$data[$dem]['nhan_mail']='';
				}
			}		
			$excel = new excel_xml; 
			$header_style = array(
			    'bold'       => 1,
			    'size'       => '12', 
				'font'		 => 'Calibri',
			    'color'      => '#FFFFFF',
			    'bgcolor'    => '#4F81BD'
			);
			$excel->add_style('header', $header_style);
			$excel->add_row(array(
					'Email',
					'Tên',
					'Địa chỉ', 
					'Điện thoại', 
					'Nhóm',
					'Ngày đăng ký',
					'Chính chủ',
					'Speak English',
					'Nhận báo cáo hàng tháng'					
				),  'header');
			foreach ($data as $k => $v) {
                $excel->add_row ($v); 
			} 
			$excel->create_worksheet('Bao cao thi truong');
			$xml = $excel->generate();
			$excel->download('mlbds_danh_sach_nhan_bao_cao_thi_truong.xls');

		} 
		if (isset($_POST['muaquyen'])) {  
			$db = JFactory::getDBO();
			
			$tu_ngay = changeDayf($_POST['tu_ngay_nhan_ky_gui']);
			$den_ngay = changeDayt($_POST['den_ngay_nhan_ky_gui']); 
			
			$query = "SELECT * FROM `jos_history` LEFT JOIN `jos_users` ON jos_history.userid=jos_users.id WHERE jos_history.time>$tu_ngay AND  jos_history.time<$den_ngay ORDER BY jos_history.time ASC";
			$db->setQuery($query); 
			$row = $db->loadObjectList();
			$dem=0;
			$time=time();  
			foreach($row as $info) {
				$db->setQuery('SELECT * FROM `jos_users` WHERE id='.$info->userid);
				$info2=$db->loadAssoc(); 
				$db->setQuery('SELECT * FROM `jos_core_acl_aro_groups`  WHERE id='.$info2['gid']);
				$info3=$db->loadAssoc(); 	 
				$dem++;
				$data[$dem]['id']=$info->id;
				$data[$dem]['user']=$info2['name'];
				$data[$dem]['email']=$info2['email'];
				$data[$dem]['group']=$info3['name']; 
				$data[$dem]['method']=$info->method; 
				$data[$dem]['time']=date('d.m.Y H:i:s',$info->time); 
				$daytin=explode('|',$info->daytin);
				$danhdau=explode('|',$info->danhdau);
				$noibat=explode('|',$info->noibat);
				$data[$dem]['daytin']=$daytin[0].'x'.$daytin[1];
				$data[$dem]['danhdau']=$danhdau[0].'x'.$danhdau[1];
				$data[$dem]['noibat']=$noibat[0].'x'.$noibat[1];
				$data[$dem]['tongcong']=$info->tongcong;
			}		
			$excel = new excel_xml; 
			$header_style = array(
			    'bold'       => 0,
			    'size'       => '12', 
				'font'		 => 'Calibri',
			    'color'      => '#FFFFFF',
			    'bgcolor'    => '#4F81BD' 
			);
			$excel->add_style('header', $header_style);
			$excel->add_row(array(
					'Mã số',
					'Tên',
					'Email',
					'Nhóm', 
					'Phương thức thanh toán', 
					'Thời gian',
					'Đẩy tin',
					'Đánh dấu',
					'Nổi bật',
					'Chi phí thanh toán'					
				),  'header');
			foreach ($data as $k => $v) {
                $excel->add_row ($v); 
			} 
			$excel->create_worksheet('Lich_su_mua_quyen');
			$xml = $excel->generate(); 
			$excel->download('mlbds_lich_su_mua_quyen.xls');
		}
		if (isset($_POST['hengio'])) {
			$db = JFactory::getDBO(); 
			 
			$tu_ngay = changeDayf($_POST['tu_ngay_nhan_ky_gui']); 
			$den_ngay = changeDayt($_POST['den_ngay_nhan_ky_gui']); 
			
			$query = "SELECT * FROM  `jos_push` WHERE date>$tu_ngay AND date<$den_ngay ORDER BY date ASC";			
			$db->setQuery($query); 
			$row = $db->loadObjectList();  
			$dem=0;
			$time=time();  
			foreach($row as $info) {
					$db->setQuery('SELECT * FROM `iland4_bat_dong_san_vi` WHERE id='.$info->bds);
					$info2=$db->loadAssoc();
					$db->setQuery('SELECT * FROM	`jos_users` WHERE id='.$info->user);
					$info3=$db->loadAssoc();	
					$dem++; 
					$data[$dem]['id']=$info->id;
					$data[$dem]['matin']=$info2['id'];
					$data[$dem]['username']=$info3['username'];
					$data[$dem]['tieude']=$info2['tieu_de'];
					if ($info->type==1) $data[$dem]['loaitin']='Đẩy tin'; else
						if ($info->type==2) $data[$dem]['loaitin']='Đánh dấu';
							else $data[$dem]['loaitin']='Nổi bật';  
					$data[$dem]['start']=date("H:i d-m-Y",$info->start);
					$data[$dem]['end']=date("H:i d-m-Y",$info->start); 
					$data[$dem]['date']=date("H:i d-m-Y",$info->date); 
					
					if ($info->end<$time) $data[$dem]['status']='Đã hoàn tất'; 
						else if ($info->start>$time) $data[$dem]['status']='Đang chờ'; 
							else 
								if ($info->type==1) $data[$dem]['status']='Đã hoàn tất'; 
									else $data[$dem]['status']='Hoạt động';
			}		
			$excel = new excel_xml; 
			$header_style = array(
			    'bold'       => 0,
			    'size'       => '12', 
				'font'		 => 'Calibri',
			    'color'      => '#FFFFFF',
			    'bgcolor'    => '#4F81BD'
			);
			$excel->add_style('header', $header_style);
			$excel->add_row(array(
					'ID',
					'Mã tin',
					'Người đăng',
					'Tiêu đề tin đăng',
					'Loại tin',
					'Ngày bắt đầu',
					'Ngày kết thúc',
					'Ngày cập nhật',
					'Trạng thái'					
				),  'header'); 
			foreach ($data as $k => $v) { 
                $excel->add_row ($v); 
			} 
			$excel->create_worksheet('Lich_su_hen_gio');
			$xml = $excel->generate();
			$excel->download('mlbds_lich_su_hen_gio.xls');

		}
		
		
		
		
		/*
		$zip->close();	
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=report.zip");
		header("Content-Type: application/zip");
		header("Content-Transfer-Encoding: binary");
		readfile($filename);		
		unlink($filename);
		*/  
	}  
?>
<!-- 
<form method="POST"> 
	<input type="checkbox" name="tindang"/>Danh sách tất cả tin đăng <br/>
	<input type="checkbox" name="kygui"/>Danh sách tất cả các yêu cầu<br/>
	<input type="checkbox" name="timkiem"/>Danh sách tất cả các tìm kiếm<br/>
	<input type="checkbox" name="bantin"/>Danh sách tất cả user đăng ký nhận bản tin<br/><br/>  
	<input type="submit" name="submit" value="Download"/>	
	<input name="option" value="com_report" type="hidden">
	<input type="hidden" name="format" value="raw" />
</form>
-->

<table>
		<tr>
			<td width="100%">
			</td>
			<td nowrap="nowrap">
			</td>
		</tr>
	</table>
	<table class="adminlist" cellpadding="1">
		<thead>
			<tr>
				<th width="2%" class="title">STT</th>
				<th width="10%" class="title" nowrap="nowrap">	Chọn	</th>	
				<th width="30%" class="title">Loại báo cáo</th>
				<th width="20%" class="title">Từ ngày (Ex:22/10/2012)</th>	
				<th width="20%" class="title" >	Đến ngày (Ex:22/10/2012)</th>
				<th width="5%" class="title" nowrap="nowrap">	Export	</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="6">
				</td>
			</tr>
		</tfoot>
		<tbody>
		<form method="POST"> 
			<tr class="row0">
				<td>1</td>
				<td align="center"><input type="checkbox" name="zip_bds"/></td>	
				<td>Danh sách tin đăng bất động sản</td>				
				<td><input type="text" name="tu_ngay_dang_bds"/></td>
				<td><input type="text" name="den_ngay_dang_bds"/></td>
				<td align="center">	<input type="submit" name="submit" value="Export"/>	</td>
				<input name="option" value="com_report" type="hidden">
				<input type="hidden" name="format" value="raw" />
				<input type="hidden" name="tindang" value="1" />
			</tr>
		</form>
		<form method="POST"> 
			<tr class="row1">
				<td>2</td>
				<td align="center"><input type="checkbox" name="zip_ky_gui"/></td>	
				<td>Danh sách yêu cầu bất động sản</td>				
				<td><input type="text" name="tu_ngay_ky_gui"/></td>
				<td><input type="text" name="den_ngay_ky_gui"/></td>
				<td align="center">	<input type="submit" name="submit" value="Export"/>	</td>
				<input type="hidden" name="kygui" value="1" />
			</tr>
		</form>
		<form method="POST"> 
			<tr class="row1">
				<td>3</td>
				<td align="center"><input type="checkbox" name="zip_nhan_ky_gui"/></td>	
				<td>Danh sách nhận mail yêu cầu bất động sản</td>				
				<td><input type="text" name="tu_ngay_nhan_ky_gui"/></td>
				<td><input type="text" name="den_ngay_nhan_ky_gui"/></td>
				<td align="center">	<input type="submit" name="submit" value="Export"/>	</td>
				<input type="hidden" name="bantin" value="1" />
			</tr>
		</form>
		<form method="POST"> 
			<tr class="row0">
				<td>4</td>
				<td align="center"><input type="checkbox" name="zip_tim_kiem"/></td>
				<td>Danh sách tìm kiếm bất động sản</td>				
				<td><input type="text" name="tu_ngay_tim_kiem"/></td>
				<td><input type="text" name="den_ngay_tim_kiem"/></td>
				<td align="center">	<input type="submit" name="submit" value="Export"/>	</td>
				<input name="option" value="com_report" type="hidden">
				<input type="hidden" name="format" value="raw" />
				<input type="hidden" name="timkiem" value="1" />
			</tr>
		</form>
		<form method="POST"> 
			<tr class="row1">
				<td>5</td>
				<td align="center"><input type="checkbox" name="zip_danh_sach_all_thanh_vien"/></td>	
				<td>Danh sách tất cả thành viên</td>				
				<td><input type="text" name="tu_ngay_dang_ky"/></td>
				<td><input type="text" name="den_ngay_dang_ky"/></td>
				<td align="center">	<input type="submit" name="submit" value="Export"/>	</td>
				<input type="hidden" name="alltv" value="1" />
			</tr>
		</form>	
		
		<form method="POST"> 
			<tr class="row1">
				<td>6</td>
				<td align="center"><input type="checkbox" name="zip_nhan_ky_gui"/></td>	
				<td>Danh sách đăng ký nhận báo cáo thị trường</td>				
				<td><input type="text" name="tu_ngay_nhan_ky_gui"/></td>
				<td><input type="text" name="den_ngay_nhan_ky_gui"/></td>
				<td align="center">	<input type="submit" name="submit" value="Export"/>	</td>
				<input type="hidden" name="thitruong" value="1" />
			</tr>
		</form>		
		<form method="POST"> 
			<tr class="row1">
				<td>7</td>
				<td align="center"><input type="checkbox" name="zip_nhan_ky_gui"/></td>	
				<td>Lịch sử hẹn giờ</td>				
				<td><input type="text" name="tu_ngay_nhan_ky_gui"/></td>
				<td><input type="text" name="den_ngay_nhan_ky_gui"/></td>
				<td align="center">	<input type="submit" name="submit" value="Export"/>	</td>
				<input type="hidden" name="hengio" value="1" /> 
			</tr>
		</form>    
		<form method="POST">   
			<tr class="row1">
				<td>8</td>
				<td align="center"><input type="checkbox" name="zip_nhan_ky_gui"/></td>	
				<td>Lịch sử mua quyền</td>				
				<td><input type="text" name="tu_ngay_nhan_ky_gui"/></td>
				<td><input type="text" name="den_ngay_nhan_ky_gui"/></td>
				<td align="center">	<input type="submit" name="submit" value="Export"/>	</td>
				<input type="hidden" name="muaquyen" value="1" />
			</tr>
		</form>
		</tbody>
	</table>
