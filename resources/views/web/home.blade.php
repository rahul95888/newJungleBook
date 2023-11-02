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

    <body class="home">
    
<div id="page" class="page">

@include('layouts.webnavigtion')

<main id="content" class="site-main">
        <!-- ***home banner html start form here*** -->
        <section class="home-banner-section home-banner-slider">
        @foreach($slider as $data)
        <div
            class="home-banner d-flex flex-wrap align-items-center"
            style="background-image: url({{url('/uploads/slider/'.$data->image)}});">
            <div class="overlay"></div>
            <div class="container">
              <div class="banner-content text-center">
                <div class="row">
                  <div class="col-lg-8 offset-lg-2">
                    <h2 class="banner-title">{{$data->title }}</h2>
                    <p>
                    {{$data->content }}
                    </p>
                    <div class="banner-btn">
                      <!-- <a href="about.html" class="round-btn">LEARN MORE</a> -->
                      <a
                        href="{{URL::to('/contact')}}"
                        class="outline-btn outline-btn-white"
                        >BOOK NOW</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endforeach
         
        </section>
        
        <!-- ***search search field html end here*** -->
        <!-- ***Home destination html start from here*** -->
        
        <!-- ***Home destination html end here*** -->
        <!-- ***Home package html start from here*** -->
        <section class="home-destination">
          <div class="container">
            <div class="row">
              <div class="col-lg-8 offset-lg-2 text-sm-center">
                <div class="section-heading">
                  <h5 class="sub-title">Latest PACKAGES</h5>
                  <h2 class="section-title">CHECKOUT OUR LATEST PACKAGES</h2>
                 
                </div>
              </div>
            </div>
            <div class="package-section">
              @foreach($latestPackage as $value)
              <article class="package-item">
                <figure
                  class="package-image"
                  style="background-image: url({{url('/uploads/property/'.$value->thumb)}});"
                ></figure>

                
                <div class="package-content">
                  <h3>
                    <a href="{{URL::to('/package-details/'.$value->id)}}">
                    {{$value->equipment_name}}
                    </a>
                  </h3>
                  <p>
                  {!! \Illuminate\Support\Str::limit(html_entity_decode($value->description), 50) !!}
                  </p>
                  <div class="package-meta">
                  <ul>
                                 <li>
                                    <i class="fas fa-clock"></i>
                                    {{$value->bedroom}}
                                 </li>
                                 <li>
                                    <i class="fas fa-user-friends"></i>
                                    pax: {{$value->total_area}}
                                 </li>
                                 <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{$value->google_location}}
                                 </li>
                              </ul>
                  </div>
                </div>
                <div class="package-price">
                   
                  <h6 class="price-list">
                  <span>{{$value->bathroom}} {{$value->lounge}}</span>
                    / per person
                  </h6>
                  <a href="{{URL::to('/contact')}}" class="outline-btn outline-btn-white"
                    >Book now</a
                  >
                </div>
              </article>
              @endforeach
              <div class="section-btn-wrap text-center">
                <a href="{{URL::to('/our-packages')}}" class="round-btn">VIEW ALL PACKAGES</a>
              </div>
            </div>
          </div>
        </section>
        <!-- ***Home package html end here*** -->
        <!-- ***Home callback html start from here*** -->
        <section
          class="home-callback bg-img-fullcallback"
          style="background-image: url({{url('assets/web/images/tiger-background.jpeg')}})"
        >
          <div class="overlay"></div>
          <div class="container">
            <div class="row">
              <div class="col-lg-8 offset-lg-2 text-center">
                <div class="callback-content">
                  <div class="video-button">
                    <a
                      id="video-container"
                      data-fancybox="video-gallery"
                      href="https://www.youtube.com/watch?v=rgTikvsvc4Y"
                    >
                      <i class="fas fa-play"></i>
                    </a>
                  </div>
                  <h2 class="section-title">
                    ARE YOU READY TO TRAVEL? REMEMBER US !!
                  </h2>
                 
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
        </section>
        <!-- ***Home callback html end here*** -->
        <!-- ***Home counter html start from here*** -->
        <div class="home-counter">
          <div class="container">
            <div class="counter-wrap">
              <div class="counter-item">
                <span class="counter-no">
                  <span class="counter">80</span>K+
                </span>
                <span class="counter-desc"> SATISFIED CUSTOMER </span>
              </div>
              <div class="counter-item">
                <span class="counter-no">
                  <span class="counter">18</span>+
                </span>
                <span class="counter-desc"> ACTIVE MEMBERS </span>
              </div>
              <div class="counter-item">
                <span class="counter-no">
                  <span class="counter">220</span>+
                </span>
                <span class="counter-desc"> TOUR DESTINATION </span>
              </div>
              <div class="counter-item">
                <span class="counter-no">
                  <span class="counter">75</span>+
                </span>
                <span class="counter-desc"> TRAVEL GUIDES </span>
              </div>
            </div>
          </div>
        </div>
        <!-- ***Home counter html end here*** -->
        <!-- ***Home offer html start from here*** -->
        <section class="home-offer">
          <div class="container">
            <div class="row">
              <div class="col-lg-8 offset-lg-2 text-sm-center">
                <div class="section-heading">
                  <h2 class="section-title">OUR SPECIAL PACKAGES</h2>
                 
                </div>
              </div>
            </div>
            <div class="offer-section">
              <div class="row">
                @foreach($FeaturedPackage as $value)
                <div class="col-md-6">
                  <article
                    class="offer-item"
                    style="background-image: url({{url('/uploads/property/'.$value->thumb)}});"
                  >
                    <div class="offer-badge">Featured</div>
                    <div class="offer-content">
                      <div class="package-meta">
                      <ul>
                                 <li>
                                    <i class="fas fa-clock"></i>
                                    {{$value->bedroom}}
                                 </li>
                                 <li>
                                    <i class="fas fa-user-friends"></i>
                                    pax: {{$value->total_area}}
                                 </li>
                                 <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{$value->google_location}}
                                 </li>
                              </ul>
                      </div>
                      <h3>
                        <a href="{{URL::to('/package-details/'.$value->id)}}">{{$value->equipment_name}}</a>
                      </h3>
                      <p>
                      {!! \Illuminate\Support\Str::limit(html_entity_decode($value->description), 50) !!}
                      </p>
                      <div class="price-list">
                        price:
                        <!-- <del>$1300 </del> -->
                        <ins>{{$value->lounge}}</ins>
                      </div>
                      <a href="{{URL::to('/package-details/'.$value->id)}}" class="round-btn">View Details</a>
                    </div>
                  </article>
                </div>
                @endforeach

                 
              </div>
              <div class="section-btn-wrap text-center">
                <a href="{{URL::to('/our-packages/')}}" class="round-btn"
                  >VIEW ALL PACKAGES</a
                >
              </div>
            </div>
          </div>
        </section>
        
        <section
          class="home-client client-section pt-0"
          style="background-image: url(assets/web/images/banner-img1.jpg)"
        >
          <div class="container">
            <div class="row align-items-center ">
              <div class="col-lg-6">
                <div class="client-content">
                  <h5 class="sub-title">DISCOUNT OFFER</h5>
                  <h2 class="section-title">
                    GET SPECIAL DISCOUNT!
                  </h2>
                  <p>
                  Get Special Discount, For more Details contact us.
                  </p>
                  <a href="{{URL::to('/contact')}}" class="round-btn">Contact Us</a>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="client-logo">
                <img src="assets/web/images/banner-flex.gif" alt="" class='img-50' />
                  
                </div>
              </div>
            </div>
          </div>
          <div class="overlay"></div>
        </section>
        <!-- ***Home client html end here*** -->
        <!-- ***Home blog html start from here*** -->
        <section class="home-blog">
          <div class="container">
            <div
              class="section-heading d-sm-flex align-items-center justify-content-between"
            >
              <div class="heading-group">
                <h5 class="sub-title">LATEST BLOG</h5>
                <h2 class="section-title">OUR RECENT POSTS</h2>
               
              </div>
              <div class="heading-btn">
                <a href="{{URL::to('/blogs')}}" class="round-btn">View All Blog</a>
              </div>
            </div>
            <div class="blog-section">
              <div class="row gx-4">
              @foreach($news as $data)
                <div class="col-lg-6">
                  <article class="post">
                    <figure
                      class="featured-post"
                      style="background-image: url({{URL::to('/uploads/category/'.$data->image)}})"
                    ></figure>
                    <div class="post-content">
                      <div class="cat-meta">
                        <a href="{{URL::to('/blog-details/'.$data->id)}}">{{$data->commodity->name}}</a>
                      </div>
                      <h3>
                        <a href="{{URL::to('/blog-details/'.$data->id)}}"
                          > {!! \Illuminate\Support\Str::limit(html_entity_decode($data->title), 25) !!}</a
                        >
                      </h3>
                      <p>
                      {!! \Illuminate\Support\Str::limit(html_entity_decode($data->content), 100) !!}
                      </p>
                      <div
                        class="post-footer d-flex justify-content-between align-items-center"
                      >
                        <div class="post-btn">
                          <a href="{{URL::to('/blog-details/'.$data->id)}}" class="round-btn"
                            >Read More</a
                          >
                        </div>
                        
                      </div>
                    </div>
                  </article>
                </div>
            @endforeach
                 
              </div>
            </div>
          </div>
        </section>
        <!-- ***Home blog html end here*** -->
        <!-- ***Home testimonial html start from here*** -->
        <section class="home-testimonial">
          <div class="container">
            <div class="row">
              <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-heading">
                  <h5 class="sub-title">CLIENT'S REVIEWS</h5>
                  <h2 class="section-title">TRAVELLER'S TESTIMONIAL</h2>
                 
                </div>
              </div>
            </div>
            <div class="testimonial-section testimonial-slider">
              @foreach($Feedback as $value)
              <div class="testimonial-item">
                <div class="testimonial-content">
                   
                  <p>
                  {{$value->message}}
                  </p>
                  <div class="author-content">
                    <figure class="testimonial-img">
                      <img src="{{URL::to('/uploads/property/'.$value->image)}}" alt="" />
                    </figure>
                    <div class="author-name">
                      <h5> {{$value->feedback_uid}}</h5>
                      <span>{{$value->rate}}</span>
                    </div>
                  </div>
                  <div class="testimonial-icon">
                    <i aria-hidden="true" class="fas fa-quote-left"></i>
                  </div>
                </div>
              </div>
              @endforeach
               
              
            </div>
          </div>
        </section>
        <!-- ***Home testimonial html end here*** -->
        <!-- ***Home callback html start from here*** -->
        <section class="home-callback bg-color-callback primary-bg">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h5 class="sub-title">CALL TO ACTION</h5>
                <h2 class="section-title">
                  READY FOR UNFORGETTABLE TRAVEL. REMEMBER US!
                </h2>
                
              </div>
              <div class="col-md-4 text-md-end">
                <a href="{{URL::to('/contact')}}" class="outline-btn outline-btn-white"
                  >Contact Us !</a
                >
              </div>
            </div>
          </div>
        </section>
         
      </main>    



    
    
    
  
  
    
      

    
     
   
    

  
    @include('layouts.webfooter')
     

  
</body>

</html>
