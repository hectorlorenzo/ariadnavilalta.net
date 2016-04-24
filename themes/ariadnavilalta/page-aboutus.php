<?php 

// Template Name: About

get_header(); ?>

<div class="wrapper">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php 

        // experience
        $companies = explode( PHP_EOL, get_field( 'aboutus_experience', get_the_ID() ) );

        // clients
        $clients = explode( PHP_EOL, get_field( 'aboutus_clients', get_the_ID() ) );

        ?>

        <article id="about-page">
            <header>
                <?php //the_title( '<h2>', '</h2>' ); ?>
            </header><!-- .entry-header -->

            <div class="about-content">

                <div class="grid">

                    <div class="[ grid__item one-whole desk--seven-tenths ]">
                        <?php the_content(); ?>
                    </div>

                    <!-- working experience -->
                    <div class="[ grid__item one-whole portable--one-half ] experience-list">
                        
                        <h3>Experience</h3>

                        <ul>
                        <?php

                        foreach ( $companies as $comp ) {
                            $comp_data = explode( ', ', $comp );

                            echo "<li>{$comp_data[0]}, <i>$comp_data[1]</i><br /><a target='_blank' href='http://$comp_data[2]'>$comp_data[2]</a></li>";
                        }

                        ?>
                        </ul>

                    </div><!-- 
                 --><div class="[ grid__item one-whole portable--one-half ] clients-list">
                        
                        <h3>Brands I've worked with</h3>
                        <ul>
                        <?php

                        foreach ( $clients as $cl ) {
                            echo "<li>{$cl}</li>";
                        }

                        ?>
                        </ul>

                    </div>
                </div>
            </div><!-- .entry-content -->

        </article><!-- #about-page -->

    <?php endwhile; // end of the loop. ?>

</div>

<?php get_footer(); ?>
