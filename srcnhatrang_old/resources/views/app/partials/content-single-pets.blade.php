@php
  $current_categories = get_the_terms(get_the_ID(), 'category_pets');
  $current_post_id = get_the_ID();
  $category_name = 'category_pets';
@endphp
<div class="container pt-20 bg-white">
  <div class="row archive-category">
    @php
    $all_categories = get_categories(array('taxonomy' => $category_name));

    if ($all_categories && !is_wp_error($all_categories)) {
    echo '<ul>';
      echo '<li class="inline-block pl-10 mt-10">
        <h4>Categories</h4>
      </li>';
      foreach ($all_categories as $category) {
      echo '<li class="inline-block px-15">
        <h5 class="mb-0"><a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a></h5>
      </li>';
      }
      echo '</ul>';
    }
    @endphp
  </div>
  <div class="row shadow-lg p-10">
    <header>
      <div class="row">
        <div class="col w-2/5 down_lg:w-full">
          @if (has_post_thumbnail())
          {{ the_post_thumbnail('custom-size', ['class' => 'featured-image w-full']) }}
          @endif
        </div>
        <div class=" col pl-10 w-3/5 down_lg:w-full">
          <h2 class="entry-title mb-10 leading-50">{!! get_the_title() !!}</h2>
          @include('partials/entry-meta')
          <div class="px-6 pt-4 pb-2">
            @php
            if ($current_categories && !is_wp_error($current_categories)) {
              $current_categories_links = '';

              foreach ($current_categories as $category) {
                $current_categories_links .= '<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"><a href="' . esc_url(get_term_link($category)) . '">#' . esc_html($category->name) . '</a></span>, ';
                $current_categories_links = rtrim($current_categories_links, ', ');
              }
              echo '<p>Current Categories: ' . $current_categories_links . '</p>';
            }
            @endphp
          </div>
        </div>
      </div>
    </header>
    <div class="entry-content">
      @php the_content() @endphp
    </div>
  </div>
  @php
    if ($current_categories && !is_wp_error($current_categories)) {
      $category_ids = wp_list_pluck($current_categories, 'term_id');
      $category_ids_str = implode(' ', $category_ids);
        $args = array(
            'post_type'      => get_post_type(),
            'posts_per_page' => 3,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'category_pets',
                    'field'    => 'id',
                    'terms'    => $category_ids,
                ),
            ),
            'post__not_in'   => array(get_the_ID()),
        );

      $related_posts = new WP_Query($args);
    }
  @endphp
  @php
  if ($related_posts->have_posts()){ @endphp
    <div class="archive-category">
      <h4 class="">Related posts</h4>
    </div>
    <div class=" row related-posts mt-5 -ml-18 mr-1.5">
    @php while ($related_posts->have_posts()) {
      $related_posts->the_post();
      @endphp
      <div class="w-full md:w-1/2 lg:w-1/3 mb-35">
          <div class="w-full rounded overflow-hidden shadow-lg h-250 bg-white p-10 m-10">
              <a href="<?php echo esc_url(get_permalink()); ?>" style="text-decoration: none;">
                  <?php if (has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail('custom-size', ['class' => 'w-full']); ?>
                  <?php endif; ?>
                  <div class="ml-5">
                    <div class="flex items-center my-5">
                      <?php
                        $author_id = get_the_author_meta('ID');
                        $avatar_url = get_avatar_url($author_id, ['size' => 40]);
                        echo '<img src="' . esc_url($avatar_url) . '" alt="Avatar of ' . get_the_author() . '" style="border-radius: 50%;">';
                      ?>
                      <div class="text-sm ml-5">
                        <a href="{{ get_author_posts_url($author_id) }}" rel="author" class="fn text-gray-900 leading-none">
                          <?php echo get_the_author() ?>
                        </a><br>
                        <time class="updated text-gray-600 mt-5" datetime="<?php echo esc_attr(get_post_time('c', true)); ?>"><?php echo esc_html(get_the_date()); ?></time>
                      </div>
                    </div>
                  </div>
                  <div class="px-6 py-4">
                      <div class="font-bold text-xl mb-2" style="max-height: 3.6em; overflow: hidden; text-overflow: ellipsis;">
                          <a href="<?php echo esc_url(get_permalink()); ?>" style="text-decoration: none;"><?php the_title(); ?></a>
                      </div>
                  </div>
              </a>
          </div>
      </div>
      @php } @endphp
    </div>
    <div class="archive-category mx-auto w-1/5">
      <button class="button btn-load-more" data-category-id="{!! $category_ids_str; !!}" data-post-id="{!! $current_post_id; !!}" data-category="{!! $category_name; !!}" id="load-more" style="vertical-align:middle"><span>Show more </span></button>
    </div>
    @php } @endphp
</div>
<footer>
  <!-- {!! wp_link_pages([
      'echo' => 0,
      'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'),
      'after' => '</p></nav>'
    ]) !!} -->
</footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</div>