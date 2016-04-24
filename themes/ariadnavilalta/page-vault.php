<?php 

// Template Name: Vault

// Specify username and password for authentication
$user = 'friend';
$pass = 'ariadnavilalta';

// Define a function to generate a 401 and prompt for login
function prompt() {
    header('WWW-Authenticate: Basic realm="Restricted Data"');
    header("HTTP/1.0 401 Unauthorized");
    exit;
}

//  If the user is not already logged in, call the prompt function
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    prompt();
}
    
// Check to see if the username and password are correct
else if (($_SERVER['PHP_AUTH_USER'] == $user) && ($_SERVER['PHP_AUTH_PW'] == $pass)) {
// If they are, don't do anything, just load the page
}

// If credentials are not correct, call the prompt() function again
else {
    prompt();
}

global $wp_query;

$query_args = array(
    'post_type' => 'project',
    'orderby'   => 'menu_order',
    'order'     => 'ASC',
    'paged'     => $page_number,
    'tax_query' => array(
        array(
            'taxonomy' => 'project-category',
            'field'    => 'slug',
            'terms'    => 'secret'
        )
    )
);

$projects_query = new WP_Query( $query_args );

get_header(); ?>

<div class="wrapper">

    <h2 class="section-title">The Vault</h2>

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
