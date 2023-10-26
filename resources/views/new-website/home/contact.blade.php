@extends('new-website.new-layouts.new-app')
@section('title', 'Contact Us')
@section('seo')
    <meta property="og:site_name" content="Kitchen Designer">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="Contact Us">
    <meta property="og:type" content="website">
    <meta property="og:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Contact Us">
    <meta name="twitter:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <link rel="canonical" href="{{ Request::url() }}">
    <meta name="description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

@endsection

@section('content')
    @php
        $general = getGeneral();
    @endphp
    <!-- main wrapper start -->
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area common-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('website.home.index') }}"><i
                                            class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">contact us</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- contact area start -->
    <div class="contact-area section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-message">
                        <h2>Tell us your project</h2>
                        @if (Session::has('message'))
                            <span>{{ Session::get('message') }}</span>
                        @endif

                        @error('email')
                            <span class="error">Email is invalid.</span>
                        @enderror
                        <form id="contact-form" action="{{ route('website.home.contact-post') }}" method="post"
                            class="contact-form">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="name" value="{{ old('name') }}" placeholder="Name *" type="text"
                                        required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="phone" value="{{ old('phone') }}" placeholder="Phone *" type="text"
                                        required>
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-6">
                                    <input name="email" value="{{ old('email') }}" placeholder="Email *" type="text"
                                        required>
                                </div>
                                <div class="col-12">
                                    <div class="contact2-textarea text-center">
                                        <textarea placeholder="Message *" name="query" id="query" class="form-control2" required>{{ old('query') }}</textarea>
                                    </div>
                                    <div class="contact-btn">
                                        <button class="btn btn__bg" type="submit">Send Message</button>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <p class="form-messege"></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-info">
                        <h2>contact us</h2>
                        <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum
                            est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum
                            formas human.</p>
                        <ul>
                            <li><i class="fa fa-fax"></i> Address : {{ $general->address }}</li>
                            <li><i class="fa fa-phone"></i> {{ $general->phone }}</li>
                            <li><i class="fa fa-envelope-o"></i> {{ $general->email }}</li>
                        </ul>
                        <div class="working-time">
                            <h3>Working hours</h3>
                            <p>{{ $general->office_timing }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area end -->
    <!-- main wrapper end -->
@endsection
