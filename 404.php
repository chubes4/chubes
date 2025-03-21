<?php
/*
Template Name: 404 Page
*/
get_header();
?>

<main class="site-main error-404">
    <section class="error-content">
        <div class="container">
            <!-- 404 Title -->
            <h1 class="error-title">404 - Page Not Found</h1>

            <!-- Error Message -->
            <p class="error-message">Oops! It looks like the page you’re looking for has sailed off into the horizon. Don’t worry—my sites are built to navigate, but sometimes the seas get tricky!</p>

            <div class="error-actions">
                <a href="<?php echo home_url(); ?>" class="btn">← Back to Chubes.net</a>
                <a href="mailto:chubes@chubes.net" class="btn secondary">Contact Me</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>