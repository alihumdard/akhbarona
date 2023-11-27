<?php
// get router
$routeCurrent = Route::getCurrentRoute()->getActionName();
$segment = \Request::segment(1);
$arrControllers = explode("\\",$routeCurrent);
$arrControllers = explode('@',$arrControllers[count($arrControllers) - 1]);
$controllerCurrent = $arrControllers[0];
$actionCurrent = $arrControllers[1];
$menus = \App\Helper\Common::menus();
$total = count($menus);
$setting = \App\Models\Config::getAllValue();
?>
<header class="topbar">
    <div class="container-body">
        <!-- navigation-bar Start -->
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="row">
                 <div class="col-6 col-md-6 col-lg-4">
                    <div class="top-links">
                        <a href="#"><img src="./images/top-youbute.png" alt=""></a>
                        <a href="#"><img src="./images/top-twitter.png" alt=""></a>
                        <a href="#"><img src="./images/top-instagram.png" alt=""></a>
                        <a href="#"><img src="./images/top-facebook.png" alt=""></a>
                    </div>
                 </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <div class="logo">
                        <a href="{{Common::mobileLink()}}"><img height="46px" widh="126px"  src="{{Config::get("app.cdn_url")}}themes/akhbarona210/img/logo.png" alt="{{$setting["VIVVO_WEBSITE_TITLE"]}}" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" /></a>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-none d-lg-block text-end">
                    <div class="navigation-bar">
                        <nav class="navbar navbar-light " style="flex-direction: row-reverse;">
                            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="33" height="22" viewBox="0 0 33 22" fill="none">
                                    <path d="M0 22V18.3333H33V22H0ZM0 12.8333V9.16667H33V12.8333H0ZM0 3.66667V0H33V3.66667H0Z" fill="white"/>
                                  </svg></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="row" style="flex-direction: row-reverse;">
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6" style="text-align: end;">
                                        @if($total > 0)
                                            @php
                                                $halfItemCount = ceil($total / 2);
                                            @endphp
                                            @foreach($menus->take($halfItemCount) as $menu)
                                                <div class="navbar-menu mt-3" @if($controllerCurrent == 'HomeController')
                                                    @if($actionCurrent == 'page' && strpos($menu->redirect,"advertising") !== false)
                                                        class="selected"
                                                    @elseif($actionCurrent == 'desktop' && $menu->redirect && strpos($menu->redirect,"advertising") === false)
                                                        class="active"
                                                    @endif
                                                @elseif($controllerCurrent == 'CategoryController')
                                                    @if($segment == $menu->sefriendly)
                                                        class="selected"
                                                    @endif
                                                @endif>
                                                    <a href="{{$menu->redirect?$menu->redirect:Common::link("frontend.category.index",[$menu->sefriendly,1])}}">
                                                        {{$menu->category_name}}
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6" style="text-align: end;">
                                        @if($total > $halfItemCount)
                                            @foreach($menus->slice($halfItemCount, $halfItemCount) as $menu)
                                                <div class="navbar-menu mt-3">
                                                    <a href="{{$menu->redirect?$menu->redirect:Common::link("frontend.category.index",[$menu->sefriendly,1])}}">
                                                        {{$menu->category_name}}
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                
                            </div>

                        </nav>
                    </div>
                </div>   
                </div>
            </div>
        </div>
    </div>
</header>
<!-- navgation bar for desktop views -->
<section class="navigarion-desktop text-center">
    <div>
        @if($total > 0 )
                        @foreach($menus as $menu)
        <span @if($controllerCurrent == 'HomeController')
        @if($actionCurrent == 'page' && strpos($menu->redirect,"advertising") !== false)
            class="selected"
        @elseif($actionCurrent == 'desktop' && $menu->redirect  && strpos($menu->redirect,"advertising") === false)
        class="active"
        @endif
    @elseif($controllerCurrent == 'CategoryController')
        @if($segment == $menu->sefriendly)
            class="selected"
        @endif
    @endif><a href="{{$menu->redirect?$menu->redirect:Common::link("frontend.category.index",[$menu->sefriendly,1])}}">
        {{$menu->category_name}}
    </a></span>
        @endforeach
                    @endif
    </div>
</section>
