<!DOCTYPE html>
<!-- saved from url=(0047)http://www.jquerytools.org/demos/tabs/index.htm -->
<html><!--
   This is a jQuery Tools standalone demo. Feel free to copy/paste.
   http://flowplayer.org/tools/demos/

   Do *not* reference CSS files and images from flowplayer.org when in
   production Enjoy!
--><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1258">
  <title>jQuery Tools standalone demo</title>

    <!-- include the Tools -->
  <script src="./js/jquery.tools.min.js"></script>
  
  <!-- standalone page styling (can be removed) -->
 
  <link rel="stylesheet" type="text/css" href="./js/standalone.css"/>

  <link rel="stylesheet" href="./js/tabs.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="./js/tabs-panes.css" type="text/css" media="screen"/>
</head>
<body><!-- the tabs -->
<ul class="tabs">
	<li><a href="#" class="current">Tab 1</a></li>
	<li><a href="#">Tab 2</a></li>
	<li><a href="#">Tab 3</a></li>
</ul>

<!-- tab "panes" -->
<div class="panes">
	<div style="display: block; ">First tab content. Tab contents are called "panes"</div>
	<div style="display: none; ">Second tab content</div>
	<div style="display: none; ">Third tab content</div>
</div>

<script>
// perform JavaScript after the document is scriptable.
$(function() {
    // setup ul.tabs to work as tabs for each div directly under div.panes
    $("ul.tabs").tabs("div.panes > div");
});
</script>

</body></html>