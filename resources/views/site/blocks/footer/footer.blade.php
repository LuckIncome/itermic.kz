<footer class="footer">
    <div class="footer__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    {!! getPage('col-footer-description') !!}
                </div>

                <div class="col-lg-9">
                    {!! getLinks('col-footer-menu') !!}
                </div>
            </div>
        </div>
    </div><!-- /.footer__top -->

    <div class="footer__bottom">
        <div class="container">
            <div class="row justify-content-between">
                <div class="footer__bottom-col">
                    {!! str_ireplace('[year]', date('Y'), strip_tags(getPage('col-footer-copyright'))) !!}
                </div>

                <div class="footer__bottom-col">
                    {!! strip_tags(getPage('col-footer-privacy-policy'), '<a>') !!}
                </div>

                <div class="footer__bottom-col footer__dev">
                    <a href="#">{!! icon('icon--marketing') !!}</a>
                </div>
            </div>
        </div>
    </div><!-- /.footer__bottom -->
</footer>
