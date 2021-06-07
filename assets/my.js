$(document).ready(function(){
    $lockFlag=0;
 /*   $(document).on("click",".hs-pass",function () {

        if($lockFlag==0){
            $(this).removeClass("fa-lock");
            $(this).addClass("fa-unlock");

            $(".hs-control").attr("type","text");

            $lockFlag=1;
        }else{
            $(this).addClass("fa-lock");
            $(this).removeClass("fa-unlock");
            $(".hs-control").attr("type","password");
            $lockFlag=0;
        }
    });*/


    $(document).on("mouseover",".hs-pass",function () {
        $(this).removeClass("fa-eye");
        $(this).addClass("fa-eye-slash");

        $(".hs-control").attr("type","text");
    });


    $(document).on("mouseout",".hs-pass",function () {
        $(this).addClass("fa-eye");
        $(this).removeClass("fa-eye-slash");
        $(".hs-control").attr("type","password");
    });



});