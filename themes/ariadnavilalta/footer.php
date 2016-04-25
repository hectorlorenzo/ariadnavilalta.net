<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package ariadnavilalta
 */
?>

	</div><!-- #content -->

</div><!-- #page -->

<script type="text/template" id="project-wrapper-template">
	<ul id="project-wrapper">
		<li class="project-wrapper-item" v-for="item in items">
			<project-thumbnail :commentcount="item.comment_count"></project-thumbnail>
		</li>
	</ul>
</script>

<script type="text/template" id="project-thumbnail-template">
	<div class="project-thumbnail">
		<h1>{{ commentcount }}</h1>
	</div>
</script>

<?php wp_footer(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-28331876-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>
