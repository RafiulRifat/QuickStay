@extends('frontend.main_master')
@section('main')
<!-- Banner Area -->
<div class="banner-area" style="height: 480px;">
            <div class="container">
                <div class="banner-content">
                    <h1>Discover QuickStay Hotel  to Book a Suitable Room</h1>
                    
                     
                </div>
            </div>
        </div>
        <!-- Banner Area End -->

        <!-- Banner Form Area -->
        <div class="banner-form-area">
            <div class="container">
                <div class="banner-form">
                    <form>
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>CHECK IN TIME</label>
                                    <div class="input-group">
                                        <input id="datetimepicker" type="text" class="form-control" placeholder="11/02/2020">
                                        <span class="input-group-addon"></span>
                                    </div>
                                    <i class='bx bxs-chevron-down'></i>	
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>CHECK OUT TIME</label>
                                    <div class="input-group">
                                        <input id="datetimepicker-check" type="text" class="form-control" placeholder="11/02/2020">
                                        <span class="input-group-addon"></span>
                                    </div>
                                    <i class='bx bxs-chevron-down'></i>	
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>GUESTS</label>
                                    <select class="form-control">
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                    </select>	
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <button type="submit" class="default-btn btn-bg-one border-radius-5">
                                    Check Arability
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Banner Form Area End -->

        <!-- Room Area -->
        @include('frontend.home.room_area')
        <!-- Room Area End -->

        <!-- Book Area Two-->
        @include('frontend.home.room_area_two')
        <!-- Book Area Two End -->

        <!-- Services Area Three -->
        @include('frontend.home.services')
        <!-- Services Area Three End -->

        <!-- Team Area Three -->
        <div class="team-area-three pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <span class="sp-color">TEAM</span>
                    <h2>Let's Meet Up With Our Special Team Members</h2>
                </div>
                <div class="team-slider-two owl-carousel owl-theme pt-45">
                    <div class="team-item">
                        <a href="team.html">
                            <img src="assets/img/team/team-img1.jpg" alt="Images">
                        </a>
                        <div class="content">
                            <h3><a href="team.html">MD Rafiul Siddique</a></h3>
                            <span>Manager</span>
                            <ul class="social-link">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                                </li> 
                            </ul>
                        </div>
                    </div>

                    <div class="team-item">
                        <a href="team.html">
                            <img src="assets/img/team/team-img2.jpg" alt="Images">
                        </a>
                        <div class="content">
                            <h3><a href="team.html">Umme Marium Prity</a></h3>
                            <span>Chief Reception Officer</span>
                            <ul class="social-link">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                                </li> 
                            </ul>
                        </div>
                    </div>

                    <div class="team-item">
                        <a href="team.html">
                            <img src="assets/img/team/team-img5.jpg" alt="Images">
                        </a>
                        <div class="content">
                            <h3><a href="team.html">Mahadi Hasan Rubel</a></h3>
                            <span>Housekeeping</span>
                            <ul class="social-link">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                                </li> 
                            </ul>
                        </div>
                    </div>

                    <div class="team-item">
                        <a href="team.html">
                            <img src="assets/img/team/team-img4.jpg" alt="Images">
                        </a>
                        <div class="content">
                            <h3><a href="team.html">Tom Riddle</a></h3>
                            <span>Housekeeping</span>
                            <ul class="social-link">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team Area Three End -->

        <!-- Testimonials Area Three -->
        <div class="testimonials-area-three pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <span class="sp-color">TESTIMONIAL</span>
                    <h2>Our Latest Testimonials and What Our Client Says</h2>
                </div>
                <div class="row align-items-center pt-45">
                    <div class="col-lg-6 col-md-6">
                        <div class="testimonials-img-two">
                            <img src="assets/img/testimonials/testimonials-img5.jpg" alt="Images">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="testimonials-slider-area owl-carousel owl-theme">
                            <div class="testimonials-slider-content">
                                <i class="flaticon-left-quote"></i>
                                <p>
                                QuickStay hotel provided an exceptional experience. The service was top-notch, the rooms were comfortable, and the amenities exceeded my expectations. I highly recommend it for anyone seeking a convenient and luxurious stay.
                                </p>
                                <ul>
                                    <li>
                                        <img src="assets/img/testimonials/testimonials-img1.jpg" alt="Images">
                                        <h3>Elon Musk</h3>
                                        <span>New York City</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="testimonials-slider-content">
                                <i class="flaticon-left-quote"></i>
                                <p>
                                Staying at QuickStay hotel was an incredible experience. The atmosphere was perfect, and the attention to detail was impeccable. The rooms were spacious and well-equipped, making my stay truly enjoyable. Highly recommend it!
                                </p>
                                <ul>
                                    <li>
                                        <img src="assets/img/testimonials/testimonials-img2.jpg" alt="Images">
                                        <h3>Jack Ma</h3>
                                        <span>China</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonials Area Three End -->

        <!-- FAQ Area -->
        <div class="faq-area pt-100 pb-70 section-bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="faq-content faq-content-bg2">
                            <div class="section-title">
                                <span class="sp-color">FEEL FREE TO ASK QUESTION</span>
                                <h2>Let's Start a Free of Questions and Get a Quick Support</h2>
                                <p>We are the agency who always gives you a priority on the free of question and you can easily make a question on the bunch.</p>
                            </div>

                            <div class="faq-accordion">
                                <ul class="accordion">
                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-plus'></i>
                                            How I Will Book a Room or Resort?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p> 
                                            Booking a room or resort is simple! Just visit our booking page, select your desired location, dates, and preferences. Once you’re ready, follow the easy steps to confirm your reservation. For personalized assistance, feel free to contact our support team.
                                            </p>
                                        </div>
                                    </li>
    
                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-plus'></i>
                                            How I Will Be Able to Add on the Admin Portal? 
                                        </a>
        
                                        <div class="accordion-content">
                                            <p> 
                                            To add content to the admin portal, simply log in with your admin credentials. Once inside, navigate to the "Content Management" section where you can upload new listings, edit existing ones, and manage media. It's easy to update any information directly through our user-friendly interface. If you need help, feel free to reach out to our support team for guidance!
                                            </p>
                                        </div>
                                    </li>
    
                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-plus'></i>
                                            What are the Benefits of These Agencies?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p> 
                                            Working with our agency offers numerous benefits, including expert guidance, access to exclusive properties, and personalized support for your travel or booking needs. We handle all the details, ensuring a seamless and stress-free experience from start to finish. Additionally, our partnerships often come with special offers and discounts that you won’t find elsewhere!
                                            </p>
                                            </p>
                                        </div>
                                    </li>
    
                                    <li class="accordion-item">
                                        <a class="accordion-title active" href="javascript:void(0)">
                                            <i class='bx bx-plus'></i>
                                            How I Will Make Payment for Room Book?
                                        </a>
        
                                        <div class="accordion-content show">
                                            <p> 
                                            Making a payment for your room booking is quick and secure! After selecting your room and dates, you'll be redirected to our payment gateway where you can choose from multiple options, including credit/debit cards, online banking, or other secure payment methods. Once your payment is confirmed, you'll receive a booking confirmation via email.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="faq-img-3">
                            <img src="assets/img/faq/faq-img3.jpg" alt="Images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQ Area End -->

        <!-- Blog Area -->
        <div class="blog-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <span class="sp-color">BLOGS</span>
                    <h2>Our Latest Blogs to the Intranational Journal at a Glance</h2>
                </div>
                <div class="row pt-45">
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-item">
                            <a href="blog-details.html">
                                <img src="assets/img/blog/blog-item-img1.jpg" alt="Images">
                            </a>
                            <div class="content">
                                <ul>
                                    <li>February 05, 2025</li>
                                    <li><i class='bx bx-user'></i>29K</li>
                                    <li><i class='bx bx-message-alt-dots'></i>15K</li>
                                </ul>
                                <h3>
                                    <a href="blog-details.html">Hotel Management is the Best Policy</a>
                                </h3>
                                <p>This is one of the best & quality full hotels in the world that will help you to make an excellent study market.</p>
                                <a href="blog-details.html" class="read-btn">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="blog-item">
                            <a href="blog-details.html">
                                <img src="assets/img/blog/blog-item-img2.jpg" alt="Images">
                            </a>
                            <div class="content">
                                <ul>
                                    <li>February 05, 2025</li>
                                    <li><i class='bx bx-user'></i>22K</li>
                                    <li><i class='bx bx-message-alt-dots'></i>24K</li>
                                </ul>
                                <h3>
                                    <a href="blog-details.html">3d Hotel Models Have an Important Model</a>
                                </h3>
                                <p>This is one of the best & quality full hotels in the world that will help you to make an excellent study market.</p>
                                <a href="blog-details.html" class="read-btn">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3">
                        <div class="blog-item">
                            <a href="blog-details.html">
                                <img src="assets/img/blog/blog-item-img3.jpg" alt="Images">
                            </a>
                            <div class="content">
                                <ul>
                                    <li>February 05, 2025</li>
                                    <li><i class='bx bx-user'></i>27K</li>
                                    <li><i class='bx bx-message-alt-dots'></i>39K</li>
                                </ul>
                                <h3>
                                    <a href="blog-details.html">Hotel Management Has a Good Future Era</a>
                                </h3>
                                <p>This is one of the best & quality full hotels in the world that will help you to make an excellent study market.</p>
                                <a href="blog-details.html" class="read-btn">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog Area End -->
        @endsection