$(function(){
	$.init();
	$(".swiper-container").swiper({loop:true,spaceBetween:1,speed:1000,initialSlide:0});
    if ($(".rui-least-open").size() > 0) {
        
        Scroll_Top_Item();

        function Scroll_Top_Item() {
            var _theScrollContainer = $(".rui-least-open");
            var _theFirstObj = _theScrollContainer.find(".learst_openNumber").eq(0);
            var _theHeight = _theFirstObj.height(); 
            _theFirstObj.animate({
                "margin-top":"-"+_theHeight+"px"
            }, 1000, function () { 
                _theScrollContainer.append(_theFirstObj);
                _theFirstObj.removeAttr("style");
                setTimeout(function () {
                    Scroll_Top_Item();
                },10000);
            });
        } 
    }
	
})