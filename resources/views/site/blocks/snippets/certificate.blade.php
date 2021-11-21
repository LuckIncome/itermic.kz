@if (!is_null($record->cover))
    <div class="certificate{{ isset($certificateIsSlide) ? ' mb-0' : ' col-md-4 col-lg-3 col-xl-4' }}">
        <a
            class="certificate__link"
            href="/{{ $record->cover->link }}"
            data-lg
        >
            <div
                class="certificate__image"
                @if (isset($certificateIsSlide))
                    style="background-image: url('/image/resize/187/264/{{ $record->cover->link }}')"
                @else
                    style="background-image: url('/image/resize/213/302/{{ $record->cover->link }}')"
                @endif
            ></div>
            <div class="certificate__overlay">{!! icon('icon--magnifier') !!}</div>
        </a>
    </div>
@endif

