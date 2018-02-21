 <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"> </script>

	<!-- runs the google translate -->
	<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>

	<!-- this injects the app specific js for that page. for example;  'app-admin.js', or app-homepage-public.js -->
	<?php if(isset($requireJsInitializer) && $requireJsInitializer !== ""): ?>
	<input id="requirePageSpecificJs" type="hidden" value="<?php echo $requireJsInitializer; ?>?v=1">
	<?php endif; ?>

	<!-- Note, we would need something to replace the /cryptowizard/ prefix so this works when putting online -->
	<script data-main="/js/require-config.js" src="/js/vendors/require.minified.js"></script>
	
	 <script src="<?php echo $siteurl; ?>social/social.js"></script>
    <script>
		var siteurl = "<?php echo $siteurl; ?>";
    </script>
    <script>
	$(document).ready(function() {
		$("#registerModel").click(function() {
			$("#RegisterModal").modal('show');
			$("#exampleModal").modal('hide');
		});
		
		$("#loginModel").click(function() {
			$("#RegisterModal").modal('hide');
			$("#exampleModal").modal('show');
		});

		$("#forgotModel").click(function() {
			$("#exampleModal").modal('hide');
			$("#forgotPasswordModal").modal('show');
		});
		
		$("#changeModel").click(function() {
			$("#exampleModal").modal('hide');
			$("#changePasswordModal").modal('show');
		});
		$(window).on('load',function() {
			var forgot = getUrlVars()["forgot"];
			var active = getUrlVars()["isActive"];
			var loginError = getUrlVars()["error"];
			var success = getUrlVars()["success"];
			if(forgot) {
				$('#changePasswordModal').modal('show');
			}
			else if(active) {
				$('#exampleModal').modal('show');
			}
			else if(loginError == 'login#') {
				$('#exampleModal').modal('show');
			}
			else if(loginError == 'registeral#') {
				$('#exampleModal').modal('show');
			}
			else if(loginError == 'forgot#') {
				$('#forgotPasswordModal').modal('show');
			}
			else if(success == 'password#') {
				$('#changePasswordModal').modal('show');
			}
			else if(loginError == 'passwordnot#') {
				$('#changePasswordModal').modal('show');
			}
			else if(success == 'fmailsent#') {
				$('#forgotPasswordModal').modal('show');
			}
			else if(success == 'activation#') {
				$('#exampleModal').modal('show');
			}
		});

	});
	
function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
</script>
<?php
if(isset($_REQUEST['forgot']) && $_REQUEST['forgot']=='Yes' && isset($_REQUEST['id'])) {
	$email = base64_decode($_REQUEST['id']);
	//sleep(10);
	?>
	<?php
}
?>
  </body>
</html>
