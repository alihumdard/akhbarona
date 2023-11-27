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
<h1>Hello World</h1>
<div id="header">
    <div class="header_image">
        <div id="containers">
            @include("frontend.desktop.box.top_bar")
            <a href="{{Common::mobileLink()}}"><img src="{{Config::get("app.cdn_url")}}themes/akhbarona210/img/logo.png" alt="{{$setting["VIVVO_WEBSITE_TITLE"]}}" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" /></a>
            <div class="banner">@include("frontend.desktop.adv.header_banner")</div>
            <div class="clearer"> </div>
            <div id="mainNav">
                <ul id="menu_main" class="menu">
                    @if($total > 0)
                        @foreach($menus as $menu)

                            <li @if($controllerCurrent == 'HomeController')
                                @if($actionCurrent == 'page' && strpos($menu->redirect,"advertising") !== false)
                                    class="selected"
                                @elseif($actionCurrent == 'desktop' && $menu->redirect  && strpos($menu->redirect,"advertising") === false)
                                    class="selected"
                                @endif
                            @elseif($controllerCurrent == 'CategoryController')
                                @if($segment == $menu->sefriendly)
                                    class="selected"
                                @endif
                            @endif
                            >
                                <a href="{{$menu->redirect?$menu->redirect:Common::link("frontend.category.index",[$menu->sefriendly,1])}}">
                                    {{$menu->category_name}}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="clearer"> </div>
</div>
