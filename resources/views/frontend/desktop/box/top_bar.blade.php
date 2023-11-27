
<div class="top_bar">
    <span class="current_date">
        <script type="text/javascript" language="javascript">
		    // <![CDATA[
                var mydate=new Date()
                var year=mydate.getYear()

                if (year < 1000)
                    year+=1900

                var day=mydate.getDay()
                var month=mydate.getMonth()
                var daym=mydate.getDate()

                if (daym<10)
                    daym="0"+daym

                var dayarray=new Array("الأحد","الإثنين","الثلاثاء","الأربعاء","الخميس",
                                        "الجمعة","السبت")
                var montharray=new Array("يناير","فبراير","مارس","أبريل","ماي","يونيو",
                                        "يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر")

                document.write(dayarray[day]+" "+daym+"  "+montharray[month]+"  "+year)
            //]]>
        </script>
    </span>
	@include("frontend.desktop.box.search")
    <div class="clearer"> </div>
</div>
