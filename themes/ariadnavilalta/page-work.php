<?php 

// Template Name: Work

global $wp_query;

if( isset( $wp_query->query_vars['project_category'] ) )
    $project_category = $wp_query->query_vars['project_category'];
else
    $project_category = null;

if( isset( $wp_query->query_vars['page_number'] ) )
    $page_number = $wp_query->query_vars['page_number'];
else
    $page_number = 1;

$query_args = array(
    'post_type'         => 'project',
    'orderby'           => 'menu_order',
    'order'             => 'ASC',
    'posts_per_page'    => 10,
    'paged'             => $page_number
);

if ( !is_null( $project_category ) ) {
    $query_args['tax_query'] = array(
        'relation' => 'AND',
        array(
            'taxonomy'  => 'project-category',
            'field'     => 'slug',
            'terms'     => $project_category
        ),
    );

    if ( $project_category !== 'secret' ) {
        $query_args['tax_query'][] = array(
            'taxonomy'  => 'project-category',
            'field'     => 'slug',
            'terms'     => 'secret',
            'operator'  => 'NOT IN'
        );
    }

} else {
    $query_args['tax_query'] = array(
        array(
            'taxonomy'  => 'project-category',
            'field'     => 'slug',
            'terms'     => 'secret',
            'operator'  => 'NOT IN'
        )
    );
}

$projects_query = new WP_Query( $query_args );

// if the number of pages on the query is bigger than the actual number of pages, let's go back
$max_number_pages = ceil( $projects_query->found_posts / 10 );
if( $page_number > $max_number_pages ) {

    $new_location = site_url('/work');

    if( !is_null($project_category) )
        $new_location .= '/' . $project_category;

    header('Location: ' . $new_location );
}

$project_categories = get_terms( 'project-category', array(
    'exclude'           => array( 6 )
));

get_header(); ?>

<div class="wrapper">

    <!-- Project selection -->
    <div class="category-selector">
        
        <select name="project-category" id="project-category">
            <option value="<?php echo site_url('work/') ?>">all</option>

            <?php foreach( $project_categories as $cat): ?>
                <option<?php echo $project_category === $cat->slug ? ' selected' : '' ?> value="<?php echo site_url('work') . '/' . $cat->slug ?>"><?php echo $cat->slug ?></option>
            <?php endforeach; ?>
        </select>

        <nav class="category-navigation">
            <ul>
                <li<?php is_null( $project_category ) ? ' class="selected' : '' ?>><a href="<?php echo site_url(); ?>/work" data-catid="all">all</a></li>

                <?php foreach( $project_categories as $cat): ?>
                    <li<?php echo $project_category === $cat->slug ? ' class="selected"' : '' ?>><a href="<?php echo site_url() ?>/work/<?php echo $cat->slug ?>/" data-catid="<?php echo $cat->slug ?>"><?php echo $cat->slug ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>

    </div>

    <h2 class="section-title">Archive <span class="grey">(<?php echo $projects_query->found_posts ?>)</span></h2>

    <div id="project-grid" class="grid clearfix infinite-scroll">

        <?php if( $projects_query->have_posts() ): ?>
            <?php while ( $projects_query->have_posts() ) : $projects_query->the_post(); ?><!--
                
                <?php $project_categories = wp_get_post_terms( $post->ID, 'project-category' ); ?>
                <?php $post_thumb_size = get_field( 'project_size', $post->ID ); ?>

             --><div id="project-<?php echo $post->ID ?>" class="project-thumb [ grid__item one-whole portable--one-half ]">
                    <div class="project-thumb__image">

                        <?php 

                        $regular_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'project_thumb_regular' );
                        $mobile_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'project_thumb_mobile' ); 

                        ?>

                        <a href="<?php echo get_permalink($post->ID); ?>">
                            <picture>
                                <source srcset="<?php echo $regular_image[0] ?>" media="(min-width: 600px)">
                                <img srcset="<?php echo $mobile_image[0] ?>" alt="<?php echo $post->project_title ?>">
                            </picture>
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
                </div><!--

         --><?php endwhile; ?>

            </div> <!-- End of Project grid -->

            <!-- Pagination -->
            <nav class="navigation paging-navigation" role="navigation">
                <div class="nav-links">

                    <?php if ( $page_number > 1 ) : ?>
                    <div class="nav-previous">
                        <a href="<?php echo site_url('work') . ( !is_null( $project_category ) ? '/' . $project_category : '' ) . ( $page_number > 2 ? '/' . $page_number - 1 : '/' ) ?>"><?php echo __( 'Newer projects', 'ariadnavilalta' ) ?></a>
                    </div>
                    <?php endif; ?>

                    <?php if ( $page_number < $max_number_pages) : ?>
                    <div class="nav-next">
                        <a href="<?php echo site_url('work') . ( !is_null( $project_category ) ? '/' . $project_category : '' ) . '/' . ($page_number + 1) ?>"><?php echo __( 'Older projects', 'ariadnavilalta' ) ?></a>
                    </div>
                    <?php endif; ?>

                </div><!-- .nav-links -->
            </nav><!-- .navigation -->
            
            <?php wp_reset_postdata(); ?>

        <?php endif; ?>

</div>

<?php get_footer(); ?>