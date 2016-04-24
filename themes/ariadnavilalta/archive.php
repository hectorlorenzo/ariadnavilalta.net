<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ariadnavilalta
 */

$project_categories = get_terms( 'project-category' );
$currCategory = get_queried_object();

get_header( 'project-detail' ); ?>

<div class="wrapper">

    <!-- Project selection -->
    <div class="category-selector">
        
        <select name="project-category" id="project-category">
            <option value="all">all</option>

            <?php foreach( $project_categories as $cat): ?>
                <option value="<?php echo $cat->slug ?>"><?php echo $cat->slug ?></option>
            <?php endforeach; ?>
        </select>

        <nav class="project-navigation">
            <ul>
                <li><a href="<?php echo site_url(); ?>/work" data-catid="all">all</a></li>

                <?php foreach( $project_categories as $cat): ?>
                    <li class="<?php echo $currCategory->slug === $cat->slug ? 'selected' : '' ?>"><a href="<?php echo site_url() ?>/project-categories/<?php echo $cat->slug ?>/" data-catid="<?php echo $cat->slug ?>"><?php echo $cat->slug ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>

    </div>

    <h2 class="section-title">Archive <span class="grey">(<?php echo $currCategory->count ?>)</span></h2>

    <div id="project-grid">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php $project_categories = wp_get_post_terms( $post->ID, 'project-category' ); ?>
	            <?php $project_thumb_size = get_field( 'project_size', $post->ID ); ?>

	            <div id="project-<?php echo $post->ID ?>" class="project-thumb [ one-whole<?php echo $project_thumb_size === 'big' ? ' portable--two-thirds' : ' portable--one-third' ?> ]">
	                <div class="project-thumb__image">

	                    <?php 

	                    $regular_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'project_thumb_regular' );
	                    $mobile_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'project_thumb_mobile' ); 

	                    ?>
	                    
	                    <a href="<?php echo get_permalink($post->ID); ?>">
	                        <img src="<?php echo $regular_image[0] ?>" alt="<?php echo $post->project_title ?>">
	                    </a>

	                </div>
	                <div class="project-thumb__footer">
	                    <h4 class="project-thumb__title"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h4>
	                    <h5 class="grey">
	                        <?php foreach( $project_categories as $index => $cat) {
	                            echo $cat->name;
	                            if ( $index < count($project_categories) - 1 ) echo ', ';
	                        } ?>
	                    </h5>
	                </div>
	            </div>

			<?php endwhile; ?>

			<?php ariadnavilalta_paging_nav(); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
