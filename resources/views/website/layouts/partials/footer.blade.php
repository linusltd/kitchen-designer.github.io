 <!-- Footer -->
 <footer class="footer">
    <div class="container footer__container">
        <div class="footer__introduction">
            <div class="footer__logo__wrapper">
                <img src="{{ asset('storage/' . $general->footer_logo) }}" alt="Logo" class="footer__logo">
            </div>
            <p class="footer__address">
                {{ $general->address }}
            </p>
            <a href="mailto:{{$general->footer_logo}}" class="footer__email">{{$general->email}}</a>
        </div>
        <div class="footer__info">
            <h3 class="footer__info-title">
                Company
            </h3>
            <ul class="footer__info-links">
                <li><a href="#">About us</a></li>
                <li><a href="#">Delivery Information</a></li>
                <li><a href="#">Privacy Policy</a></li>
            </ul>
        </div>
        <div class="footer__info">
            <h3 class="footer__info-title">
                Poupulat Categories
            </h3>
            <ul class="footer__info-links">
                <li><a href="#">Kitchen & Dining</a></li>
                <li><a href="#">Dish Racks</a></li>
                <li><a href="#">Wood Wave</a></li>
            </ul>
        </div>
        <div class="footer__info">
            <h3 class="footer__info-title">
                Follow us
            </h3>
            <div class="footer__social-links">
                <a href="{{ $general->twitter }}" target="_blank">
                    <img src="{{ asset('assets/website') }}/images/fb-soc.svg" alt="Facebook">
                </a>
                <a href="{{ $general->instagram }}" target="_blank">
                    <img src="{{ asset('assets/website') }}/images/insta-soc.svg" alt="Instagram">
                </a>
                <a href="{{ $general->facebook }}" target="_blank">
                    <img src="{{ asset('assets/website') }}/images/twit-soc.svg" alt="Twitter">
                </a>
            </div>
        </div>
    </div>
    <p class="footer__rights">
        Copyright {{ date('Y') }} {{ $general->name }}. All rights reserved.
    </p>

</footer>

<!-- /Footer -->
