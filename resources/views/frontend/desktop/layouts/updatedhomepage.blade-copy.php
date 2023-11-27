<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" lang="ar-MA" xml:lang="ar-MA" dir="ltr">
<head>
    <title>@yield('page-title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="generator" content="Akhbarona almaghrebia"/>
    <meta name="Description" content="@yield('page-des')"/>
    <meta name="Keywords" content="@yield('page-keyword')"/>
    @yield("rss")
    <meta property="og:site_name" content="akhbarona.com"/>
    <meta property="og:type" content="website"/>
    <meta content="@yield('page-des')" itemprop="description" property="og:description"/>
    <meta name="copyright" content="akhbarona.com"/>
    <meta name="author" content="akhbarona.com"/>
    <meta name="robots" content="index, follow"/>

    <?php $cdnUrl = Config::get('app.cdn_url_css');?>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url($cdnUrl.'themes/icons/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ url($cdnUrl.'themes/icons/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ url($cdnUrl.'themes/icons/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ url($cdnUrl.'themes/icons/favicon-16x16.png') }}" sizes="16x16" />
    <meta name="application-name" content="Akhbarona"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ url($cdnUrl.'themes/icons/mstile-144x144.png') }}" />

    <script type="cd8d8a4bfd95ba7c901a6669-text/javascript">
        var _gaq=[['_setAccount','UA-1600248-7'],['_trackPageview']];
    </script>
    @yield("seo")
    <meta property="og:title" content="@yield('page-title')" itemprop="headline"/>
    <meta name="twitter:site" content="@AkhbaronaPress"/>
    <meta name="twitter:creator" content="@AkhbaronaPress"/>
    <meta name="google-site-verification" content="nH8QuQxqHItGHazk4RR7Gg5b2v0WdVjoK1blBiEgKcQ"/>
    @yield("og_image")
    <meta property="og:title" content="@yield('page-title')" itemprop="headline"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font-Awesome icons-->
    <link rel="stylesheet" href=https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css>

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Font Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">


    <style>
        /* fonts */
@font-face {
    font-family: Helvetica Rounded !important;
    src: url(./Helvetica-Font/helvetica-rounded-bold-5871d05ead8de.otf);
    font-weight: 700;
  }
  
  /* Globle classes */
  .active {
    border-bottom: 1px solid #000;
    padding-bottom: 4px;
  }
  
  .hero-sec-adds-1,
  .hero-sec-adds-3 {
    display: flex;
    align-items: center;
    height: 530px;
    margin: auto;
    justify-content: center;
    background: #c2111e;
  }
  
  .container-body {
    margin: 0 40px;
  }
  
  .hero-sec-adds-2 {
    display: flex;
    align-items: center;
    height: 230px;
    margin: auto;
    justify-content: center;
    background: #f2f2f2;
  }
  
  .hero-sec-adds-4 {
    display: flex;
    align-items: center;
    height: 100%;
    margin: auto;
    justify-content: center;
    background: #f2f2f2;
  }
  
  .adds-5 {
    display: flex;
    align-items: center;
    height: 80px;
    margin: auto;
    justify-content: center;
    background: #f2f2f2;
  }
  
  .red-line {
    height: 5px !important;
    background-color: #2e4866;
    opacity: 1 !important;
    margin: 0 !important;
  }
  
  .red-line::before {
    content: "";
    display: block;
    background-color: #c2111e;
    width: 15%;
    height: 5px;
    margin-left: auto;
  }
  
  .heading {
    text-align: right;
  }
  
  .newspaper-1 p,
  .newspaper-4 p {
    margin-bottom: 0;
    margin-top: 8px;
    color: #000;
    text-align: right;
    /* font-family: Helvetica; */
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: 150%;
    /* 24px */
  }
  .down-dots {
    margin-left: 15px;
  }
  /* topbar */
  .topbar {
    background: linear-gradient(180deg, #2e4866 50%, #001022 133.39%);
    padding: 10px 0 0 0;
    position: sticky;
    top: 0;
    z-index: 99;
  }
  .navbar-toggler:focus {
    box-shadow: none;
  }
  .nav .topbar .topbar-content {
    justify-content: space-between;
    /* align-items: center; */
  }
  
  .topbar .logo {
    margin-top: 4px;
    text-align: center;
  }
  
  .topbar .top-links {
    margin-top: 13px;
    margin-right: 10px;
  }
  
  .topbar .top-links a {
    margin-right: 5px;
  }
  
  .navbar-light .navbar-toggler {
    border: none;
    padding: 5px 10px !important;
  }
  
  .topbar .navbar-menu a {
    color: #fff !important;
    text-decoration: none;
  }
  
  /* navigarion-desktop */
  .navigarion-desktop {
    padding: 10px 0;
    background: var(--color);
    box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.15);
  }
  
  .navigarion-desktop a {
    color: #000;
    font-size: 20px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    text-decoration: none;
    margin: 0 15px;
  }
  
  /* Hero Section start */
  
  .hero-sec h3 {
    padding-top: 13px;
  }
  
  .hero-sec .hero-sec-button {
    text-align: center;
    background: #ecf1f8;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    padding: 8px 0;
  }
  
  .hero-sec-button button {
    font-weight: 700;
    line-height: normal;
    border-radius: 61px;
    background: linear-gradient(
      0deg,
      #2e4866 0%,
      #5e7189 63.09%,
      #96a3b2 100.94%,
      #c7ced6 127.49%,
      #fff 127.5%
    );
    margin: 10px 3px;
    border: none;
    padding: 7px 36px;
  }
  
  .hero-sec .hero-sec-button a {
    color: #fff;
    text-decoration: none;
    /* font-family: Helvetica Rounded; */
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
  }
  
  /* hero section swiper slider */
  .hero-swiper .swiper {
    width: 100%;
    height: 100%;
  }
  
  .hero-swiper .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .hero-swiper .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .hero-swiper .swiper {
    width: 100%;
    height: 300px;
    margin-left: auto;
    margin-right: auto;
  }
  
  .hero-swiper .swiper-slide {
    background-size: cover;
    background-position: center;
  }
  
  .hero-swiper .mySwiper2 {
    height: 80%;
    width: 100%;
  }
  
  .hero-swiper .mySwiper {
    height: 20%;
    box-sizing: border-box;
    padding: 10px 0;
  }
  
  .hero-swiper .mySwiper .swiper-slide {
    width: 25%;
    height: 100%;
    /* opacity: 0.4; */
  }
  
  .mySwiper .swiper-slide-thumb-active {
    opacity: 1;
    border: 2px solid #c2111e;
  }
  
  .mySwiper .swiper-slide-thumb-active::before {
    background-color: rgba(0, 0, 0, 0.37);
    content: "";
    display: block;
    height: 100%;
    position: absolute;
    width: 100%;
  }
  
  .hero-swiper .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    cursor: pointer;
  }
  
  .hero-swiper .swiper p {
    position: absolute;
    color: #fff;
    bottom: 0px;
    background: rgba(0, 0, 0, 0.7);
    padding: 12px;
    margin-bottom: 0;
    text-align: center;
  }
  
  /* Newspaper Section styling */
  
  .swiper-slide .card .card-body p {
    text-align: right;
    margin-bottom: 0;
  }
  
  .swiper-button-prev:after,
  .swiper-rtl .swiper-button-next:after,
  .swiper-button-next:after,
  .swiper-rtl .swiper-button-prev:after {
    content: " " !important;
  }
  
  .newspaperSwipper .swiper-button-next,
  .newspaperSwipper .swiper-button-prev {
    position: static;
  }
  
  .newspaperSwipper .swiper-button-next .img-arrow,
  .newspaperSwipper .swiper-button-prev .img-arrow {
    height: auto;
    max-width: 36px;
  }
  
  .newspaperSwipper .swiper-pagination {
    position: static;
    width: auto !important;
    margin: 0 15px 25px 17px;
  }
  
  .swiper-pagination-bullet-active {
    background: black !important;
  }
  
  .hero-swiper
  
  /**************************** newspaper-1 styling Start ******************************/
  .newspaper-1 {
    text-align: right;
  }
  
  .newspaper-1 .main-box img {
    width: 100%;
    height: auto;
  }
  
  .newspaper-sec .heading span {
    padding: 10px 15px;
    background: #f5f8f9;
    font-size: 20px;
    font-weight: 700;
  }
  
  /**************************** newspaper-1 styling End ******************************/
  
  /**************************** newspaper-2 styling start *****************************/
  .newspaper-2 {
    text-align: center;
    background: #f5f8f9;
    padding: 15px 10px;
  }
  
  .newspaper-2 .video-box {
    background: linear-gradient(
        0deg,
        #000 0%,
        rgba(0, 0, 0, 0.51) 61.91%,
        rgba(0, 0, 0, 0) 100%
      ),
      url(./images/video-bg-1.png);
    background-repeat: no-repeat;
    background-size: cover;
    padding: 30px 5px 10px 5px;
  }
  
  .newspaper-2 a {
    color: white;
    text-decoration: none;
  }
  
  /**************************** newspaper-2 styling End ******************************/
  
  /**************************** newspaper-3 styling start *****************************/
  
  .newspaper-3 .news-main-box {
    background: #000;
  }
  
  .newspaper-3 .news-main-box img {
    height: 100%;
  }
  
  .newspaper-3 .news-main-box p {
    margin-bottom: 0;
    color: #fff;
    text-align: right;
    /* font-family: Helvetica Rounded; */
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 150%;
    padding: 10px;
  }
  
  .newspaper-5 .news-main-div {
    border-radius: 44.5px;
    background: #000;
  }
  
  .newspaper-4 .main-div img {
    height: 100%;
    width: 100%;
    object-fit: cover;
  }
  
  /* newspaper-slide Section Styling Start */
  .newspaper-slider {
    padding: 10px 15px;
    background: #f9f9f9;
  }
  
  /****************************** Newspaper-5-6 Section Start  *************************************/
  .newspaper-5 p {
    margin-bottom: 0;
    color: #000;
    text-align: right !important;
    /* font-family: Helvetica Rounded; */
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 150%;
    padding: 10px;
    margin-top: 15px;
  }
  
  .newspaper-5 .main-box {
    border: 0.5px solid #d0d0d0;
    background: #fff;
  }
  
  .newspaper-5 .main-box img {
    height: 100% !important;
    width: 100%;
    height: 100% !important;
  }
  
  .newspaper-6 p {
    margin-bottom: 0;
    color: #000;
    text-align: right !important;
    /* font-family: Helvetica Rounded; */
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 150%;
    padding: 10px;
  }
  
  .newspaper-6 img {
    width: 100%;
    height: 100%;
  }
  /****************************** Newspaper-5-6 Section End  *************************************/
  
  /****************************** Newspaper-7 Section Start  *************************************/
  .newspaper-7 p {
    margin-bottom: 0;
    color: #000;
    text-align: right !important;
    /* font-family: Helvetica Rounded; */
    font-size: 14px;
    font-style: normal;
    font-weight: bold;
    line-height: 150%;
    padding: 10px;
  }
  .newspaper-7 .main-box img {
    width: 100%;
    height: 100%;
  }
  
  /****************************** Newspaper-7 Section End  *************************************/
  
  /****************************** Newspaper-8 Section Start  ************************************/
  .newspaper-8 p {
    color: #000;
    text-align: right !important;
    /* font-family: Helvetica Rounded; */
    font-size: 16px;
    font-style: normal;
    font-weight: bold;
    line-height: 150%;
    border-bottom: 1px solid #d0d0d0;
    padding: 15px 10px;
    margin: 0;
  }
  
  .newspaper-8 .main-div {
    border: 0.5px solid #d0d0d0;
    background: #f9f9f9;
    text-align: end;
  }
  
  button {
    padding: 8px 30px;
    /* font-family: Helvetica Rounded; */
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    border-radius: 61px;
    background: #2e3641;
    border: none;
    margin: 0 15px 15px 0;
  }
  
  a button {
    color: #fff;
    text-align: center;
    text-decoration: none;
  }
  
  .newspaper-8 {
    padding: 10px 15px;
    background: #f9f9f9;
  } /****************************** Newspaper-8 Section End  ************************************/
  
  /****************************** Newspaper-9 Section End  *************************************/
  
  /****************************** Newspaper-9 Section Start  *************************************/
  .newspaper-9 .main-div {
    text-align: end;
  }
  
  .newspaper-9 p {
    color: #000;
    text-align: right !important;
    /* font-family: Helvetica Rounded; */
    font-size: 14px;
    font-style: normal;
    font-weight: bold;
    line-height: 150%;
    padding: 15px 10px;
    margin: 0;
  }
  
  .newspaper-9 {
    background: #f5f8f9;
    padding: 10px 15px;
  }
  
  /****************************** Newspaper-9 Section End  *************************************/
  
  /****************************** Newspaper-10 Section Start  *************************************/
  .newspaper-10 .main-sec {
    background: #f5f8f9;
  }
  
  .newspaper-10 p {
    color: #000;
    text-align: right !important;
    /* font-family: Helvetica Rounded; */
    font-size: 14px;
    font-style: normal;
    font-weight: bold;
    line-height: 150%;
    padding: 15px 10px;
    margin: 0;
  }
  
  /****************************** Newspaper-10 Section End  *************************************/
  
  /****************************** footer section Styling Start  **********************************/
  .footer-sec {
    padding: 20px 0;
    background: #2e4866;
    color: #fff;
  }
  
  .footer-sec a {
    color: #fff;
    text-decoration: none;
    font-size: 14px;
  }
  
  .footer-sec li {
    padding: 3px 0;
  }
  
  .footer-sec h4 {
    text-align: end;
    margin-right: 20px;
  }
  
  .footer-sec .footer-social-links {
    text-align: center;
  }
  
  .footer-sec .footer-social-links a {
    margin-right: 8px;
    margin-top: 15px;
  }
  
  .footer-sec .footer-social-links img {
    margin-top: 15px;
  }
  
  .footer-sec .contact-btn {
    padding-left: 25px;
  }
  
  .footer-sec .contact-btn img {
    border-radius: 7px;
  }
  .footer-sec .contact-btn h5 {
    margin-left: 40px;
  }
  
  .copyright {
    border-top: 1px dashed #fff;
    border-bottom: 1px dashed #fff;
    padding: 15px 0;
  }
  
  /****************************** footer section Styling End  ******************************************/
  
  /****************************** Media Queries for Mobile Size Start  **********************************/
  @media (max-width: 767px) {
    .topbar .navbar-menu a {
      font-size: 12px !important;
    }
  
    .hero-sec .swiper p {
      padding: 15px;
      font-size: 14px;
    }
  
    .top-links,
    .navigarion-desktop,
    .hero-sec-adds-1,
    .hero-sec-adds-3,
    .hero-sec-adds-4 {
      display: none;
    }
  
    .newspaper-sec,
    .newspaper-sec span,
    .newspaper-sec p,
    .newspaper-sec .main-box,
    .newspaper-sec,
    .footer-sec h4 {
      text-align: center !important;
    }
  
    .main-div {
      text-align: center !important;
    }
  
    .newspaper-3 .news-main-box {
      flex-direction: column-reverse;
      padding: 20px 0;
    }
  
    .main-div button {
      margin: 0 !important;
      margin-bottom: 15px !important;
    }
  
    .owl-theme .owl-dots,
    .owl-theme .owl-nav {
      text-align: center !important;
    }
  
    .footer-sec .contact-btn {
      padding-left: 0 !important;
    }
    .down-dots {
      justify-content: center !important;
      margin-left: 0 !important;
    }
    .newspaper-4 .main-div {
      flex-direction: column-reverse;
    }
  }
  
  /****************************** Media Queries for Mobile Size End  **********************************/
  
  /****************************** Media Queries for Medium (Teblete) Size Start  ***********************/
  @media (max-width: 992px) {
    /* .top-links{
          display: none;
      } */
    .topbar .logo {
      text-align: end !important;
    }
  
    .newspaper-3 .news-main-box {
      justify-content: space-between !important;
      align-items: center !important;
    }
  
    .footer-sec,
    .footer-sec h4 {
      text-align: center !important;
    }
    .footer-sec .contact-btn h5 {
      margin-left: 0 !important;
    }
  
    .newspaper-10 .main-sec {
      padding: 20px 0;
      flex-direction: column-reverse;
    }
  
    .newspaper-3 .news-main-box {
      border-radius: 15px !important;
      padding: 10px !important;
      text-align: center !important;
      flex-direction: column-reverse;
    }
  
    .navigarion-desktop {
      display: none;
    }
  
    .newspaper-5 p {
      margin-top: 0 !important;
    }
  
    .newspaper-6 .news-6-last-img {
      text-align: center !important;
    }
    .newspaper-9 p {
      text-align: center !important;
    }
    .newspaper-9 .main-div {
      text-align: center !important;
    }
  }
  
  /****************************** Media Queries for Medium (Teblete) Size End  ***********************/
  
  /****************************** Media Queries for Large (Desktop) Size Start  ***********************/
  
  @media (min-width: 992px) and (max-width: 1240px) {
    .newspaper-3 .news-main-box {
      border-radius: 15px !important;
      padding: 10px !important;
      text-align: center !important;
      flex-direction: column-reverse;
    }
  
    .newspaper-5 p {
      margin-top: 0 !important;
    }
  
    .topbar .logo {
      text-align: center !important;
    }
  
    .newspaper-10 .main-sec {
      padding: 20px 0;
      flex-direction: column-reverse;
    }
  }
  
  /****************************** Media Queries for Large (Desktop) Size End  ***********************/
  
    </style>
    <!-- swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    
</head>
<body id="layout_two_column" cz-shortcut-listen="true" style="overflow-x:hidden">
<div>
    @yield("header_menu")
  
    @include("frontend.desktop.layouts.footer")
</div>

<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
<!-- Owl Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 8,
        freeMode: true,
        watchSlidesProgress: true,
      });
      var swiper2 = new Swiper(".mySwiper2", {
        loop: true,
        spaceBetween: 5,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        thumbs: {
          swiper: swiper,
        },
      });
    
    
    
    //   $('.owl-carousel').owlCarousel({
    //     loop:true,
    //     margin:5,
    //     nav:false,
    //     responsive:{
    //         0:{
    //             items:1
    //         },
    //         767:{
    //             items:2
    //         },
    //         1000:{
    //             items:3
    //         }
    //     }
    // })
    
    
    
    const suggestedSwiper = new Swiper('.newspaperSwipper', {
        speed: 600,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false
        },
        slidesPerView: 3,
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 10 },
            768: { slidesPerView: 2, spaceBetween:10 },
            992: { slidesPerView: 3, spaceBetween: 10},
            1920: { slidesPerView: 3, spaceBetween: 10}
        },
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
</script>
</body>
</html>
