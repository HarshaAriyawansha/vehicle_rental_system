@extends('layouts.web_include.webapp')

@section('content')

<!-- Banners -->
   
    <h2 style="text-align: center;margin-bottom: 0px; background: #ff7373;">
        <marquee direction="left">Imasha Cabs & Tours</marquee>
    </h2>
    <section id="banner" class="banner-section">

        <div class="container">
            <div class="div_zindex">
                <div class="row">
                    <div class="col-md-5 col-md-push-7">
                        <div class="banner_content">
                            <h1 style="color: #f94d00;">Find the right car for you.</h1><br><br>

                            <a href="#" class="btn">Read More <span class="angle_arrow"><i class="fa fa-angle-right"
                                        aria-hidden="true"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- /Banners --> 

<!-- Resent Cat-->
<section class="section-padding gray-bg">
    <div class="container">
        <div class="section-header text-center">

            <h2>Find the Best <span>CarForYou</span></h2>
            <p></p>
        </div>
        <div class="row">

            <!-- Nav tabs -->
            <div class="recent-tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">New
                            Car</a></li>
                </ul>
            </div>
            <!-- Recently Listed New Cars -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="resentnewcar">
                    <?php foreach ($vehicles as $key => $vehicle_list) {?>
                    <div class="col-list-3">
                        <div class="recent-car-list block">
                            <div class="car-info-box"> <a href="{{ url('/vehical_details') }}/<?= $vehicle_list['id']; ?>"><img
                                        src="{{ asset('assets/images/logg.png') }}"
                                        class="img-responsive" alt="image" style="height: 260px;width: 400px;"></a>
                                <ul>
                                    <li><i class="fa fa-car" aria-hidden="true"></i><?= $vehicle_list['fuel_type']; ?></li>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i><?= $vehicle_list['model_year']; ?> Model</li>
                                    <li><i class="fa fa-user" aria-hidden="true"></i><?= $vehicle_list['seating_capacity']; ?> seats</li>
                                </ul>
                            </div>
                            <div class="car-title-m">
                                <h6><a href="{{ url('/vehical_details') }}/<?= $vehicle_list['id']; ?>"><?= $vehicle_list['brand_name']; ?> , <?= $vehicle_list['model_name']; ?></a></h6>

                                <span class="price">Rs.<?= $vehicle_list['price_per_km']; ?> /Day</span>
                            </div>
                            <div class="car-title-m2">
                                <span class="price">Rs.<?= $vehicle_list['price_per_km']; ?> /KM</span>
                            </div>
                            <?php
                            $status="yes";
                            $available="yes";
                            if($available=="yes"){
                            ?>
                            <h4 style="font-size: 16px;margin-left: 22px;font-weight: inherit;color: blue;">Available
                            </h4>
                            <?php
                            }
                            else
                            {
                            ?>
                            <h4 style="font-size: 16px;margin-left: 22px;font-weight: inherit;color: red;">Not Available
                                Now</h4>
                            <?php
                                }
                                ?>
                            <div class="inventory_info_m">
                                <p>CarOverview</p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
</section>
<!-- /Resent Cat --> 

<!-- Fun Facts-->
<section class="fun-facts-section">
  <div class="container div_zindex">
    <div class="row">
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-calendar" aria-hidden="true"></i>40+</h2>
            <p>Years In Business</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>10+</h2>
            <p>New Cars For Rent</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>10+</h2>
            <p>Used Cars For Rent</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>600+</h2>
            <p>Satisfied Customers</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>

<!-- /Fun Facts--> 

<!--Testimonial -->
<section class="section-padding testimonial-section parallex-bg">

  <div class="container div_zindex">
    <div class="section-header white-text text-center">
      <h2>Our Satisfied <span>Customers</span></h2>
    </div>
      <div class="row">
      <div id="testimonial-slider">
      </div>
    </div>
    </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Testimonial--> 

@endsection
