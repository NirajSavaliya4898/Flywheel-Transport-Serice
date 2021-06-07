
$(document).ready(function(){
$url="ajax.php";
    $(document).on("change","#Country",function(){
       $country_id=$(this).val();
       $("#State").html("<option selected >Loading...</option>");
       $data={action:"state_select",country_id:$country_id};

       $.post($url,$data,function (result) {
            $("#State").html(result);
       });
    });

    $data={action:"select_notification"};
   	$.post($url,$data,function (result) {
        $(".navbar-nav .dropdown .dropdown-menu .dropdown-list-content").html(result);
   	});

    $data1={action:"chk_notification"};
    $.post($url,$data1,function (result) {
        if (result==0) 
        {
            $(".chk_noti").removeClass('pulse');
        }else{
          $(".chk_noti").addClass('pulse');
        }
    });

    $(document).on("click",".noti-remove",function(){
        $notification_id=this.id;
         $data={action:"remove_notification",notification_id:$notification_id};
        $.post($url,$data,function (result) {
        });
    });

    function myFunction(){
        $data={action:"select_notification"};
        $.post($url,$data,function (result) {
            $(".navbar-nav .dropdown .dropdown-menu .dropdown-list-content").html(result);
        });

         $data1={action:"chk_notification"};
        $.post($url,$data1,function (result) {
            if (result==0) 
            {
                $(".chk_noti").removeClass('pulse');
            }else{
              $(".chk_noti").addClass('pulse');
            }
        });
    }
    var interval = setInterval(function () { myFunction(); },1000);

    $(document).on("change","#Admin_status",function () {

    $admin_login_id=$(this).val();
    $data={action:"Admin_status",admin_login_id:$admin_login_id};
        $.post($url,$data,function (result) {
        });
   });
    $(document).on("change","#Client_status",function () {

    $registration_id=$(this).val();
    $data={action:"Client_status",registration_id:$registration_id};
        $.post($url,$data,function (result) {
        });
   });
    $(document).on("change","#Business_status",function () {

    $business_id=$(this).val();
    $data={action:"Business_status",business_id:$business_id};
        $.post($url,$data,function (result) {
        });
   });

});