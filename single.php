<?php
/**
 * Single blog post template.
 * Template for displaying individual blog posts with JKJAAC branding
 *
 * @package JKJAAC
 */

get_header();

// Define fallback image URL
$fallback_image = get_template_directory_uri() . '/images/post-default-placeholder.png';

// Enqueue single post CSS
$theme_version = wp_get_theme()->get('Version');
$css_file_path = get_template_directory() . '/css/single-post.css';
if (file_exists($css_file_path)) {
    wp_enqueue_style('jkjaac-single-post', get_template_directory_uri() . '/css/single-post.css', array(), $theme_version);
}
?>

<main class="single-post-main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <!-- Blog Hero Section -->
        <div class="bd-hero">
            <img 
                src="<?php echo esc_url(has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : $fallback_image); ?>" 
                alt="<?php the_title_attribute(); ?>" 
                class="bd-hero-img"
                onerror="this.onerror=null;this.src='<?php echo esc_js($fallback_image); ?>';"
            />
            <div class="bd-hero-overlay"></div>
            <div class="bd-hero-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="bc-sep">›</span>
                <a href="<?php echo esc_url(home_url('/blogs')); ?>">Blogs</a>
                <span class="bc-sep">›</span>
                <span class="cur"><?php echo esc_html(wp_trim_words(get_the_title(), 8, '...')); ?></span>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span class="bc-sep">›</span>
            <a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>">Blogs</a><span class="bc-sep">›</span>
            <span class="cur"><?php the_title(); ?></span>
        </div>

        <div class="blogs-main">
            <div class="blogs-inner">
                <div>
                    <!-- Header Section -->
                    <div class="bd-header sr">
                        <div class="bd-header-title-ar">
                            <h1 class="bd-title"><?php the_title(); ?></h1>
                            <div class="bd-category-line">
                                <div class="bd-category-rule"></div>
                                <span class="bd-category-label">
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        echo esc_html($categories[0]->name);
                                    } else {
                                        echo 'Politics & Society';
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                        <p class="bd-excerpt"><?php echo get_the_excerpt(); ?></p>
                    </div>

                    <!-- Featured Image -->
                    <div class="bd-feature-img-wrap sr sr-d1">
                        <img 
                            src="<?php echo esc_url(has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'full') : $fallback_image); ?>" 
                            alt="<?php the_title_attribute(); ?>" 
                            class="bd-feature-img"
                            onerror="this.onerror=null;this.src='<?php echo esc_js($fallback_image); ?>';"
                        />
                    </div>

                    <!-- Meta Box -->
                    <div class="bd-meta-box sr sr-d2">
                        <p class="bd-meta-title">Post Details</p>
                        <div class="bd-meta-row">
                            <img 
                                class="bd-avatar" 
                                src="<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'), ['size' => 40])); ?>" 
                                alt="Author"
                                onerror="this.onerror=null;this.src='<?php echo esc_js($fallback_image); ?>';"
                            />
                            <div>
                                <span class="bd-author"><?php the_author(); ?></span>
                                <span class="bd-meta-hosted"> · <?php echo get_the_date('F j, Y'); ?></span>
                            </div>
                        </div>
                        <div class="bd-meta-row">
                            <span class="bd-meta-hosted">
                                <i class="ri-time-line"></i> 
                                <?php 
                                $word_count = str_word_count(strip_tags(get_the_content()));
                                $reading_time = ceil($word_count / 200);
                                echo esc_html($reading_time); ?> min read
                            </span>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="bd-body prose sr sr-d3">
                        <?php the_content(); ?>
                    </div>

                    <!-- Review/Comment Form Section -->
                    <div class="bd-review-section sr">
                        <div class="contact-right">
                            <div class="form-header">
                                <p class="bd-review-sub">Share your thoughts: <strong><?php the_title(); ?></strong></p>
                            </div>

                            <div id="commentFormWrap">
                                <?php 
                                // Custom comment form
                                $comments_count = get_comments_number();
                                ?>
                                <div class="bd-comments-header">
                                    <span class="bd-comments-count" id="commentsCount"><?php echo intval($comments_count); ?> Comments</span>
                                </div>

                                <div id="commentsList">
                                    <?php
                                    $comments = get_comments([
                                        'post_id' => get_the_ID(),
                                        'status' => 'approve',
                                        'order' => 'DESC',
                                    ]);
                                    
                                    if ($comments) {
                                        foreach ($comments as $comment) {
                                            $comment_avatar = get_avatar_url($comment->comment_author_email, ['size' => 36]);
                                            ?>
                                            <div class="bd-comment" id="comment-<?php echo intval($comment->comment_ID); ?>">
                                                <img 
                                                    class="bd-comment-avatar" 
                                                    src="<?php echo esc_url($comment_avatar); ?>" 
                                                    alt="<?php echo esc_attr($comment->comment_author); ?>"
                                                    onerror="this.onerror=null;this.src='<?php echo esc_js($fallback_image); ?>';"
                                                />
                                                <div class="bd-comment-body">
                                                    <div class="bd-comment-top">
                                                        <span class="bd-comment-name"><?php echo esc_html($comment->comment_author); ?></span>
                                                    </div>
                                                    <p class="bd-comment-text"><?php echo esc_html($comment->comment_content); ?></p>
                                                    <div class="bd-comment-actions">
                                                        <span class="bd-comment-time"><?php echo human_time_diff(strtotime($comment->comment_date), current_time('timestamp')); ?> ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        echo '<p class="no-comments">No comments yet. Be the first to share your thoughts!</p>';
                                    }
                                    ?>
                                </div>

                                <div class="bd-comment-form-wrap">
                                    <h3 class="bd-review-title" style="margin-bottom: 1rem;">Leave a Comment</h3>
                                    <form id="comment-form" class="contact-form" method="post">
                                        <input type="hidden" name="action" value="jkjaac_comment">
                                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('jkjaac_nonce'); ?>">
                                        <input type="hidden" name="post_id" value="<?php echo intval(get_the_ID()); ?>">
                                        <input type="hidden" name="parent_comment" value="0" id="parent_comment_id">
                                        
                                        <div class="form-row full">
                                            <div class="field">
                                                <label for="comment_name">Your Name</label>
                                                <input type="text" id="comment_name" name="name" placeholder="Enter your name" required />
                                            </div>
                                        </div>
                                        <div class="form-row full">
                                            <div class="field">
                                                <label for="comment_email">Email Address</label>
                                                <input type="email" id="comment_email" name="email" placeholder="your@email.com" required />
                                            </div>
                                        </div>
                                        <div class="form-row full">
                                            <div class="field">
                                                <label for="comment_message">Your Comment</label>
                                                <textarea id="comment_message" name="message" rows="5" placeholder="Write your comment here…" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-submit">
                                            <button type="submit" class="btn-submit">
                                                Post Comment
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                    <path d="M1 7h12M8 2l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="form-success" id="formSuccess" style="display: none;">
                                <div class="success-icon">✓</div>
                                <div class="success-title">Comment Posted!</div>
                                <p class="success-sub">Your comment has been posted successfully.</p>
                            </div>
                        </div>
                    </div>
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
                                    <a href="<?php echo get_category_link($category->term_id); ?>">
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

        <!-- Related Posts Section -->
        <div class="bd-related">
            <div class="bd-related-inner">
                <div class="bd-related-header sr">
                    <div class="sr pg-index-8">
                        <p class="s-label">Related Posts</p>
                        <h2 class="s-title pg-index-10">You Might &nbsp;<em>Also Like</em></h2>
                    </div>
                </div>

                <div class="bd-related-grid sr sr-d1" id="related-posts-grid">
                    <?php
                    // Get current post categories
                    $current_categories = get_the_category();
                    $cat_ids = array();
                    if (!empty($current_categories)) {
                        foreach ($current_categories as $cat) {
                            $cat_ids[] = $cat->term_id;
                        }
                    }
                    
                    $related_args = [
                        'post_type' => 'post',
                        'posts_per_page' => 4,
                        'post__not_in' => [get_the_ID()],
                        'orderby' => 'rand',
                    ];
                    
                    // If we have categories, get posts from same category
                    if (!empty($cat_ids)) {
                        $related_args['category__in'] = $cat_ids;
                    }
                    
                    $related_query = new WP_Query($related_args);
                    if ($related_query->have_posts()) :
                        while ($related_query->have_posts()) : $related_query->the_post();
                            $post_cats = get_the_category();
                            $post_reading_time = ceil(str_word_count(strip_tags(get_the_content())) / 200);
                            $related_thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    ?>
                        <a href="<?php the_permalink(); ?>" class="bd-related-card">
                            <div class="bd-related-card-img-wrap">
                                <img 
                                    src="<?php echo esc_url($related_thumb ?: $fallback_image); ?>" 
                                    alt="<?php the_title_attribute(); ?>" 
                                    class="bd-related-card-img" 
                                    loading="lazy"
                                    onerror="this.onerror=null;this.src='<?php echo esc_js($fallback_image); ?>';"
                                />
                                <div class="bd-related-card-arrow"><i class="ri-arrow-right-up-line"></i></div>
                            </div>
                            <div class="bd-related-card-body">
                                <h3 class="bd-related-card-title"><?php the_title(); ?></h3>
                                <span class="bd-related-card-cat">
                                    <?php echo esc_html(!empty($post_cats) ? $post_cats[0]->name : 'General'); ?>
                                </span>
                                <p class="bd-related-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                                <div class="bd-related-card-meta">
                                    <span><i class="ri-time-line"></i> <?php echo intval($post_reading_time); ?> min</span>
                                    <span><i class="ri-calendar-line"></i> <?php echo get_the_date('M j, Y'); ?></span>
                                </div>
                            </div>
                        </a>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                    ?>
                        <p class="no-related-posts">No related posts found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endwhile; endif; ?>
</main>

<!-- Comment AJAX Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Comment submission
    const commentForm = document.getElementById('comment-form');
    if (commentForm) {
        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Validate
            const name = document.getElementById('comment_name').value.trim();
            const email = document.getElementById('comment_email').value.trim();
            const message = document.getElementById('comment_message').value.trim();
            
            if (!name || !email || !message) {
                return;
            }
            
            if (!email.includes('@') || !email.includes('.')) {
                return;
            }
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Posting...';
            
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload page to show new comment
                    window.location.reload();
                } else {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
});
</script>

<style>
.no-related-posts {
    grid-column: 1 / -1;
    text-align: center;
    padding: 2rem;
    color: var(--muted);
}
.no-comments {
    text-align: center;
    padding: 2rem;
    color: var(--muted);
    font-style: italic;
}
</style>

<?php get_footer(); ?>