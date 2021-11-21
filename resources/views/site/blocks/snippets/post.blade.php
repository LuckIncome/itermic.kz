<article class="post">
    <div class="post__meta">
        <time
            class="post__date"
            datetime="{{ date('Y-m-d', strtotime($data->published_at)) }}"
        >{{ formatDate($data->published_at) }}</time>
    </div>

    <div class="post__main">
        @include('site.blocks.snippets.post-images')

        <div class="post__content formatted-body">
            {!! $data->short !!}
            {!! $data->full !!}
        </div>

        @include('site.blocks.snippets.post-videos')
        @include('site.blocks.snippets.post-files')
    </div>
</article>
