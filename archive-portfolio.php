<?php get_header(); ?>

<main class="site-main">
    <section class="portfolio-header">
        <div class="container">
            <h1>WordPress Development Portfolio</h1>
            <p>Browse my recent projects, custom WordPress builds, and high-performance website solutions.</p>
        </div>
    </section>

    <section class="portfolio archive-portfolio">
        <div class="container">
            <div class="portfolio-grid" id="portfolio-container">
                <?php
                $args = array(
                    'post_type'      => 'portfolio',
                    'posts_per_page' => 10,  // Load 10 initially
                    'paged'          => 1,  // AJAX pagination starts at page 1
                    'orderby'        => 'menu_order', // Sort by custom order
                    'order'          => 'ASC' // Ascending order
                );
                $portfolio_query = new WP_Query($args);

                if ($portfolio_query->have_posts()) :
                    while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); ?>
                        <div class="portfolio-item">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                                <div class="portfolio-overlay">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php the_excerpt(); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                endif; ?>
            </div>

            <?php if ($portfolio_query->max_num_pages > 1) : ?>
                <!-- Load More Button (Only shows if there are more pages) -->
                <div class="load-more-container">
                    <div id="load-more" class="btn">Load More</div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
