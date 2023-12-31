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
  height: 600px;
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
  padding: 10px 0 13px 0;
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
  background: linear-gradient(0deg,
      #2e4866 0%,
      #5e7189 63.09%,
      #96a3b2 100.94%,
      #c7ced6 127.49%,
      #fff 127.5%);
  margin: 10px 3px;
  border: none;
  /* padding: 7px 36px; */
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

.newspaper-2 .video-box-1 {
  background: linear-gradient(0deg,
      #000 0%,
      rgba(0, 0, 0, 0.51) 61.91%,
      rgba(0, 0, 0, 0) 100%),
    url(./images/video-bg-1.png);
  background-repeat: no-repeat;
  background-size: cover;
  padding: 30px 5px 10px 5px;
}
.newspaper-2 .video-box-2 {
  background: linear-gradient(0deg,
      #000 0%,
      rgba(0, 0, 0, 0.51) 61.91%,
      rgba(0, 0, 0, 0) 100%),
    url(./images/video-bg-2.png);
  background-repeat: no-repeat;
  background-size: cover;
  padding: 30px 5px 10px 5px;
}
.newspaper-2 .video-box-3 {
  background: linear-gradient(0deg,
      #000 0%,
      rgba(0, 0, 0, 0.51) 61.91%,
      rgba(0, 0, 0, 0) 100%),
    url(./images/video-bg-3.png);
  background-repeat: no-repeat;
  background-size: cover;
  padding: 30px 5px 10px 5px;
}
.newspaper-2 .video-box-4 {
  background: linear-gradient(0deg,
      #000 0%,
      rgba(0, 0, 0, 0.51) 61.91%,
      rgba(0, 0, 0, 0) 100%),
    url(./images/video-bg-4.png);
  background-repeat: no-repeat;
  background-size: cover;
  padding: 30px 5px 10px 5px;
}
.newspaper-2 .video-box-5 {
  background: linear-gradient(0deg,
      #000 0%,
      rgba(0, 0, 0, 0.51) 61.91%,
      rgba(0, 0, 0, 0) 100%),
    url(./images/video-bg-5.png);
  background-repeat: no-repeat;
  background-size: cover;
  padding: 30px 5px 10px 5px;
}
.newspaper-2 .video-box-6 {
  background: linear-gradient(0deg,
      #000 0%,
      rgba(0, 0, 0, 0.51) 61.91%,
      rgba(0, 0, 0, 0) 100%),
    url(./images/video-bg-6.png);
  background-repeat: no-repeat;
  background-size: cover;
  padding: 30px 5px 10px 5px;
}
.newspaper-2 .video-box-7 {
  background: linear-gradient(0deg,
      #000 0%,
      rgba(0, 0, 0, 0.51) 61.91%,
      rgba(0, 0, 0, 0) 100%),
    url(./images/video-bg-7.png);
  background-repeat: no-repeat;
  background-size: cover;
  padding: 30px 5px 10px 5px;
}
.newspaper-2 .video-box-8 {
  background: linear-gradient(0deg,
      #000 0%,
      rgba(0, 0, 0, 0.51) 61.91%,
      rgba(0, 0, 0, 0) 100%),
    url(./images/video-bg-8.png);
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
  padding: 15px 6px 10px 6px;
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
  padding: 10px 10px;
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
  /* margin: 0 15px 15px 0; */
}

a button {
  color: #fff;
  text-align: center;
  text-decoration: none;
}

.newspaper-8 {
  padding: 10px 15px;
  background: #f9f9f9;
}

/****************************** Newspaper-8 Section End  ************************************/

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


/****************************** akhirul-akhbar-sec-8 Page  Styling Start  ***************************/

.akhirul-akhbar-main-sec {
  background: linear-gradient(rgba(46, 72, 102, 0.60), rgba(46, 72, 102, 0.60)), url(./images/akhirul-akhbar-main-bg.png);
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  height: 263.092px;
  display: flex;
  align-items: end;
  justify-content: flex-end;
}



.akhirul-akhbar-sec-8 {
  background-color: #F2F2F2;
}

.akhirul-akhbar-sec-8 .main-div {
  border: none;
  background: none;
}

.main-box img {
  width: 100%;
  height: 100%;
}

.akhirul-akhbar-sec-8 .main-div p {
  color: #000;
  text-align: right !important;
  /* font-family: Helvetica Rounded; */
  font-size: 16px;
  font-style: normal;
  font-weight: bold;
  line-height: 150%;
  border-bottom: 1px solid #d0d0d0;
  padding: 20px 15px;
  margin: 0;
}

.akhirul-akhbar-sec-8 .main-box p {
  border-bottom: none;
}

.paginations .pagination{
    justify-content: end;
}
.paginations .pagination li{
  margin: 0 5px;
}
.paginations .pagination li a{
  font-weight: bold;
  color: black;
}

.page-link {
    border: 1px solid #C2111E !important;
    padding: 0px 7px !important;
}
.pagi-active{
  color: #C2111E !important;
}
.pagi-active-1{
  background-color: #C2111E !important;
  color: white !important;
}

.news-links{
  text-decoration: none;
}


/****************************** Detail Page Styling Start  ***************************/

.detail-heading {
  text-align: end;
}

.detail-heading p {
  color: #656565;
  text-align: right;
  font-family: Helvetica;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 150%;
  /* 21px */
}





/* Search section start */
.search-sec {
  text-align: -webkit-center;
    background: #2E3641;
    padding: 30px 35px 30px 0;
    color: white;
}

.search-sec button {
  background: #C2111E;
  color: white;
  padding: 8px 46px;
  border-radius: 60px;
  text-decoration: none;
  font-size: 17px;
}

.search-sec .form-control {
  border-radius: 25px;
  background: white;
  text-align: right !important;
  padding: 8px;
}

.search-sec .row .btns {
  text-align: end;
}

.placeholder-css::placeholder {
  /* text-align: right; */
  color: #656565 !important;
}

.form-control.textarea-placeholder::placeholder {
  color: #656565;
}



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

  .search-sec .last-search {
    flex-direction: column-reverse;
    justify-content: center !important;
  }

  .btns {
    text-align: center !important;
  }

  .search-sec .form-control {
    margin-left: 0 !important;
  }
  .paginations .pagination{
    justify-content: center !important;
}

}


/* Contact us section styling Start  */

.contact-us {
  background: #F2F2F2;
  padding: 20px 45px 45px 45px;
}

.contact-us .contact-us-btn a {
  border-radius: 61px;
  background: #2E3641;
  padding: 8px 30px;
  color: white;
  text-decoration: none;
  text-align: center;
  font-weight: 700;
}

.contact-us .form-control{
  padding: 15px 10px !important;
  text-align: right;
}

.contact-us .form-control:focus{
box-shadow: none;
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

  .search-sec .form-control {
    margin-left: 12px;
  }
  .search-sec {
    padding: 30px  10px 30px 0 !important;
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
  .search-sec {
    padding: 30px  0px 30px 0 !important;
}
.newspaper-3 .news-main-box p {
  text-align: center !important;
}
}

/****************************** Media Queries for Large (Desktop) Size End  ***********************/
</style>