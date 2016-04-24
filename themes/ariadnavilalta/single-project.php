<?php
/**
 * The template for displaying all single projects.
 *
 * @package ariadnavilalta
 */

get_header( 'project-detail' ); ?>

    <div class="wrapper">
        <div class="project-detail">

            <?php while ( have_posts() ) : the_post(); ?>

                <div class="grid">
                    <div class="[ grid__item one-whole portable--one-half ] project-title">
                        <h2 class="section-title">
                            <?php the_title() ?>
                        </h2>
                    </div><!--
                 --><div class="[ grid__item one-whole portable--one-half ] project-description">
                        <?php the_content() ?>
                    </div>
                </div>

                <!-- Project images -->
                <div class="project-detail__images">
                <?php $attachments = new Attachments( 'project_images' ); /* pass the instance name */ ?>
                
                <?php if( $attachments->exist() ) : ?>
                    <?php while( $attachment = $attachments->get() ) : ?>
                        <?php echo $attachments->image( 'full' ); ?>
                    <?php endwhile; ?>
                <?php endif; ?>

                </div>

                <div class="project-navigation grid">
                    <div class="[ grid__item one-half ] project-navigation__previous">
                        <?php echo get_previous_project_url( $post->ID ); ?>
                    </div><!--
                 --><div class="[ grid__item one-half ] project-navigation__next">
                        <?php echo get_next_project_url( $post->ID ); ?>
                    </div>
                </div>

            <?php endwhile; // end of the loop. ?>

        </div> <!-- End of .project-detail -->
    </div> <!-- End of wrapper -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
