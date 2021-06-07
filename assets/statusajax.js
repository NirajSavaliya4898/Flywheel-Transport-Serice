$url="statusajax.php";
		$(document).ready(function () {
			$(document).on("change","#status",function () {
	  			$registration_id=$(this).val();
				$data={action:"edstatus",registration_id:$registration_id};
				$.post($url,$data,function (result) {	
        		})
   		 	});
		});
