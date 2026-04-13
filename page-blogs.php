<?php
/**
 * Template Name: Blogs Page
 */
get_header();

// Define fallback image URL
$fallback_image = get_template_directory_uri() . '/images/post-default-placeholder.png';
?>

<!-- Hero Section -->
<?php get_template_part('template-parts/hero'); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span class="bc-sep">›</span>
    <span class="cur">Blogs</span>
</div>

<!-- News Ticker -->
<?php echo do_shortcode('[dynamic_ticker]'); ?>

<div class="blogs-main">
    <div class="blogs-inner">
        <div>
            <?php
            // Get current page for pagination
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            
            // Get featured post (only first post)
            $featured_query = new WP_Query([
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 1,
            ]);
            
            $featured_post = null;
            if ($featured_query->have_posts()) {
                $featured_query->the_post();
                $featured_post = $post;
            }
            wp_reset_postdata();
            
            // Main query for grid (4 posts per page, offset by 1 if on page 1)
            $offset = ($paged == 1) ? 1 : (($paged - 1) * 4);
            $blog_query = new WP_Query([
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 4,
                'offset' => $offset,
            ]);
            ?>

            <!-- Featured Blog Card (only on page 1) -->
            <?php if ($paged == 1 && $featured_post) : 
                $featured_thumb = get_the_post_thumbnail_url($featured_post->ID, 'large');
            ?>
                <a href="<?php echo get_permalink($featured_post->ID); ?>" class="blog-featured-card sr">
                    <img 
                        src="<?php echo esc_url($featured_thumb ?: $fallback_image); ?>" 
                        alt="<?php echo esc_attr($featured_post->post_title); ?>" 
                        class="blog-featured-img"
                        onerror="this.onerror=null;this.src='<?php echo esc_js($fallback_image); ?>';"
                    />
                    <div class="blog-featured-body">
                        <span class="blog-tag">
                            <?php
                            $categories = get_the_category($featured_post->ID);
                            if (!empty($categories)) {
                                echo esc_html($categories[0]->name) . ' · Latest';
                            } else {
                                echo 'Understanding JKJAAC · Latest';
                            }
                            ?>
                        </span>
                        <h2 class="blog-featured-title"><?php echo esc_html($featured_post->post_title); ?></h2>
                        <p class="blog-featured-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt($featured_post), 35, '...')); ?></p>
                        <div class="blog-meta">
                            <span><i class="ri-calendar-line"></i> <?php echo get_the_date('F j, Y', $featured_post->ID); ?></span>
                            <span><i class="ri-time-line"></i> <?php echo ceil(str_word_count(strip_tags(get_the_content(null, false, $featured_post))) / 200); ?> min read</span>
                            <span><i class="ri-arrow-right-line"></i> Read Full Article</span>
                        </div>
                    </div>
                </a>
            <?php endif; ?>

            <!-- Blog Grid Container -->
            <div class="blogs-grid-container">
                <div class="blogs-grid sr sr-d1" id="blogs-grid">
                    <?php 
                    if ($blog_query->have_posts()) :
                        while ($blog_query->have_posts()) : $blog_query->the_post(); 
                            $post_thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    ?>
                        <a href="<?php the_permalink(); ?>" class="blog-card">
                            <img 
                                src="<?php echo esc_url($post_thumb ?: $fallback_image); ?>" 
                                alt="<?php the_title_attribute(); ?>" 
                                class="blog-card-img"
                                onerror="this.onerror=null;this.src='<?php echo esc_js($fallback_image); ?>';"
                            />
                            <span class="blog-tag">
                                <?php
                                $post_cats = get_the_category();
                                echo esc_html(!empty($post_cats) ? $post_cats[0]->name : 'JKJAAC History');
                                ?>
                            </span>
                            <h3 class="blog-card-title"><?php the_title(); ?></h3>
                            <p class="blog-card-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20, '...')); ?></p>
                            <div class="blog-meta">
                                <span><i class="ri-calendar-line"></i> <?php echo get_the_date('F j, Y'); ?></span>
                            </div>
                            <span class="blog-read-more">Read More <i class="ri-arrow-right-line"></i></span>
                        </a>
                    <?php endwhile; ?>
                    <?php else : ?>
                        <div class="no-posts-found">
                            <p>No posts found.</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Load More Button -->
                <?php if ($blog_query->found_posts > ($offset + 4)) : ?>
                    <div class="comments-loads" style="display: flex;justify-content: center;align-items: center;margin-top: 1rem;cursor: pointer;">
                        <div class="bd-load-more" id="load-more-btn" style="padding: 8px 12px;border: 1px solid var(--border);">
                            <i class="ri-refresh-line"></i> Load More Posts
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Loading Spinner -->
                <div class="loading-spinner" id="loading-spinner" style="display: none; text-align: center; padding: 2rem;">
                    <i class="ri-loader-4-line" style="font-size: 2rem; display: inline-block;"></i>
                    <p>Loading more posts...</p>
                </div>
            </div>

            <?php wp_reset_postdata(); ?>
        </div>

        <!-- Sidebar -->
        <aside class="blogs-sidebar sr sr-d2">
            <!-- Recent Posts Widget -->
            <div class="sidebar-widget">
                <div class="sidebar-widget-head">Recent Posts</div>
                <?php
                $recent_posts = wp_get_recent_posts([
                    'numberposts' => 3,
                    'post_status' => 'publish',
                ]);
                foreach ($recent_posts as $recent) :
                    $recent_thumb = get_the_post_thumbnail_url($recent['ID'], 'thumbnail');
                ?>
                    <a href="<?php echo get_permalink($recent['ID']); ?>" class="sidebar-recent-post">
                        <img 
                            src="<?php echo esc_url($recent_thumb ?: $fallback_image); ?>" 
                            alt="<?php echo esc_attr($recent['post_title']); ?>" 
                            class="sidebar-post-img"
                            onerror="this.onerror=null;this.src='<?php echo esc_js($fallback_image); ?>';"
                        />
                        <div>
                            <div class="sidebar-post-title"><?php echo esc_html($recent['post_title']); ?></div>
                            <div class="sidebar-post-date"><?php echo get_the_date('F j, Y', $recent['ID']); ?></div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Categories Widget -->
            <div class="sidebar-widget">
                <div class="sidebar-widget-head">Categories</div>
                <ul class="sidebar-cat-list">
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $category) :
                    ?>
                        <li>
                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                <?php echo esc_html($category->name); ?>
                                <span class="sidebar-cat-count"><?php echo intval($category->count); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Upcoming Events Widget -->
            <div class="sidebar-widget">
                <div class="sidebar-widget-head">Upcoming Events</div>
                <?php
                $events = [
                    ['day' => '11', 'month' => 'Feb', 'title' => 'Maqbool Butt Shaheed Day', 'loc' => 'AJ&K'],
                    ['day' => '13', 'month' => 'Jul', 'title' => "Kashmir Martyrs' Day", 'loc' => 'Srinagar, J & K'],
                    ['day' => '27', 'month' => 'Oct', 'title' => 'Kashmir Black Day', 'loc' => 'J & K'],
                ];
                foreach ($events as $event) :
                ?>
                    <div class="event-item">
                        <div class="event-date-box">
                            <div class="event-day"><?php echo esc_html($event['day']); ?></div>
                            <div class="event-month"><?php echo esc_html($event['month']); ?></div>
                        </div>
                        <div>
                            <div class="event-info-title"><?php echo esc_html($event['title']); ?></div>
                            <div class="event-info-loc">
                                <i class="ri-map-pin-line"></i> <?php echo esc_html($event['loc']); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </aside>
    </div>
