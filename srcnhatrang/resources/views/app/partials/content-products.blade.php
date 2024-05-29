<article @php post_class() @endphp>
  <div class="lg:max-w-sm w-full rounded overflow-hidden shadow-lg h-325 bg-white">
    <a href="{{ get_permalink() }}" style="text-decoration: none;">
      <div class="h-1/2">
        @if (has_post_thumbnail())
          <img src="{{ get_the_post_thumbnail_url(null, 'full') }}" alt="{{ get_the_title() }}" class="featured-image w-full h-full object-cover object-top">
        @endif
      </div>
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2" style="max-height: 3.6em; overflow: hidden; text-overflow: ellipsis;">
          <a href="{{ get_permalink() }}" style="text-decoration: none;">{!! get_the_title() !!}</a>
        </div>
        <div class="text-gray-700 text-base product-info">
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
      </div>
  </a>
</div>
</article>
