@if ($files->count())
    <ul class="post-files mt-7">
        @foreach ($files as $file)
            <li class="post-files__item">
                <a
                    class="post-files__link link"
                    href="/file/save/{{ $file->id }}" download
                >{{ $file->title . '.' .  strtolower(formatFile($file->link)) }}</a>
            </li>
        @endforeach
    </ul>
@endif
