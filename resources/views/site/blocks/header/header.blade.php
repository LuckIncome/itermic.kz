<header class="header">
    <div class="container d-flex align-items-center justify-content-between align-items-xl-stretch justify-content-xl-start">
        <div class="header__logo">
            <a href="/">
                <img src="/site/images/logo.png" alt="{{ strip_tags($settings['title']) }}">
            </a>
        </div><!-- /.header__logo -->

        @php $headerSlogan = getPage('col-header-slogan'); @endphp

        <div class="header__slogan header__slogan--mb d-none d-lg-block d-xl-none m-0">
            {!! strip_tags($headerSlogan, '<span><strong>') !!}
        </div><!-- /.header__slogan -->

        <div class="header__main js-header-main">
            <h1 class="header__slogan d-lg-none d-xl-block">
                {!! strip_tags($headerSlogan, '<span><strong>') !!}
            </h1>

            @php $headerPhones = getPage('col-header-phones'); @endphp

            @if ($headerPhones)
                <div class="header__phones">
                    {!! strip_tags($headerPhones, '<a><span><strong>') !!}
                </div>
            @endif

            @include('site.blocks.nav')
        </div><!-- /.header__main -->

        <button class="header-hamburger js-header-hamburger ml-5 d-xl-none">
            <i class="header-hamburger__line"></i>
        </button><!-- /.header-hamburger -->
    </div>
</header>
