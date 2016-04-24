<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ariadnavilalta
 */

$featured_projects = ariadnavilalta_get_featured_projects();

$recent_projects = ariadnavilalta_get_recent_projects();

get_header(); ?>

<div class="band--flush">
    <div class="wrapper">
        <div class="slideshow">
            <div id='slider' class='swipe'>
                <div class='swipe-wrap'>
                    <?php foreach ( $featured_projects as $project ): ?>
                        
                        <div class="slide--project">
                            <a href="<?php echo get_permalink($project->ID); ?>">
                                <img src="<?php the_field( 'project_slider_image', $project->ID ); ?>" alt="<?php echo $project->project_title ?>">
                            </a>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>

            <div class="slideshow__data">
                <div class="slideshow__counter">
                    <ul>
                    <?php 

                        for ( $i=0; $i < count( $featured_projects ); $i++ ) { 
                            echo '<li' . ($i === 0 ? " class='active'" : "" ) . '>' . ( $i + 1 ) . '</li>';
                        }

                    ?>
                    </ul>
                </div>

                <div class="slideshow__info-wrapper"><!--
                    <?php foreach ( $featured_projects as $index => $project ): ?>

                        <?php $project_categories = wp_get_post_terms( $project->ID, 'project-category' ); ?>
                        
                        --><div class="slideshow__info-project<?php echo ($index === 0 ? ' active' : '' ) ?>">
                            <h3><?php echo $project->post_title ?></h3>
                            <h4 class="grey">
                                <?php foreach( $project_categories as $index => $cat) {
                                    echo $cat->name;
                                    if ( $index < count($project_categories) - 1 ) echo ', ';
                                } ?>
                            </h4>

                            <a href="<?php echo get_permalink( $project->ID ); ?>">See the project &rarr;</a>
                        </div><!--

                    <?php endforeach; ?>
             --></div>
            </div>
        </div>
    </div>
</div>

<div class="[ band band--wide ]">
    <div class="wrapper">
        <div class="grid">
            <div class="grid__item one-whole portable--one-half">
                <h2 class="section-title">About</h2>
            </div><!--
         --><div class="grid__item one-whole portable--one-half">
                <p>
                    A Designer who creates simple, helpful, and remarkable graphic design. From global brands to small businesses. <a href="<?php echo site_url() ?>/about">(more)</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="[ band band--flush ]">
    <div class="wrapper">

        <h2 class="section-title">Work. <span class="grey">Recent Projects (<?php echo count($recent_projects) ?>)</span></h2>

        <div id="project-grid" class="grid">

            <?php foreach ($recent_projects as $index => $project): ?><!--
                
                <?php $project_categories = wp_get_post_terms( $project->ID, 'project-category' ); ?>
                <?php $project_thumb_size = get_field( 'project_size', $project->ID ); ?>

             --><div id="project-<?php echo $project->ID ?>" class="project-thumb [ grid__item one-whole portable--one-half ]">
                    <div class="project-thumb__image">

                        <?php 

                        $regular_image = wp_get_attachment_image_src( get_post_thumbnail_id( $project->ID ), 'project_thumb_regular' );
                        $mobile_image = wp_get_attachment_image_src( get_post_thumbnail_id( $project->ID ), 'project_thumb_mobile' ); 

                        ?>
                        
                        <a href="<?php echo get_permalink($project->ID); ?>">
                            <picture>
                                <source srcset="<?php echo $regular_image[0] ?>" media="(min-width: 600px)">
                                <img srcset="<?php echo $mobile_image[0] ?>" alt="<?php echo $project->project_title ?>">
                            </picture>
                        </a>

                    </div>
                    <div class="project-thumb__footer">
                        <h4 class="project-thumb__title"><a href="<?php echo get_permalink($project->ID); ?>"><?php echo $project->post_title; ?></a></h4>
                        <h5 class="grey">
                            <?php foreach( $project_categories as $index => $cat) {
                                echo $cat->name;
                                if ( $index < count($project_categories) - 1 ) echo ', ';
                            } ?>
                        </h5>
                    </div>
                </div><!--

         --><?php endforeach; ?>

        </div> <!-- End of Project grid -->

        <p>
            <a class="more-projects" href="<?php echo site_url() ?>/work">View More Projects in the Archive &rarr;</a>
        </p>

    </div>
</div>

<?php get_footer(); ?>
