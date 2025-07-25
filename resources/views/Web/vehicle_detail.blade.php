
@extends('layouts.web_include.webapp')

@section('content')

<section id="listing_img_slider">
  <div><img src="{{ asset('assets/images/logg.png') }}" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="{{ asset('assets/images/logg.png') }}" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="{{ asset('assets/images/logg.png') }}" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="{{ asset('assets/images/logg.png') }}" class="img-responsive"  alt="image" width="900" height="560"></div>

  <div><img src="{{ asset('assets/images/logg.png') }}" class="img-responsive" alt="image" width="900" height="560"></div>

</section>
<!--/Listing-Image-Slider-->

<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?= $vehicles->brand_name ?>, <?= $vehicles->model_name ?> </h2>

        <?php
        $status="yes";
        $available="yes";
        if($available=="yes"){
          ?>
          <h4 style="font-size: 16px;margin-left: 0px;font-weight: inherit;color: blue;">Available</h4>
          <?php
        }
        else
        {
          ?>
          <h4 style="font-size: 16px;margin-left: 0px;font-weight: inherit;color: red;">Not Available Now</h4>
          <p style="color: black">Car is allready booking now...Please Check the Booking and choose your dates</p>
          <?php
        }
        ?>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p>Rs. </p>Per Day
        </div>
         <div class="price_info" style="margin-top: 30px;border-inline-color: ;">
         <p>Rs. </p>Per KM
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
          
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5></h5>
              <p>Reg.Year</p>
            </li>
             <li> <i class="fa fa-tag" aria-hidden="true"></i>
              <h5></h5>
              <p>Name Plate</p>
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5></h5>
              <p>Fuel Type</p>
            </li>
       
            <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
              <h5></h5>
              <p>Seats</p>
            </li>
          </ul>
        </div>

              
      <!--Side-Bar-->
      <aside class="col-md-3">
      
        <div class="share_vehicle">
          <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </p>
        </div>
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
          </div>
          <form method="post">
            <div class="form-group">
              <input type="date" class="form-control" name="fromdate" id="fromdate" placeholder="From Date(dd/mm/yyyy)" required>
            </div>
            <div class="form-group">
              <input type="date" class="form-control" name="todate" id="todate" placeholder="To Date(dd/mm/yyyy)" required>
            </div>
             <div class="form-group">
             <h5 style="font-size: 16px;"> Charge type:  &nbsp; </h5>
            <input onclick="reveal()" type="radio" name="radio1" value="km" required><b> Per KM</b> &nbsp;
            <input onclick="reveal()" type="radio" name="radio1" value="day" required><b> Per Day</b>
   
        </div>
           <!-- <div class="form-group">
              <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
            </div>-->
          <?php if('login')
              {?>
              <div class="form-group">
                <input type="submit" class="btn"  name="submit" value="Book Now">
              </div>
              <?php } else { ?>
                <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For Book</a>
              <?php } ?>
          </form>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
    
    <div class="space-20"></div>
    <div class="divider"></div>
    
    <!--Similar-Cars-->
    <div class="similar_cars">
      <h3>Similar Cars</h3>
      <div class="row">   
        <div class="col-md-3 grid_listing">
          <div class="product-listing-m gray-bg">
            <div class="product-listing-img"> <a href="vehical-details.php?vhid=" class="img-responsive" alt="image" /> </a>
            </div>
            <div class="product-listing-content">
              <h5><a href="vehical-details.php?vhid=</a></h5>
              <p class="list-price">Rs.</p>
          
              <ul class="features_list">
                
             <li><i class="fa fa-user" aria-hidden="true"></i> seats</li>
                <li><i class="fa fa-calendar" aria-hidden="true"></i> model</li>
                <li><i class="fa fa-car" aria-hidden="true"></i></li>
              </ul>
            </div>
          </div>
        </div>


      </div>
    </div>
    <!--/Similar-Cars--> 
    
  </div>
</section>
<!--/Listing-detail--> 

@endsection
