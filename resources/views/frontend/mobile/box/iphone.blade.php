<style>
    #popup{
        background: #444444;
        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAAAAACMmsGiAAAAGElEQVR4AWMItbW1ZbANBRJ2QJIByAsFACn9BDLFzRqoAAAAAElFTkSuQmCC");
        background-repeat: repeat;
        border-top: 0.25rem solid #87b322;
        width:100%;
        min-height: 84px;
        height: auto;
        padding-bottom: 10px;
    }
    #popup-close{
        background-image:url(https://www.akhbarona.com/img/close.png);
        background-repeat:no-repeat;
        background-size:100% auto;
        min-height:35px;
        width:auto;
        margin:10px;
    }

    #app-button {
        width:auto;
        text-align:center;
        background-color: #37b1c6;
        color: #ffffff;
        margin-top: 0.75rem;
        margin-left:1rem;
        padding: 0.65rem 1.65rem;
        font-family: arial;
        font-weight: bold;
        font-size: 1.175rem;
        line-height: 1.175rem;
        text-transform: uppercase;
        border: 0.0625rem solid #333333;
        -webkit-box-shadow: 0 0 0 0.0625rem #fff;
        box-shadow: 0 0 0 0.0625rem #fff;
    }
    #popup h2{ font-size: 1.375rem;font-weight:bolder;}
    #popup h4{ font-size: 1.175rem;}
</style>
<div id="popup" style="display:none;">
    <table class="table-responsive" width="100%">
        <tr>
            <td width="10%" valign="top">{{--<div id="popup-close">&nbsp;</div>--}}</td>
            <td width="15%"><img id="phoneimage" src="" class="img-responsive" style="max-height:60px; width:auto;" /></td>
            <td width="50%" style="color:white;">            <h2 style="font-weight:bold;" id="ptitle"></h2>
                <h4 id="ptext"></h4>
            </td>
            <td width="35%" align="center"><a href="" id="plink"><div id="app-button">حـمـل</div></a></td>
        </tr>
    </table>
</div>
<script  type="text/javascript">
    var userAgent = (navigator.userAgent || navigator.vendor || window.opera);

    if( (userAgent.match( /iPad/i ) || userAgent.match( /iPhone/i ) || userAgent.match( /iPod/i )) && sessionStorage.getItem('showOnce') !== 'true')
    {
        document.getElementById('phoneimage').src = 'https://www.akhbarona.com/img/iphonepic.png';
        document.getElementById('ptitle').innerHTML = 'تطبـيـق أخـبـارنـا';
        document.getElementById('ptext').innerHTML = 'أخبار عاجلة - سرعة في التصفح <br> تفاعل مع التعليقات و مواقع التوصل <br> مصمم خصيصا لك - مجانا على أب-ستور';
        document.getElementById('plink').href = 'https://itunes.apple.com/fr/app/akhbarona-akhbarna/id997618668';
        document.getElementById("popup").style.display = "block";
    }
    else if( (userAgent.match( /Android/i )) && sessionStorage.getItem('showOnce') !== 'true' )
    {
        document.getElementById('phoneimage').src = 'https://www.akhbarona.com/img/androidpic.png';
        document.getElementById('ptitle').innerHTML = 'تطبـيـق أخـبـارنـا';
        document.getElementById('ptext').innerHTML = 'أخبار عاجلة - سرعة في التصفح <br> تفاعل مع التعليقات و مواقع التوصل <br> مصمم خصيصا لك - مجانا على بلاي-ستور';
        document.getElementById('plink').href = 'market://details?id=com.archiveinfotech.akhbarona';
        document.getElementById("popup").style.display = "block";

    }
    /*else{
        document.getElementById("popup").style.display = "none";
    }*/
</script>
