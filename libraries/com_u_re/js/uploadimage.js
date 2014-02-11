		function test()
		{
			alert('ddd');
		}		
        function UploadImg(obj)
        {
            var TotalExist = document.getElementById("CountImage").value;
            if(TotalExist == 0)
			{
				Limit = TotalImg;
			}
            else
			{
				Limit = TotalImg - TotalExis;
			}
			 if(parseInt(obj.name.substr(18,2)) < Limit)
            {
	            AddNewUploadControl(parseInt(obj.name.substr(18,2))+1);
				
	        }
	        else
	        {
	            alert("<?php echo JText::_('MAXIMUM_PICTURE_YOU_CAN_UPLOAD')." " ?>"+Limit);
	        }
        }
		