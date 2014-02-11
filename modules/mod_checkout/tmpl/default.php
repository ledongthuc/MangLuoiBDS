
<!-- SAMPLE DATA ^^ -->
<input type="hidden" id="price" value="2000000"/>
<input type="hidden" id="order" value="ABSDCEM"/>
<input type="hidden" id="tax" value="340"/>
<input type="hidden" id="ship" value="12000"/>
<input type="hidden" id="detail" value="Mô tả đơn đặt hàng"/>


<?php
	$user =& JFactory::getUser();
	$service=array('nganluong','baokim','paypal');
	foreach ($service as $value)
	if ($params->get($value)==1) include(JPATH_SITE.DS.'modules'.DS.'mod_checkout'.DS.'tmpl'.DS.$value.'.php');	
?>