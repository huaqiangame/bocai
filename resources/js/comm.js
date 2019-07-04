var app = {
    footer: function() {
        var h = $(document).height() - $(window).height();
        if (h > 100) {
            $(".com_footer").removeClass("p_fid");
        }
        else{
            $(".com_footer").addClass("p_fid");
        }
    },
    raidoClick: function() {
        $(".list li .dxk").click(function() {
            var cur_img = $(this).find("img").attr("src", "images/dx2.jpg");
            $(this).siblings().find("img").attr("src", "images/dx1.jpg");
            $(this).find("input").attr("checked", true);

        });
    },
    init: function() {
        this.footer();
        this.raidoClick();
    }

};


$(function() {
    app.init();
});