</div>

<style>
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
.ri-loader-4-line {
    animation: spin 1s linear infinite;
}
</style>

<script>
jQuery(document).ready(function($) {
    let currentPage = <?php echo $paged; ?>;
    let isLoading = false;
    
    $('#load-more-btn').on('click', function(e) {
        e.preventDefault();
        
        if (isLoading) return;
        isLoading = true;
        
        var button = $(this);
        currentPage++;
        
        $('#loading-spinner').fadeIn();
        button.hide();
        
        $.ajax({
            url: jkjaacBlogAjax.ajaxUrl,
            type: 'POST',
            data: {
                action: 'load_more_posts',
                page: currentPage,
                nonce: jkjaacBlogAjax.nonce
            },
            success: function(response) {
                $('#loading-spinner').hide();
                
                if (response.success && response.data.html) {
                    $('#blogs-grid').append(response.data.html);
                    button.fadeIn();
                    isLoading = false;
                    
                    if ($(response.data.html).find('.blog-card').length < 4) {
                        button.fadeOut(function() {
                            button.remove();
                        });
                    }
                } else {
                    button.fadeOut(function() {
                        button.remove();
                    });
                }
            },
            error: function(xhr, status, error) {
                $('#loading-spinner').hide();
                button.fadeIn();
                isLoading = false;
            }
        });
    });
});
</script>

<?php get_footer(); ?>