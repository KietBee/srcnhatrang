@php
  $current_categories = get_the_terms(get_the_ID(), 'category_pets');
@endphp
<div class="container mt-20" @php post_class() @endphp>
  <div class="row">
    <div class="col w-4/5 shadow-lg down_lg:w-full ">
      <header>
        <div class="row">
          @php  var_dump(get_post_type());  @endphp
          <div class="col w-2/5 down_lg:w-full">
            @if (has_post_thumbnail())
              {{ the_post_thumbnail('custom-size', ['class' => 'featured-image down_lg:w-full']) }}
            @endif
          </div>
          <div class=" col pl-10 w-3/5 down_lg:w-full">
            <h2 class="entry-title my-10">{!! get_the_title() !!}</h2>
            @include('partials/entry-meta')
              @php 
                if ($current_categories && !is_wp_error($current_categories)) {
                  $current_categories_links = '';

                  foreach ($current_categories as $category) {
                    $current_categories_links .= '<a href="' . esc_url(get_term_link($category)) . '">#' . esc_html($category->name) . '</a>, ';
                  }
                  $current_categories_links = rtrim($current_categories_links, ', ');

                  echo '<p>Current Categories: ' . $current_categories_links . '</p>';
                }
              @endphp
          </div>
        </div>
      </header>
      <div class="entry-content">
        @php the_content() @endphp
      </div>
    </div>
    <div class="col w-1/5 shadow-lg down_lg:w-full">
      <div>
        @php 
          $all_categories = get_categories(array('taxonomy' => 'category_pets'));
          
          if ($all_categories && !is_wp_error($all_categories)) {
            echo '<h4 class="">Categories:</h4>';
            echo '<ul>';
              foreach ($all_categories as $category) {
                echo '<li><a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a></li>';
              }
            echo '</ul>';
            
          }
        @endphp
      </div>
      <hr>
      <div>
        @php 
          if ($current_categories && !is_wp_error($current_categories)) {
            $category_ids = wp_list_pluck($current_categories, 'term_id');
            $args = array(
              'post_type' => get_post_type(),
              'posts_per_page' => 3,
              'tax_query' => array(
                array(
                  'taxonomy' => 'category_pets',
                  'field' => 'id',
                  'terms' => $category_ids,
                ),
              ),
              'post__not_in' => array(get_the_ID()),
            );
        
            $related_posts = get_posts($args);
          }
        @endphp
        @if ($related_posts)
          <div class="related-posts">
            <h4 class="">Related posts</h4>
            <ul>
              @foreach ($related_posts as $post)
                <li>
                  <a href="{{ get_permalink($post->ID) }}">{{ get_the_title($post->ID) }}</a>
                </li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
    </div>
  </div>
  <footer>
    {!! wp_link_pages([
      'echo' => 0,
      'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'),
      'after' => '</p></nav>'
    ]) !!}
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</div>
