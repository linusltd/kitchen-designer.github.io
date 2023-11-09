<footer class="footer-wrapper common-bg">

    <!-- footer widget area start -->
    <div class="footer-widget-area">
        <div class="container">
            <div class="footer-widget-inner section-space">
                <div class="row mbn-30">
                    <!-- footer widget item start -->
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="footer-widget-item mb-30">
                            <div class="footer-widget-logo">
                                <a href="index.html">
                                    <img src="{{ asset('storage/' . $general->footer_logo) }}" alt="">
                                </a>
                            </div>
                            <ul class="footer-widget-body">
                                <li class="widget-text">We are a team of designers and developers that create high
                                    quality Magento, Prestashop, Opencart</li>
                                <li class="address">
                                    <em>address:</em>
                                    {{ $general->address }}
                                </li>
                                <li class="email">
                                    <em>e-mail:</em>
                                    <a href="mailto:{{ $general->footer_logo }}">{{ $general->email }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- footer widget item end -->

                    <!-- footer widget item start -->
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget-item mb-30">
                            <div class="footer-widget-title">
                                <h5>Company</h5>
                            </div>
                            <ul class="footer-widget-body">
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Delivery Information</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- footer widget item end -->

                    <!-- footer widget item start -->
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget-item mb-30">
                            <div class="footer-widget-title">
                                <h5>Popular Categories</h5>
                            </div>
                            <ul class="footer-widget-body">
                                <li><a href="#">Kitchen & Dining</a></li>
                                <li><a href="#">Dish Racks</a></li>
                                <li><a href="#">Wood Wave</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- footer widget item end -->

                    <!-- footer widget item start -->
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="footer-widget-item mb-30">
                            <div class="footer-widget-title">
                                <h5>social</h5>
                            </div>
                            <div class="footer-widget-body">
                                <!-- newsletter area start -->
                                <div class="newsletter-inner">
                                    <!-- mailchimp-alerts Start -->
                                    <div class="mailchimp-alerts">
                                        <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                        <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                        <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                                    </div>
                                    <!-- mailchimp-alerts end -->
                                </div>
                                <!-- newsletter area start -->

                                <!-- footer widget social link start -->
                                <div class="footer-social-link">
                                    <a href="{{ $general->facebook }}" class="facebook" data-bs-toggle="tooltip"
                                        title="Facebook"><i class="fa fa-facebook"></i></a>
                                    <a href="{{ $general->twitter }}" class="twitter" data-bs-toggle="tooltip"
                                        title="Twitter"><i class="fa fa-twitter"></i></a>
                                    <a href="{{ $general->instagram }}" class="instagram" data-bs-toggle="tooltip"
                                        title="Instagram"><i class="fa fa-instagram"></i></a>
                                </div>
                                <!-- footer widget social link end -->
                            </div>
                        </div>
                    </div>
                    <!-- footer widget item end -->
                </div>
            </div>
        </div>
    </div>
    <!-- footer widget area end -->

    <!-- footer bottom area start -->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-2 order-md-1">
                    <div class="copyright-text">
                        <p>&copy; {{ date('Y') }} <b>{{ $general->name }}</b> All rights reserved.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 order-1 order-md-2">
                    <div class="payment-method">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom area end -->

</footer>
