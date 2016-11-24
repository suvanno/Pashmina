<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pashmina
 */

get_header(); ?>

    <?php if ( get_theme_mod( 'featured_posts' ) != '' ) : ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
                <div class="dt-featured-post-slider">
                    <div class="swiper-wrapper">

                        <?php
                        $dt_featured_posts      = esc_html( get_theme_mod( 'featured_posts_select' ) );
                        $featured_posts_count   = esc_html( get_theme_mod( 'featured_posts_count' ) );

                        if ( $dt_featured_posts == '' ) {
                            $dt_featured_posts = '';
                        }

                        $args = array(
                            'post_type'		 => 'post',
                            'posts_per_page' => $featured_posts_count,
                            'orderby' 		 => 'ASC',
                            'category__in'   => $dt_featured_posts
                        );

                        $dt_featured_posts = new WP_Query($args);

                        while ( $dt_featured_posts->have_posts() ) : $dt_featured_posts->the_post(); ?>

                            <div class="swiper-slide">
                                <div class="dt-featured-post">
                                    <figure>

                                        <?php

                                        if ( has_post_thumbnail() ) :

                                            the_post_thumbnail( 'pashmina-featured-post-img' );

                                        else : ?>
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/blank.png" alt="<?php _e( 'no image found', 'pashmina' )?>"/>
                                        <?php endif; ?>

                                        <span class="transition5"><a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><i class="fa fa-mail-forward transition5"></i></a> </span>
                                    </figure>

                                    <div class="entry-footer">
                                        <h3><a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

                                        <span><?php esc_attr( the_date() ); ?></span>
                                    </div>
                                </div><!-- .dt-featured-post -->
                            </div><!-- .swiper-slide -->

                        <?php endwhile; ?>

                        <?php wp_reset_postdata(); ?>

                        <div class="clearfix"></div>
                    </div><!-- .swiper-wrapper -->

                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div><!-- .dt-featured-post-slider -->
			</div><!-- .col-lg-12 -->
		</div><!-- .row -->
	</div><!-- .container -->

    <?php else : ?>

    <div class="dt-slider-separator"></div>

    <?php endif; ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">

                <?php if ( have_posts() ) :

                    while ( have_posts() ) : the_post();
                        if ( 'page' == get_option( 'show_on_front' ) ) { ?>

                            <div class="dt-content-area">
                                <?php

                                get_template_part( 'template-parts/content', 'page' );

                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;

                                ?>
                            </div>

                        <?php } else { ?>

                            <section <?php post_class( 'dt-front-posts-wrap' ); ?>>
                                <div class="dt-front-post">

                                    <figure>
                                        <?php  if ( has_post_thumbnail() ) :

                                            the_post_thumbnail( 'pashmina-front-post-img' );

                                         else : ?>

                                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/blank.png" alt="no image found"/>

                                        <?php endif; ?>

                                        <span><a href="<?php esc_url( the_permalink() ); ?>" title="<?php esc_attr( the_title() ); ?>"><i class="fa fa-mail-forward transition5"></i></a> </span>
                                   </figure>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <div class="entry-meta">
                                                <p><strong><?php _e( 'Author:', 'pashmina' ); ?></strong><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php echo esc_html( get_the_author() ) ?></a></p>

                                                <p><strong><?php _e( 'Published on:', 'pashmina' ); ?></strong><?php esc_html( the_time("F d, Y") ); ?></p>

                                                <p><strong><?php _e( 'Category:', 'pashmina' ); ?></strong>
                                                    <?php $categories_list = get_the_category_list( esc_html__( ', ', 'pashmina' ) );
                                                    if ( $categories_list && pashmina_categorized_blog() ) {
                                                        printf( $categories_list ); // WPCS: XSS OK.
                                                    } ?></p>
                                            </div>
                                        </div>

                                        <article class="col-lg-9 col-md-9 col-sm-9">
                                            <header class="entry-header">
                                                <h2><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_attr( get_the_title() ); ?></a></h2>
                                            </header><!-- .entry-header -->

                                            <div>
                                                <?php esc_html( the_excerpt() ); ?>
                                            </div>

                                            <footer class="entry-footer">
                                                <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php _e( 'CONTINUE READING', 'pashmina' ); ?></a>
                                            </footer><!-- .entry-footer -->
                                        </article>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </section>

                        <?php } ?>

                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>

                    <div class="clearfix"></div>

                    <div class="dt-pagination-nav">
                        <?php echo paginate_links(); ?>
                    </div><!---- .dt-pagination-nav ---->

                <?php else : ?>

                    <p><?php _e( 'Sorry, no posts matched your criteria.', 'pashmina' ); ?></p>

                <?php endif; ?>

            </div>

            <aside class="col-lg-4 col-md-4">
                <div class="dt-sidebar">
                    <?php get_sidebar(); ?>
                </div><!-- dt-sidebar -->
            </aside><!-- .col-lg-4 -->
        </div>
    </div>

<?php
get_footer();
