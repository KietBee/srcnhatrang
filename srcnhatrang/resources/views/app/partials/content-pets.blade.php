<article @php post_class() @endphp>
  <div class="lg:max-w-sm w-full rounded overflow-hidden shadow-lg h-325 bg-white">
    <a href="{{ get_permalink() }}" style="text-decoration: none;">
      @if (has_post_thumbnail())
        {{ the_post_thumbnail('custom-size', ['class' => 'w-full']) }}
      @endif
      <div class="ml-5">@include('partials/entry-meta')</div>
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2" style="max-height: 3.6em; overflow: hidden; text-overflow: ellipsis;">
          <a href="{{ get_permalink() }}" style="text-decoration: none;">{!! get_the_title() !!}</a>
        </div>

        <div class="text-gray-700 text-base down_lg:hidden">
          @php the_excerpt() @endphp
        </div>
      </div>
  </a>
</div>
</article>
