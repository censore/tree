/**
 * Created by Grad on 04.04.2016.
 */
(function($) {
    $.fn.connectionItem = function(options, text) {
        var defaults = {
            to: $(window)
        };
        var settings = $.extend({}, defaults, options);
        return this.each(function() {
            var from = $(this);
            var x0, y0;
            var x, y, x1, y1, r;
            var to = $(settings.to);
            var hr = $("<hr></hr>", {
                "class": "connection",
                css: {
                    position: "absolute!important"
                }
            }).appendTo("body");
            hr.html(text);
            hr.css('text-align','center');
            hr.css("transform-origin", 0);
            hr.css("-moz-transform-origin", 0);
            hr.css("-webkit-transform-origin", 0);
            hr.css("-o-transform-origin", 0);

            function fn() {
                var pos = from.offset();
                var pos_left = pos.left;
                var pos_top = pos.top;

                x0 = pos_left + from.width() / 2;
                y0 = pos_top + from.height() / 2;
                var pos2 = to.offset();
                console.log(to);
                var pos2_left = pos2.left;
                var pos2_top = pos2.top;
                x1 = pos2_left + to.width() / 2;
                y1 = pos2_top + to.height() / 2;
                x = x1 - x0;
                y = y1 - y0;
                var w = Math.sqrt(x * x + y * y);
                r = 360 - 180 / Math.PI * Math.atan2(y, x);
                hr.css({
                    left: x0,
                    top: y0,
                    width: w + 'px!important'
                });
                hr.css("transform", "rotate(-" + r + "deg)");
                hr.css("-moz-transform", "rotate(-" + r + "deg)");
                hr.css("-webkit-transform", "rotate(-" + r + "deg)");
                hr.css("-o-transform", "rotate(-" + r + "deg)")
            }
            $(window).on({
                resize: fn,
                load: fn
            })
        })
    }
})(jQuery);

$(function(){
    function rand(a) {
        return 5 + Math.floor(Math.random() * a)
    }

});

