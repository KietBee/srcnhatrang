@php
  $category_name = 'category_products';
  $current_categories = get_the_terms(get_the_ID(), $category_name);
  $current_post_id = get_the_ID();
@endphp
<div class="container pt-10 bg-white">
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
  <div class="row py-10">
    <div class="col w-1/2">
    @if (has_post_thumbnail())
      <img src="{{ get_the_post_thumbnail_url(null, 'full') }}" alt="{{ get_the_title() }}" class="featured-image w-2/3 mx-auto">
    @endif
    </div>
    <div class="col w-1/2">
      <div class="product-info">
        <h4 class="entry-title mb-10 leading-50 font-bold">{!! get_the_title() !!}</h4>
        {!! the_content() !!}
      </div>
      <div class="py-4">
      @if ($current_categories && !is_wp_error($current_categories))
        @php
            $current_categories_links = '';
        @endphp
        @foreach ($current_categories as $category)
            @php
                $current_categories_links .= '<span class="inline-block current-categories mr-2 mb-2"><a href="' . esc_url(get_term_link($category)) . '" class="no-underline">#' . esc_html($category->name) . '</a></span>';
            @endphp
        @endforeach
        {!! '<p>'.$current_categories_links.'</p>' !!}
      @endif
      </div>
      <div class="archive-category mx-auto w-1/3">
        <button class="button btn-load-more" style="vertical-align:middle"><span>Add to card</span></button>
      </div>
    </div>
  </div>
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