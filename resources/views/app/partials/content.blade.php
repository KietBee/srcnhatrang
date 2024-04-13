@php
  $current_categories = get_the_terms(get_the_ID(), 'category_pets');
@endphp
<article @php post_class() @endphp>
  <div class="max-w-sm rounded overflow-hidden shadow-lg h-390">
    @if (has_post_thumbnail())
      {{ the_post_thumbnail('custom-size', ['class' => 'w-full']) }}
    @endif
    <div class="ml-5">@include('partials/entry-meta')</div>
  <div class="px-6 py-4">
    <div class="font-bold text-xl mb-2" style="max-height: 3.6em; overflow: hidden; text-overflow: ellipsis;">
      <a href="{{ get_permalink() }}" style="text-decoration: none;">{!! get_the_title() !!}</a>
    </div>

    <p class="text-gray-700 text-base">
      @php the_excerpt() @endphp
    </p>
  </div>
  <div class="px-6 pt-4 pb-2">
    @php 
      if ($current_categories && !is_wp_error($current_categories)) {
        $current_categories_links = '';

        foreach ($current_categories as $category) {
          $current_categories_links .= '<a href="' . esc_url(get_term_link($category)) . '">#' . esc_html($category->name) . '</a>, ';
        }
        $current_categories_links = rtrim($current_categories_links, ', ');

        echo '<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">'.$current_categories_links.'</span>';
      }
    @endphp
  </div>
</div>
</article>
