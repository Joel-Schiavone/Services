<footer id="footer" align="right">
</footer>
	<script src="../js/foundation.js"></script>
	<script src="../js/foundation.util.mediaQuery.js"></script>
	<script src="../js/foundation.tabs.js"></script>
	<script src="../js/foundation.accordion.js"></script>
	<script src="../js/foundation.magellan.js"></script>
    <script src="../js/foundation.reveal.js"></script>
    <script src="../js/jquery.filtertable.js"></script>
	<script>
    $(document).foundation();
	</script>
    <script>
	$(window).bind("load", function () {
   	 var footer = $("#footer");
  	  var pos = footer.position();
   	 var height = $(window).height();
   	 height = height - pos.top;
   	 height = height - footer.height();
   	 if (height > 0) {
   	     footer.css({
   	         'margin-top': height + 'px'
   	     });
   	 }
	});
	</script>
</body>
</html>