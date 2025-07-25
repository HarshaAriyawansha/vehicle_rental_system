<header>
    <div class="back" style="margin-bottom: -20px;">
        <div class="default-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-md-2">
                        <div class="logo"> <a href="index.php"><img src="assets/images/imasha car rent logof.png"
                                    alt="image"
                                    style="height: 60px; width: 150px;  position: absolute; border: 1px solid #ffffff;border-radius: 15px;" /></a>
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-10">
                        <div class="header_info">
                            <div class="header_widgets">
                                <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
                                <p class="uppercase_text">For Support Mail us : </p>
                                <a href="mailto:info@example.com">cabsimasha@gmail.com</a>
                            </div>
                            <div class="header_widgets">
                                <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                                <p class="uppercase_text">Service Helpline Call Us: </p>
                                <a href="tel:61-1234-5678-09">033-4931931</a>
                            </div>
                            <div class="social-follow">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <?php 
                            $login = 1;
                                if($login==0)
                                {
                            ?>
                            <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase"
                                    data-toggle="modal" data-dismiss="modal">Login / Register</a> </div>
                            <?php }
                            else{

                            echo "Welcome To Imasha Car rental ";
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Navigation -->
    <nav id="navigation_bar" class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse"
                    class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div class="header_wrap">
                <div class="user_login">
                    <ul>
                        <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>
                                <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu">

                                <li><a href="profile.php">Profile Settings</a></li>
                                <li><a href="update-password.php">Update Password</a></li>
                                <li><a href="my-booking.php">My Booking</a></li>
                                <li><a href="post-testimonial.php">Post a Testimonial</a></li>
                                <li><a href="my-testimonials.php">My Testimonial</a></li>
                                <li><a href="logout.php">Sign Out</a></li>

                                <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">Profile Settings</a>
                                </li>
                                <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">Update Password</a>
                                </li>
                                <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">My Booking</a></li>
                                <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">Post a Testimonial</a>
                                </li>
                                <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">My Testimonial</a>
                                </li>
                                <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">Sign Out</a></li>

                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="header_search">
                    <div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
                    <form action="#" method="get" id="header-search-form">
                        <input type="text" placeholder="Search..." class="form-control">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Home</a> </li>

                    <li><a href="page.php?type=aboutus">About Us</a></li>
                    <li><a href="car-listing.php">Car Listing</a>
                    <li><a href="page.php?type=faqs">FAQs</a></li>
                    <li><a href="contact-us.php">Contact Us</a></li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- Navigation end -->

</header>
