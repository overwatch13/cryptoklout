
<?php /*include "homepage-content-logic.php"; */ ?>

<style>

/* Universal class changes */
h5{
    font-size: 1.10rem;
    font-weight:500;
}
.rotate { /* Add this as a mixin !! */

    /* Safari */
    -webkit-transform: rotate(-45deg);
    
    /* Firefox */
    -moz-transform: rotate(-45deg);
    
    /* IE */
    -ms-transform: rotate(-45deg);
    
    /* Opera */
    -o-transform: rotate(-45deg);
    
    

}
.card-body{
    padding: 1.0rem;
}

    /*** PAGE SPECIFIC ***/
     .profile-img-rounded{
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
    }
    
    /* We are designing mobile first than extending out to desktop */
    
    /* surrounds the profile image rounded div*/
    .profile-img-cont{ 
        width:100%;
        border-top-right-radius:10px;
        border-top-left-radius:10px;
        background:#ddd;
    }
    
    /* surrounds the profile image directly */
    .profile-img-rounded {
        margin: 0 auto;
    }
    
    /* container around all of the info cells */
    .card-container{
        width:100%;
    }
    
    /* container around the info cells */
    .user-profile-card{
        text-align:center;
        width:100%;
        margin-right:0px;
        margin-bottom:0px;
    }
    
    .user-profile-card .card-title{
            margin-bottom:6px;
    }
    .user-profile-card .card-text{
            font-size: 30px;
            line-height: 30px;
    }

    /* standard look of the card */
    .user-profile-cont .user-profile-card{
        
    }
   
    /****** Date Conainer *********/
.color-coded{
    height:25px;
}

.date-box-container{
    width:52px;
    float:left;
        border: 1px solid #ccc;
        cursor:pointer;
}

.date-container{
    font-size:12px;height: 38px;
}

.date-container .rotate{
    margin-top: 17px;
}
    
    /* Extract all of this into its own .less file, so you can keep all of the media queries in the same place. 
      /* Small devices (landscape phones, 576px and up) */
    @media (min-width: 576px) { 
        .user-profile-card{
            width:50%;
        }
    }
    
    /* Medium devices (tablets, 768px and up) */
    @media (min-width: 768px) { 
        .user-profile-card{
            width:25%;
        }
    }
    
    /* Large devices (desktops, 992px and up) */
    @media (min-width: 992px) { 

    }
    
    /* Extra large devices (large desktops, 1200px and up) */
    @media (min-width: 1200px) { 

    }
    
    /* Use the Max-widths judiciously.
   /* Extra small devices (portrait phones, less than 576px) */
    @media (max-width: 575.98px) { 
        
    }
    
    /* Small devices (landscape phones, less than 768px) */
    @media (max-width: 767.98px) { 
        
        
    }
    
    /* Medium devices (tablets, less than 992px) */
    @media (max-width: 991.98px) { 

    }
    
    /* Large devices (desktops, less than 1200px) */
    @media (max-width: 1199.98px) { 

    }
   
    
</style>

<section id="hero" class="section-small bg-gray">
      <div class="container">
        <div class="row">
          <div class="col user-profile-container">
          
              <div class="profile-img-cont">
                <div class="profile-img-rounded cursor-pointer " data-userid="2">
                    <img src="/img/avatar-5.jpg" width="100">
                </div>
              </div>
              
              <div class="card-container">
                  <div class="card user-profile-card pull-left">
            		<div class="card-body">
            			<div class="card-title">CryptoKlout Score</div>
            			<div class="card-text text-success">785</div>
            		</div>
            	</div>
            	<div class="card user-profile-card pull-left">
            		<div class="card-body">
            			<div class="card-title">Better than</div>
            			<div class="card-text">83%</div>
            		</div>
            	</div>
                  <div class="card user-profile-card pull-left">
            		<div class="card-body">
            			<div class="card-title">Total Predictions</div>
            			<div class="card-text">54</div>
            		</div>
            	</div>
            	<div class="card user-profile-card pull-left">
            		<div class="card-body">
            			<div class="card-title">Correct</div>
            			<div class="card-text">62%</div>
            		</div>
            	</div>
            	
              </div>
            
          </div>
        </div><!-- row -->
        
        <div class="row" style="margin-top:40px;">
            <div class="col">
                <!-- emmet script div.date-line.clear>(div.date-box-container>(div.color-coded.bg-success+div.date-container>div.rotate{2-14-18}))*30 -->
            <h5>Single Day Predictions (BTC)</h5>
            <div class="date-line clear">
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-danger"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-danger"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-danger"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-danger"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-danger"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-danger"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-danger"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-danger"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-danger"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-danger"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
                <div class="date-box-container">
                    <div class="color-coded bg-success"></div>
                    <div class="date-container">
                        <div class="rotate">2-14-18</div>
                    </div>
                </div>
            </div><!-- .date-line -->
            </div><!-- col -->
        </div><!-- .row date block -->
        
        
        <div class="row" style="margin-top:40px;">
            <div class="col">
                <h5>About Sandra</h5>
                <div class="user-profile-personal">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Twitter: </li>
                        <li class="list-group-item">Facebook: </li>
                        <li class="list-group-item">Website: </li>
                      </ul>
                </div>
              </div><!-- col -->
        </div><!-- .row date block -->

<section id="hero" class="hero hero-home bg-gray">
      <div class="container">
        <div class="row d-flex">
          <div class="col-lg-6 text order-2 order-lg-1">
            <h1>Welcome William!</h1>
            <p class="hero-text">This is your recent activity</p>
            <div class="CTA"><a href="#features" class="btn btn-primary btn-shadow btn-gradient link-scroll">Discover More</a><a href="#" class="btn btn-outline-primary">Sign Up Now</a></div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2"><img src="<?php echo ROOT; ?>img/Macbook.png" alt="..." class="img-fluid"></div>
        </div>
      </div>
    </section>
   