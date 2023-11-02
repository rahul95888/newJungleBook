<?php
use App\Models\Equipment;
    $datas = Equipment::get();
?>
<header id="masthead" class="site-header">
     
            <!-- header html start -->
            <div class="top-header">
               <div class="container">
                  <div class="top-header-inner">
                    <div class="header-contact text-left">
                       <!-- 
                        <a href="telto:+919636038657">
                           <i aria-hidden="true" class="icon icon-phone-call2"></i>
                           <div class="header-contact-details d-none d-sm-block">
                              <span class="contact-label">For Further Inquires :</span>
                              <h5 class="header-contact-no">+91 96360 38657</h5>
                           </div>
                        </a> 	-->
									
                     </div>
                     <div class="site-logo1 text-center">
                     <a href="/" class="text-success">
                           
                           
                           <img src="{{ asset('1.png') }}" alt="Logo">  
                         </a>
                     </div>
                     <div class="header-icon text-right">
                        <!-- <div class="header-search-icon d-inline-block">
                           <a href="#">
                              <i aria-hidden="true" class="fas fa-search"></i>
                           </a>
                        </div> -->
                        
                     </div>
                  </div>
               </div>
            </div>
            <div class="bottom-header">
               <div class="container">
                  <div class="bottom-header-inner d-flex justify-content-center align-items-center">
                     <!--  <div class="header-social social-icon">
                                
                        <ul>
                           <li>
                              <a href="https://www.facebook.com/" target="_blank">
                                 <i class="fab fa-facebook-f" aria-hidden="true"></i>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.twitter.com/" target="_blank">
                                 <i class="fab fa-twitter" aria-hidden="true"></i>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.youtube.com/" target="_blank">
                                 <i class="fab fa-youtube" aria-hidden="true"></i>
                              </a>
                           </li>
                        </ul>
								
                     </div>-->
                     <div class="navigation-container d-none d-lg-block">
                        <nav id="navigation" class="navigation">
                           <ul>
                              <li class="menu-active">
                                 <a href="{{URL::to('/')}}">Home</a>
                              </li>
                              <li>
                                 <a href="{{URL::to('/about')}}">about us</a>
                              </li>
                              <li>
                                 <a href="{{URL::to('/our-services')}}">Our Services</a>
                              </li>

                              <li>
                                 <a href="{{URL::to('/our-packages')}}">Our Packages</a>
                              </li>

                              <li>
                                 <a href="{{URL::to('/blogs')}}">Blogs</a>
                              </li>
                              <li>
                                 <a href="{{URL::to('/contact')}}">contact us</a>
                              </li>
                           </ul>
                        </nav>
                     </div>
                     
                  </div>
               </div>
            </div>
            <div class="mobile-menu-container"></div>
         </header>

        
         
       
