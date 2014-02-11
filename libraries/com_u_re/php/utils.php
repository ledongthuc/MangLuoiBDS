<?php

/*
 * Defines utils for com ure
 */

class U_ReUtils
{
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
		$propertyImagePath = $u_reGlobalConfig['IMAGE']['property_image_path'];
		
		$image = array();
		$image['preview_url'] = $propertyImagePath . '/' . $propertyId . '/' .
										$u_reGlobalConfig['IMAGE']['property_image_preview_name'];
		$image['min_url'] = $propertyImagePath . '/' . $propertyId . '/' .
										$u_reGlobalConfig['IMAGE']['property_image_min_name'];
		$image['max_url'] = $propertyImagePath . '/' . $propertyId . '/' .
										$u_reGlobalConfig['IMAGE']['property_image_max_name'];
		$image['alt'] = '';
		$image['title'] = '';
		
		return $image;
	}
	
	/*
	* Description: Lấy hình ảnh thumbnail
	* Author: Minh Chau
	* Version:
	* Date create: 23-03-2011
	* @return: Đường dẫn hình ảnh thumbnail
	*/
	function getPropertyThumbnail( $propertyId )
	{
		// TODO:
		return '';
	}
	
	function getPropertySubImages( $propertyId )
	{
		// TODO: set alt & title for SEO advance
		
		global $u_reGlobalConfig;
		$dir = $u_reGlobalConfig['IMAGE']['property_image_path'] . '/' . $propertyId . '/' .
									$u_reGlobalConfig['IMAGE']['property_image_secondary_dir_name'];
		
		//secondaries images
        $images = array();
        
        jimport('joomla.filesystem.folder');
       
        if( JFolder::exists( $dir ) ){
                
            $filesList = JFolder::files( $dir );

            $viewfilesList = array();
            foreach ( $filesList as $filename ) {
					
                $detail = array();
                $detail['title'] = '';
                $detail['alt'] = '';
                $detail['max_url'] = $dir . $filename;
                $detail['preview_url'] = $dir . '/preview/' . $filename;
                $detail['min_url'] = $dir . '/min/' . $filename ;
                    
                $viewfilesList[] = $detail ;
            }
            
            $images =  $viewfilesList ;
        }
		return $images;
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
//			$offset = $page * $limit - $limit;
			$offset = ( $page - 1 ) * $limit;
		}
		return $offset;
		
//		return array( 'offset' => $offset, 'limit' => $limit );
	}
	
	
};

?>