<?php $cdnUrl = Config::get('app.cdn_url').'themes/mobile/';$appUrl = Config::get("app.url")?>

<div class="inner cover">
<div class="header-menu">
        <div style="width: 30%; float: left;">
             <a aria-controls="collapseExample" aria-expanded="false" href="#collapseExample" data-toggle="collapse">
                 <div class="mobile-menu open-mobile-menu" id="mobile-menu-open"></div>
                 <div class="mobile-menu-close open-mobile-menu" id="mobile-menu-close" style="display:none"></div>
             </a>
        </div>
        <div style="width: 30%; float: right;height: 60px;line-height: 65px;padding-right: 15px;">
            <a href="https://www.facebook.com/akhbaronacom"><img src="{{$cdnUrl}}assets/img/fb.png" style="width: 32px !important;" width="32" /></a>
            &nbsp;

            <a href="/mobile/contact.html"><img src="{{$cdnUrl}}assets/img/contact.png" width="32" style="width: 32px !important;" /></a>
        </div>
        <div class="logo" style="width: 40%;text-align: center;"> <a href="{{$appUrl}}mobile/"><img src="{{$cdnUrl}}img/logo.png" alt="{{$setting["VIVVO_WEBSITE_TITLE"]}}" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" /></a></div>

</div>
    <div class="top_menu">
        <table width="100%" border="0" cellspacing="10" cellpadding="10">
            <tr><td>
                    <div class="title_head">
                        <div style="position: absolute; right:10px; top:0px;z-index:99999;">
                            <ul class="top_right_menu">
                                <li><a href="{{$appUrl}}?is_desktop=0"><i class="glyphicon glyphicon-home"></i></a> </li>
                                <li><a href="{{$appUrl}}mobile/videos">شاشة أخبارنا</a></li>
                                <li><a href="{{$appUrl}}mobile/sport">رياضة</a></li>
                                <li><a href="{{$appUrl}}?is_desktop=1"> النسخة العادية</a></li>

                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="left" valign="middle"><div style=" ">
                        <div style="left:0; top:0px; z-index:1; width:100%;">
                            <div class="">
                                <div id="collapseExample" class="collapse" aria-expanded="false" style="height:0px;">
                                    <div class="panel_left">
                                        <div class="line-menu">

                                            <form action="" method="post" id="top_search_mobile" name="search" onsubmit="return searchMobile()">
                                                <div class="input-group" style="z-index:0;">
  <span class="input-group-btn">
  <button class="btn btn-default" type="submit" style="height: 34px; border-radius: 0px;"><span class="glyphicon glyphicon-search"></span></button>
  </span><input type="text" class="form-control" placeholder="بحث" name="search_query" id="search_query"/>
                                                    <input type="hidden" name="search_do_advanced" />

                                                </div>
                                            </form>

                                        </div>
                                        <div class="clearfix"></div>
                                        <ul class="menu_drop" style="width:100%;">
                                            <li><a href="{{$appUrl}}mobile/">الرئيسية</a></li>
                                            <li><a href="{{$appUrl}}mobile/economy/index.1.html">اقتصاد </a></li>
                                            <li><a href="{{$appUrl}}mobile/politic/index.1.html">سياسة </a></li>
                                            <li><a href="{{$appUrl}}mobile/national/index.1.html">أخبار وطنية </a></li>
                                            <li><a href="{{$appUrl}}mobile/sport/index.1.html">رياضة </a></li>
                                            <li><a href="{{$appUrl}}mobile/world/index.1.html">دولية </a></li>
                                            <li><a href="{{$appUrl}}mobile/health/index.1.html">طب وصحة </a></li>
                                            <li><a href="{{$appUrl}}mobile/technology/index.1.html">علوم وتكنولوجيا </a></li>
                                            <li><a href="{{$appUrl}}mobile/culture/index.1.html">ثقافة وفنون </a></li>
                                            <li><a href="{{$appUrl}}mobile/videos/index.1.html">شاشة أخبارنا </a></li>
                                            <li><a href="{{$appUrl}}mobile/religion/index.1.html">دين ودنيا </a></li>
                                            <li><a href="{{$appUrl}}mobile/last/index.1.html">الأخـيـرة </a></li>
                                            <li><a href="{{$appUrl}}mobile/society">حوادث وقضايا</a></li>
                                            <li><a href="{{$appUrl}}mobile/social">قضايا المجتمع</a></li>
                                            <li><a href="{{$appUrl}}mobile/education">مستجدات التعليم</a></li>
                                            <li><a href="{{$appUrl}}mobile/sport/footmarocain">كورة مغربية</a></li>
                                            <li><a href="{{$appUrl}}mobile/sport/proplayers">مرصد المحترفين</a></li>
                                            <li><a href="{{$appUrl}}mobile/sport/lionatlas">أسود الأطلس</a></li>
                                            <li><a href="{{$appUrl}}mobile/sport/worldfoot">كورة عالمية</a></li>
                                            <li><a href="{{$appUrl}}mobile/sport/barcelona">برشلونة</a></li>
                                            <li><a href="{{$appUrl}}mobile/sport/realmadrid">ريال مدريد</a></li>
                                            <li><a href="{{$appUrl}}mobile/sport/others">رياضات أخرى</a></li>
                                            <li><a href="{{$appUrl}}mobile/sport/tv">الشاشة الرياضية</a></li>
                                            <li><a href="{{$appUrl}}mobile/writers">أقلام حرة</a></li>
                                            <li><a href="{{$appUrl}}mobile/problems">نداءات إنسانية</a></li>
                                            <li><a href="{{$appUrl}}mobile/woman">ركن المرأة</a></li>
                                            <li><a href="{{$appUrl}}mobile/contest">مباريات ووظائف</a></li>
                                            <li><a href="{{$appUrl}}mobile/caricature">كاريكاتور وصور</a></li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></td>
            </tr>
        </table>
    </div>

</div>
