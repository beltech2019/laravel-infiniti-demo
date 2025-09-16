<footer class=" footer-main">
        <div class=" container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="logo-footer">
                        <img src="{{ getBannerPath('Logo')}}">
                        <p>{{ __('message2.INFINITI_DESCRIPTION') }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="quicklinks">
                        <div class="heaidng-links">
                            <h4>{{ __('message2.QUICK_LINKS') }}</h4>
                        </div>
                        <ul>
                            @if(articlesview('Results'))
                            <li><a href="{{ route('articals.results') }}"><i class="bi bi-chevron-right"></i> {{ __('message2.RESULTS') }}</a></li>
                            @endif
                            @if(articlesview('How To Play'))
                            <li><a href="{{ route('articals.howtoplay') }}"><i class="bi bi-chevron-right"></i> {{ __('message2.HOW_TO_PLAY') }}</a></li>
                            @endif
                            @if(articlesview('Permotions'))
                            <li><a href="{{ route('articals.promotions') }}"><i class="bi bi-chevron-right"></i> {{ __('message2.PROMOTIONS') }}</a></li>
                            @endif
                            @if(articlesview('News'))
                            <li><a href="{{ route('articals.news') }}"><i class="bi bi-chevron-right"></i> {{ __('message2.NEWS') }}</a></li>
                            @endif
                            @if(articlesview('Our Retailer'))
                            <li><a href="{{ route('articals.ourRetailers') }}"><i class="bi bi-chevron-right"></i> {{ __('message2.OUR_RETAILER') }}</a></li>
                            @endif
                            @if(articlesview('FAQ'))
                            <li>
                                <a href="{{ route('articals.faqs') }}">
                                    <i class="bi bi-chevron-right"></i> {{ __('message2.FAQ') }}
                                </a>
                            </li>
                            @endif
                            
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
   <div class="quicklinks">
                        <div class="heaidng-links">
                            <h4>{{ __('message2.MORE_LINKS') }}</h4>
                        </div>
                        <ul>
                            @if(articlesview('Contact Us'))
                            <li><a href="#"><i class="bi bi-chevron-right"></i> {{ __('message2.CONTACT_US') }}</a></li>
                            @endif
                            @if(articlesview('Responsible Gaming'))
                            <li><a href="{{route('articals.responsibleGaming')}}"><i class="bi bi-chevron-right"></i> {{ __('message2.RESPONSIBLE_GAMING') }}</a></li>
                            @endif
                             @if(articlesview('Privacy Policy'))
                            <li><a href="{{route('articals.privacyPolicy')}}"><i class="bi bi-chevron-right"></i> {{ __('message2.PRIVACY_POLICY') }}</a></li>
                            @endif
                            @if(articlesview('Cookie Policy'))
                            <li><a href="{{route('articals.cookiePolicy')}}"><i class="bi bi-chevron-right"></i> {{ __('message2.COOKIE_POLICY') }}</a></li>
                            @endif
                            @if(articlesview('Tearms & Conditions'))

                            <li><a href="{{route('articals.termsandcondition')}}"><i class="bi bi-chevron-right"></i> {{ __('message2.TERMS_CONDITIONS') }}</a></li>
                            @endif
                            

                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="partner-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-8">
                    <div class="partner-logo">
                        <ul>
                            <li><img src="{{ asset('images/payment-icons/visa.png')}}" alt="VISA"></li>
                            <li><img src="{{ asset('images/payment-icons/mastercard.png')}}" alt="MasterCard"></li>
                            <li><img src="{{ asset('images/payment-icons/paypal.png')}}" alt="PayPal"></li>
                            <li><img src="{{ asset('images/payment-icons/ecopayz.png')}}" alt="EcoPayz"></li>
                            <li><img src="{{ asset('images/payment-icons/neteller.png')}}" alt="Neteller"></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                      <div class="partner-logo">
                        <ul class="float-end">
                            <li><img src="{{ asset('images/misc/18plusIcon_white.png')}}" class="size-icons"></li>
                            <li><img src="{{ asset('images/misc/secureIcon_white.png')}}" class="size-icons"></li>
                
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="social-icons">
            <div class="contianer-fluid">
                <ul>
                    <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                    <li><a href="#"><i class="bi bi-twitter"></i></a></li>
                    <li><a href="#"><i class="bi bi-pinterest"></i></a></li>
                    <li><a href="#"><i class="bi bi-youtube"></i></a></li>
                </ul>
                <p>{{ __('message2.COPYRIGHT_DECRIPTION') }}</p>
            </div>
        </div>
    </footer>