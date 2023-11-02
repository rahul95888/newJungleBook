<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		 



        <link rel="icon" type="image/png" href="{{URL::to('assets/web/images/favicon.png')}}">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{URL::to('assets/web/vendors/bootstrap/css/bootstrap.min.css')}}" media="all">
      <!-- jquery-ui css -->
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/vendors/jquery-ui/jquery-ui.min.css')}}">
      <!-- fancybox box css -->
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/vendors/fancybox/dist/jquery.fancybox.min.css')}}">
      <!-- Fonts Awesome CSS -->
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/vendors/fontawesome/css/all.min.css')}}">
      <!-- Elmentkit Icon CSS -->
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/vendors/elementskit-icon-pack/assets/css/ekiticons.css')}}">
      <!-- slick slider css -->
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/vendors/slick/slick.css')}}">
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/vendors/slick/slick-theme.css')}}">
      <!-- google fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&amp;display=swap" rel="stylesheet">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/style.css')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>
	</head>
    <body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

<!-- Body main wrapper start -->
<div id="page" class="page">

    <!-- HEADER AREA START (header-5) -->
    @include('layouts.webnavigtion')
    <main id="content" class="site-main">
            <section class="inner-page-wrap">
               <!-- ***Inner Banner html start form here*** -->
               <div class="inner-banner-wrap">
                  <div class="inner-baner-container" style="background-image: url({{url('assets/web/images/about-wallpaper.jpeg')}});">
                     <div class="container">
                        <div class="inner-banner-content">
                           <h1 class="page-title">About Us</h1>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="inner-about-wrap">
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-8">
                           <div class="about-content">
                              <figure class="about-image">
                                 <img src="assets/web/images/img27.jpg" alt="">
                                 <div class="about-image-content">
                                    <h3>Explore Earth, Leave Footprints !</h3>
                                 </div>
                              </figure>
                              <h2>JungleBookTourism</h2>
                              <p style='text-align:justify;'>
                              “Travel is the main thing you purchase that makes you more extravagant”. We, at <b>‘JungleBookTourism’</b>, swear by this and put stock in satisfying travel dreams that make you perpetually rich constantly. We have been moving excellent encounters for a considerable length of time through our cutting-edge planned occasion bundles and other fundamental travel administrations. We rouse our clients to carry on with a rich life, brimming with extraordinary travel encounters.
 </p>
                              <p style='text-align:justify;'>Through our exceptionally curated occasion bundles, we need to take you on an adventure where you personally enjoy the stunning magnificence of Around the World. We need you to observe sensational scenes that are a long way past your creative ability.</p>

                              <p style='text-align:justify;'>
                              Our mission is to make it easier for everyone to explore the world and leave footprints. We set out to do things differently and Dedicatedly to making travel as simple and fun as possible, we help each and every one of them find the best options across flights, hotels and car hire to book the perfect trip. Travel is one of life's greatest pleasures and we want each generation to be able to experience that joy. We are giving 24X7 services to our Customers around the globe. We live and love travel and welcome the opportunity to show you how we can help you travel better. Our Dedicated Trip advisors are an experts who understand your travels needs and accordingly & they will help you to get the priceless experiences you want to have. We offer the best limits on our top-rated visit bundles to clients who pick our viable administrations over and over. How about we remind you indeed that we don’t expect to be your visit and travel specialists; we endeavor to be your vacation accomplices until the end of time.
                              </p>
                           </div>
                            
                        </div>
                        <div class="col-lg-4">
                           <div class="icon-box">
                              <div class="box-icon">
                                 <i aria-hidden="true" class="fas fa-umbrella-beach"></i>
                              </div>
                              <div class="icon-box-content">
                                 <h3>AFFORDABLE TOURS</h3>
                                 <p >Affordable travel and holidays have always been in high-demand, more so amongst all travellers. We as a travel company has recently has observed a growing demand for pocket-friendly destinations, in particular to plan a trip that offers a range of exciting experiences, cuisines, and more, on a budget.</p>
                              </div>
                           </div>
                           <div class="icon-box">
                              <div class="box-icon">
                                 <i aria-hidden="true" class="fas fa-user-tag"></i>
                              </div>
                              <div class="icon-box-content">
                                 <h3>BEST TOUR GUIDES</h3>
                                 <p>We have a team of highly professionals with having skills like great communication, Planning, organising etcand they will help you to get the best travel experienced anywhere around the world.</p>
                              </div>
                           </div>
                           <div class="icon-box">
                              <div class="box-icon">
                                 <i aria-hidden="true" class="fas fa-headset"></i>
                              </div>
                              <div class="icon-box-content">
                                 <h3>24x7 HELPDESK</h3>
                                 <p>We have dedicated and experienced travel professionals who are available 24X7 for you and they will help you in any best and possible ways to assist you.</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- ***about section html start form here*** -->
               <!-- ***callback section html start form here*** -->
               <div class="bg-img-fullcallback" style="background-image: url({{url('assets/web/images/img7.jpg')}})">
                  <div class="overlay"></div>
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2 text-center">
                           <div class="callback-content">
                              <div class="video-button">
                                 <a  id="video-container" data-fancybox="video-gallery" href="https://www.youtube.com/watch?v=rgTikvsvc4Y">
                                    <i class="fas fa-play"></i>
                                 </a>
                              </div>
                              <h2 class="section-title">ARE YOU READY TO TRAVEL? REMEMBER US !!</h2>
                            
                              <div class="callback-btn">
                    <a href="{{URL::to('/our-packages')}}" class="round-btn">View Packages</a>
                    <a href="{{URL::to('/about')}}" class="outline-btn outline-btn-white"
                      >Learn More</a
                    >
                  </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- ***callback section html end here*** -->
            </section>
         </main>

    @include('layouts.webfooter')

</div>
<!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

    <!-- All JS Plugins -->
    <script src="js/plugins.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>
  
</body>
</html>
