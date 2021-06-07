$(document).ready(function() {
	$url="ajax.php";
	$(document).on("click","#emailsub",function(){
		$val=$("#emailsubid").val();

		$data={action:"emailsub",email_id:$val};

		$.post($url,$data,function(result){
			$("#emailsubid").val("");
            $(".email-error").show();      	
			$(".email-error").html(result);      
		})
	
	});
	$(document).on("change","#Country",function () {
        $country_id=$(this).val();
        $("#State").html("<option selected hidden>Loading....</option>");
        $data={action:"state_select",country_id:$country_id};       
        $.post($url,$data,function (result) {
            $("#State").html(result);
        });
    });

   $(document).on("change","#State",function () {
        $state_id=$(this).val();
        $("#City").html("<option selected hidden>Loading....</option>");
        $data={action:"city_select",state_id:$state_id};       
        $.post($url,$data,function (result) {
            $("#City").html(result);
        });
    });
    $(document).on("change","#Main_Category",function () {
        $location_id=$(this).val();
        $("#Sub_Category").html("<option selected hidden>Loading....</option>");
        $data={action:"sub_category_select",location_id:$location_id};       
        $.post($url,$data,function (result) {
            $("#Sub_Category").html(result);
        });
    });

     $(document).on("change","#Main_Categorys",function () {
        $location_id=$(this).val();
        
       
        $data={action:"sub_category_checkbox",location_id:$location_id};       
        $.post($url,$data,function (result) {
            $("#Sub_Category").html(result);
        });
    });
    $(document).on("click",".remove_es",function () {
        $(".email-error").hide();
    });
});

function cancel_order(oid){
    

    if (confirm('Are You sure That You Want To Cancel This Order ?')) 
    {
        $data={action:"Cancel_order",order_id:$oid};       
        $.post('ajax.php',$data,function (result) {
            alert(result)
        }); 
    } 
}