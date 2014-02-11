<!-- Template co 3 cot trinh bay giong nhu nhaban24h.com 500px-300px-180px -->
<div id="bigcontent"><!-- content-->
            <div id="possearch"> <!-- vị trí hiện thì module tìm kiếm -->
          	  <jdoc:include type="modules" name="possearch" style="raw" />
            </div><!-- vị trí hiện thì module tìm kiếm -->
            <div id="wrapper">
            <div id="warpperlr">
            	<div id="left-warpperlr">
               <jdoc:include type="modules" name="left-warpperlr" style="raw" />
                </div>
                <div id="right-warpperlr">
       <jdoc:include type="modules" name="right-warpperlr" style="raw" />
                </div>
            </div>
            	<div id="leftwrapper"> <!-- div lớn chứa nội dung bên trái -->
                	<div id="news-left">
                    <jdoc:include type="modules" name="cot1" style="raw" />
                    </div>
                    <div id="news-right">
                     <jdoc:include type="modules" name="left-warpperlr" style="raw" />
                    <jdoc:include type="modules" name="cot2" style="raw" />
                    </div>
                </div> <!-- div lớn chứa nội dung bên trái-->
                <div id="rightwrapper"> <!--div lớn chứa nội dung bên phải-->
            <jdoc:include type="modules" name="cot3" style="raw" />
                </div> <!--div lớn chứa nội dung bên phải-->
            </div> <!-- div lớn bao bọc các div nhỏ, nếu nhu có phân chia cột -->
    <div style="clear:both;">
     <?php if( JRequest::getVar( 'view' ) == 'frontpage' ) { 
														// ban dang o trang chu
                                                            // thuc hien bat cu cong viec gi ban muon
														?>
                                                            
                                                        <?php } else {
														// ban khong o trang chu
                                                            // hien thi main body binh thuong
														 ?>
                          
	
			<jdoc:include type="message" />

			
    		<jdoc:include type="component" />
											 
			<?php } ?>
    </div>
        </div>