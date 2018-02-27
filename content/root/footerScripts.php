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

  <!-- todo: extract this into a module, it should not be loose in the footer -->
	<script src="<?php echo $siteurl; ?>social/social.js"></script>
  <!-- this was added by Brian, find the things that is referencing it -->
  <script>
	var siteurl = "<?php echo $siteurl; ?>";
  </script>
  </body>
</html>
