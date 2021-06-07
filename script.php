<script src="assets/js/jquery.min.js"></script>


<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>

			<script type="text/javascript">
			$(document).ready( function(){
			$.ajax({
		          url: 'payment.php',
		          type: 'post',
		          data: JSON.stringify({ 
		            key: $('#key').val(),
					salt: $('#salt').val(),
					txnid: $('#txnid').val(),
					amount: $('#amount').val(),
				    pinfo: $('#pinfo').val(),
		            fname: $('#fname').val(),
					email: $('#email').val(),
					mobile: $('#mobile').val(),
					udf5: $('#udf5').val()
		          }),
				  contentType: "application/json",
		          dataType: 'json',
		          success: function(json) {
		            if (json['error']) {
					 $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
		            }
					else if (json['success']) {	
						$('#hash').val(json['success']);
		            }
		          }
		        }); 
			});
			</script>
<script type="text/javascript">
function launchBOLT()
{
	
	bolt.launch({
	key: $('#key').val(),
	txnid: $('#txnid').val(), 
	hash: $('#hash').val(),
	amount: $('#amount').val(),
	firstname: $('#fname').val(),
	email: $('#email').val(),
	phone: $('#mobile').val(),
	productinfo: $('#pinfo').val(),
	udf5: $('#udf5').val(),
	surl : $('#surl').val(),
	furl: $('#surl').val(),
	mode: 'dropout'	
},{ responseHandler: function(BOLT){
	console.log( BOLT.response.txnStatus );		
	if(BOLT.response.txnStatus != 'CANCEL')
	{
		//Salt is passd here for demo purpose only. For practical use keep salt at server side only.
		var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
		'<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
		'<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
		'<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
		'<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
		'<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
		'<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
		'<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
		'<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
		'<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
		'<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
		'<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
		'</form>';
		var form = jQuery(fr);
		jQuery('body').append(form);								
		form.submit();
	}
},
	catchException: function(BOLT){
 		alert( BOLT.message );
	}
});
}
</script>
			

<script src="assets/js/jquery.bvalidator.js"></script>
<script type="text/javascript"> 
    $(document).ready(function () {
        $('.bValidator').bValidator();
    });
</script> 
			<script src="assets/plugins/js/bootstrap.min.js"></script>
			<script src="assets/plugins/js/bootsnav.js"></script>
			
			<script src="assets/plugins/js/bootstrap-select.min.js"></script>
			<script src="assets/plugins/js/bootstrap-touch-slider-min.js"></script>
			<script src="assets/plugins/js/jquery.touchSwipe.min.js"></script>
			<script src="assets/plugins/js/chosen.jquery.js"></script>
			<script src="assets/plugins/js/datedropper.min.js"></script>
			<script src="assets/plugins/js/dropzone.js"></script>
			<script src="assets/plugins/js/jquery.counterup.min.js"></script>
			<script src="assets/plugins/js/jquery.fancybox.js"></script>
			<!-- <script src="assets/plugins/js/jquery.nice-select.js"></script> -->
			<script src="assets/plugins/js/jqueryadd-count.js"></script>
			<script src="assets/plugins/js/jquery-rating.js"></script>
			<script src="assets/plugins/js/slick.js"></script>
			<script src="assets/plugins/js/timedropper.js"></script>
			<script src="assets/plugins/js/waypoints.min.js"></script>
			
			<script src="assets/js/jQuery.style.switcher.js"></script>
			
			<!-- Custom Js -->
			<script src="assets/js/custom.js"></script>
			<script src="assets/ajex.js"></script>
			<script src="assets/my.js"></script>
			<script src="assets/statusajax.js"></script>


			<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
			<script>
				function openRightMenu() {
					document.getElementById("rightMenu").style.display = "block";
				}
				function closeRightMenu() {
					document.getElementById("rightMenu").style.display = "none";
				}
			</script>
			
			<script type="text/javascript">
				$(document).ready(function() {
					$('#styleOptions').styleSwitcher();
				});
			</script>
			
			<script type="text/javascript">
				  $(document).ready(function() {
				  $('select').niceSelect();
				});			
			</script>
			
			<script type="text/javascript">
				$('#bootstrap-touch-slider').bsTouchSlider();
			</script>
			
			<script>
				$(document).ready(function(){
					$('[data-toggle="tooltip"]').tooltip();   
				});
			</script>
			<script type="text/javascript">
				var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
				(function(){
				var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
				s1.async=true;
				s1.src='https://embed.tawk.to/5c7655393341d22d9ce65b5d/default';
				s1.charset='UTF-8';
				s1.setAttribute('crossorigin','*');
				s0.parentNode.insertBefore(s1,s0);
				})();
			</script>
			<script type="text/javascript">
				function readIMG(input) {
			        if (input.files && input.files[0]) {
			            var reader = new FileReader();

			            reader.onload = function (e) {
			                $('#myimg').attr('src', e.target.result);
			            }

			            reader.readAsDataURL(input.files[0]);
			        }
			    }

			    $("#myfile").change(function(){
			        readIMG(this);
			    });
			</script>
			<script>
				$('.datedropper').dateDropper();
			</script>
			
			<script>
			  $(function() {
				$('.chosen-select').chosen();
				$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
			  });
			</script>
			<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2"></script>
