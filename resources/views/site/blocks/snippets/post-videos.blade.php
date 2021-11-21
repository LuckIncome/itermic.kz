@if ($videos->count())
    <ul class="post-videos mt-7">
        @foreach ($videos as $video)
            <li class="post-videos__item ratio">
                <iframe
                    src="https://www.youtube.com/embed/{{ getCodeVideo($video->link) }}?rel=0"
                    frameborder="0"
                    allow="autoplay; encrypted-media"
                    allowfullscreen
                ></iframe>
            </li>
        @endforeach
    </ul>
@endif
