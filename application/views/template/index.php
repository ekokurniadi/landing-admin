<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $header->row()->title ?></title>
  <meta content="<?= $header->row()->title ?>" name="description">
  <meta content="<?= $header->row()->title ?>" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url() ?>image/<?= $header->row()->favicon ?>" rel="icon">
  <link href="<?php echo base_url() ?>image/<?= $header->row()->favicon ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url() ?>assetsPage/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assetsPage/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assetsPage/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assetsPage/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assetsPage/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assetsPage/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assetsPage/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url() ?>assetsPage/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Bootslander - v2.3.1
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <!-- <h1 class="text-light"><a href="index.html"><span>Bootslander</span></a></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="<?= base_url() ?>"><img src="<?php echo base_url() ?>image/<?= $header->row()->logo ?>" alt="" class="img-fluid" ></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="<?= base_url() ?>">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#features">Features</a></li>
          <li><a href="#gallery">Gallery</a></li>
          <li><a href="#testimonials">Testimonials</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="#pricing">Pricing</a></li>
          <li><a href="#contact">Contact</a></li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
      <div class="row">
        <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
          <div data-aos="zoom-out">
            <h1><?= $hero->row()->heading ?></h1>
            <h2><?= $hero->row()->sub_heading ?></h2>
            <div class="text-center text-lg-left">
              <a href="#about" class="btn-get-started scrollto">Get Started</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
          <img src="<?php echo base_url() ?>image/<?= $hero->row()->image ?>" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container-fluid">

        <div class="row">
          <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch" data-aos="fade-right">
            <a href="<?= $about->row()->video ?>" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
          </div>

          <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5" data-aos="fade-left">
            <h3><?= $about->row()->heading ?></h3>
            <p><?= $about->row()->sub_heading ?></p>

            <?php foreach ($about_detail->result() as $rows) : ?>
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon"><i class="<?= $rows->icon ?>"></i></div>
                <h4 class="title"><a href=""><?= $rows->title ?></a></h4>
                <p class="description"><?= $rows->subtitle ?></p>
              </div>
            <?php endforeach; ?>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Features</h2>
          <p>Check The Features</p>
        </div>

        <div class="row" data-aos="fade-left">
          <?php foreach ($feature->result() as $features) : ?>
            <div class="col-lg-3 col-md-4">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
                <i class="<?= $features->icon ?>" style="color: #ffbb2c;"></i>
                <h3><a href=""><?= $features->feature ?></a></h3>
              </div>
            </div>
          <?php endforeach; ?>

        </div>
    </section><!-- End Features Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row" data-aos="fade-up">
          <?php foreach ($serviceRate->result() as $sr) : ?>
            <div class="col-lg-3 col-md-6 pt-3">
              <div class="count-box">
                <i class="<?= $sr->icon ?>"></i>
                <span data-toggle="counter-up"><?= $sr->value ?></span>
                <p><?= $sr->title ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Details Section ======= -->
    <section id="details" class="details">
      <div class="container">
        <?php
        $index = 1;
        foreach ($service->result() as $serv) { ?>
          <div class="row content">
            <div class="<?= $index % 2 == 0 ? "col-md-4 order-1 order-md-2" : "col-md-4" ?>" data-aos="<?= $index % 2 == 0 ? "fade-left" : "fade-right" ?>">
              <img src="<?php echo base_url() ?>image/<?= $serv->image ?>" class="img-fluid" alt="">
            </div>
            <div class="<?= $index % 2 == 0 ? "col-md-8 pt-5 order-2 order-md-1" : "col-md-8 pt-4" ?>" data-aos="fade-up">
              <h3><?= $serv->title ?></h3>
              <p class="font-italic">
                <?= $serv->subtitle ?>
              </p>
            </div>
          </div>
        <?php $index++;
        } ?>
      </div>
    </section><!-- End Details Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Gallery</h2>
          <p>Check our Gallery</p>
        </div>

        <div class="row no-gutters" data-aos="fade-left">
          <?php foreach ($galery->result() as $galery_rows) : ?>
            <div class="col-lg-3 col-md-4">
              <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
                <a href="<?php echo base_url() ?>image/<?= $galery_rows->image ?>" class="venobox" data-gall="gallery-item">
                  <img src="<?php echo base_url() ?>image/<?= $galery_rows->image ?>" alt="" class="img-fluid">
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container">

        <div class="owl-carousel testimonials-carousel" data-aos="zoom-in">
          <?php foreach ($testimonials->result() as $testi) : ?>
            <div class="testimonial-item">
              <img src="<?php echo base_url() ?>image/<?=$testi->user_profile?>" class="testimonial-img" alt="">
              <h3><?=$testi->name?></h3>
              <h4><?=$testi->job?></h4>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                <?=$testi->testimoni?>
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Team</h2>
          <p>Our Great Team</p>
        </div>

        <div class="row" data-aos="fade-left">
          <?php foreach($team->result() as $teams):?> 
          <div class="col-lg-3 col-md-6">
            <div class="member" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic"><img src="<?php echo base_url() ?>image/<?=$teams->image?>" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4><?=$teams->name?></h4>
                <span><?=$teams->job?></span>
                <div class="social">
                  <a href="https://twitter.com/<?=$teams->twitter?>"><i class="icofont-twitter"></i></a>
                  <a href="https://www.facebook.com/<?=$teams->facebook?>"><i class="icofont-facebook"></i></a>
                  <a href="https://www.instagram.com/<?=$teams->instagram?>"><i class="icofont-instagram"></i></a>
                  <a href="https://www.linkedin.com/<?=$teams->linkedin?>"><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach;?>
        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Pricing</h2>
          <p>Check our Pricing</p>
        </div>

        <div class="row" data-aos="fade-left">

        <?php foreach($prices->result() as $price):?>
          <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
            <div class="box featured" data-aos="zoom-in" data-aos-delay="100">
              <h3><?=$price->category?></h3>
              <h4><sup>Rp. <?=number_format($price->price,0,'.',',')?></h4>
              <ul>
                <li><?=$price->detail?></li>
               
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>
          <?php endforeach;?>
        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>F.A.Q</h2>
          <p>Frequently Asked Questions</p>
        </div>

        <div class="faq-list">
          <ul>
            <?php 
            $index=0;
            foreach($faq->result() as $fq){?>
            <li data-aos="fade-up" data-aos-delay="<?=$index==0 ? 0 : $index * 100 ?>">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse" href="#faq-list-1"><?=$fq->judul?><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-parent=".faq-list">
                <p>
                <?=$fq->question?>
                </p>
              </div>
            </li>
            <?php $index++; }?>
          </ul>
        </div>

      </div>
    </section><!-- End F.A.Q Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </div>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p><?=$address->row()->location?></p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p><?=$address->row()->email?></p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p><?=$address->row()->phone?></p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
            
            <div class="loading"></div>
            <form method="post" role="form" class="php-email-form" id="message-form">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center">
              <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  
              </div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">


    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span><?=$header->row()->title?></span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/ -->
        Designed by <a href="https://gocodings.web.app">https://gocodings.web.app</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div id="preloader"></div>
  
  <!-- Vendor JS Files -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <script src="<?php echo base_url() ?>assetsPage/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assetsPage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url() ?>assetsPage/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url() ?>assetsPage/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo base_url() ?>assetsPage/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo base_url() ?>assetsPage/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url() ?>assetsPage/vendor/counterup/counterup.min.js"></script>
  <script src="<?php echo base_url() ?>assetsPage/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url() ?>assetsPage/vendor/aos/aos.js"></script>
  <!-- Template Main JS File -->
  <script src="<?php echo base_url() ?>assetsPage/js/main.js"></script>
    <script>
      $(document).ready(function(){
        $('#submit').click(function(){
          $.ajax({
            url:"<?php echo base_url('home/saveMessage')?>",
            method:"POST",
            data:$('#message-form').serialize(),
            beforeSend:function(){
              console.log($('#message-form').serialize());
              $('.loading').html('<div class="sent-message text-center" >Loading response...</div>');  
            },
            success:function(response){
              $('.loading').html('<div class="sent-message text-center">Your message has been sent. Thank you!</div>');  
              setTimeout(() => {
                $('.loading').html('<div class="sent-message text-center"></div>');  
              }, 3000);
            }
          });
        });
      });

    </script>
</body>

</html>