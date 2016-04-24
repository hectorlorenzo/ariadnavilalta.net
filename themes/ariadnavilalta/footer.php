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

	<footer class="site-footer" role="contentinfo">
		<div class="wrapper">
            <div class="grid">
                <div class="grid__item one-whole desk--one-third">
                    <h3>Contact me</h3>
                </div><!--
             --><div class="grid__item one-whole desk--one-third">
                <p>+61 478 848 295 / <a class="change-email" href="mailto:helloATariadnavilalta.net">hello@ariadnavilalta.net</a><br>Melbourne, Australia</p>
             </div><!--
             --><div class="grid__item one-whole desk--one-third">
                 <p class="site-footer__copyright">@<?php echo date('Y') ?> Ariadna Vilalta</p>
             </div>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

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
