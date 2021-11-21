<!-- Scripts -->
<script src="{{ mix('/site/cache/jquery.js') }}"></script>
{{--<script src="/site/vendor/jquery-migrate/jquery-migrate-3.3.0.min.js"></script>--}}
<script src="{{ mix('/site/cache/vendor.js') }}"></script>
@stack('vendor-js')

<script src="{{ mix('/site/cache/app.js') }}"></script>
@stack('js')
