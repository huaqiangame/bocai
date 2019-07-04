; (function ($) {
    'use strict';
    var win = window;
    var doc = document;
    var $win = $(win);
    var $doc = $(doc);
    $.fn.dropload = function (options) {
        return new MyDropLoad(this, options);
    };
    var MyDropLoad = function (element, options) {
        var me = this;
        me.$element = element;
        me.upInsertDOM = false;
        me.loading = false;
        me.isLockUp = false;
        me.isLockDown = false;
        me.isData = true;
        me._scrollTop = 0;
        me._threshold = 0;
        me.init(options);
    };
    MyDropLoad.prototype.init = function (options) {
        var me = this;
        me.opts = $.extend(true, {}, {
            scrollArea: me.$element,
            domUp: {
                domClass: 'dropload-up',
                domRefresh: '<div class="dropload-refresh">↓下拉刷新</div>',
                domUpdate: '<div class="dropload-update">↑释放更新</div>',
                domLoad: '<div class="dropload-load"><span class="loading"></span>更新中...</div>'
            },
            domDown: {
                domClass: 'dropload-down',
                domRefresh: '<div class="dropload-refresh">↑上拉加载更多</div>',
                domLoad: '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
                domNoData: '<div class="dropload-noData">——我是有底线的——</div>'
            },
            autoLoad: true,
            distance: 50,
            threshold: '',
            loadUpFn: '',
            loadDownFn: ''
        }, options);
        if (me.opts.loadDownFn != '') {
            $(".dropload-down").remove();
            me.$element.append('<div class="' + me.opts.domDown.domClass + '">' + me.opts.domDown.domRefresh + '</div>');
            me.$domDown = $('.' + me.opts.domDown.domClass);
        }
        if (!!me.$domDown && me.opts.threshold === '') {
            me._threshold = Math.floor(me.$domDown.height() * 1 / 3);
        } else {
            me._threshold = me.opts.threshold;
        }
        if (me.opts.scrollArea == win) {
            me.$scrollArea = $win;
            me._scrollContentHeight = $doc.height();
            me._scrollWindowHeight = doc.documentElement.clientHeight;
        } else {
            me.$scrollArea = me.opts.scrollArea;
            me._scrollContentHeight = me.$element[0].scrollHeight;
            me._scrollWindowHeight = me.$element.height();
        }
        fnAutoLoad(me);
        $win.on('resize', function () {
            if (me.opts.scrollArea == win) {
                me._scrollWindowHeight = win.innerHeight;
            } else {
                me._scrollWindowHeight = me.$element.height();
            }
        });
        me.$element.on('touchstart', function (e) {
            if (!me.loading) {
                fnTouches(e);
                fnTouchstart(e, me);
            }
        });
        me.$element.on('touchmove', function (e) {
            if (!me.loading) {
                fnTouches(e, me);
                fnTouchmove(e, me);
            }
        });
        me.$element.on('touchend', function () {
            if (!me.loading) {
                fnTouchend(me);
            }
        });
        me.$scrollArea.on('scroll', function () {
            me._scrollTop = me.$scrollArea.scrollTop();
            if (me.opts.loadDownFn != '' && !me.loading && !me.isLockDown && (me._scrollContentHeight - me._threshold) <= (me._scrollWindowHeight + me._scrollTop)) {
                loadDown(me);
            }
        });
    };
    function fnTouches(e) {
        if (!e.touches) {
            e.touches = e.originalEvent.touches;
        }
    }
    function fnTouchstart(e, me) {
        me._startY = e.touches[0].pageY;
        me.touchScrollTop = me.$scrollArea.scrollTop();
    }
    function fnTouchmove(e, me) {
        me._curY = e.touches[0].pageY;
        me._moveY = me._curY - me._startY;
        if (me._moveY > 0) {
            me.direction = 'down';
        } else if (me._moveY < 0) {
            me.direction = 'up';
        }
        var _absMoveY = Math.abs(me._moveY);
        if (me.opts.loadUpFn != '' && me.touchScrollTop <= 0 && me.direction == 'down' && !me.isLockUp) {
            e.preventDefault();
            me.$domUp = $('.' + me.opts.domUp.domClass);
            if (!me.upInsertDOM) {
                me.$element.prepend('<div class="' + me.opts.domUp.domClass + '"></div>');
                me.upInsertDOM = true;
            }
            fnTransition(me.$domUp, 0);
            if (_absMoveY <= me.opts.distance) {
                me._offsetY = _absMoveY;
                me.$domUp.html(me.opts.domUp.domRefresh);
            } else if (_absMoveY > me.opts.distance && _absMoveY <= me.opts.distance * 2) {
                me._offsetY = me.opts.distance + (_absMoveY - me.opts.distance) * 0.5;
                me.$domUp.html(me.opts.domUp.domUpdate);
            } else {
                me._offsetY = me.opts.distance + me.opts.distance * 0.5 + (_absMoveY - me.opts.distance * 2) * 0.2;
            }
            me.$domUp.css({ 'height': me._offsetY });
        }
    }
    function fnTouchend(me) {
        var _absMoveY = Math.abs(me._moveY);
        if (me.opts.loadUpFn != '' && me.touchScrollTop <= 0 && me.direction == 'down' && !me.isLockUp) {
            fnTransition(me.$domUp, 300);
            if (_absMoveY > me.opts.distance) {
                me.$domUp.css({ 'height': me.$domUp.children().height() });
                me.$domUp.html(me.opts.domUp.domLoad);
                me.loading = true;
                me.opts.loadUpFn(me);
            } else {
                me.$domUp.css({ 'height': '0' }).on('webkitTransitionEnd mozTransitionEnd transitionend', function () {
                    me.upInsertDOM = false;
                    $(this).remove();
                });
            }
            me._moveY = 0;
        }
    }
    function fnAutoLoad(me) {
        if (me.opts.autoLoad) {
            if ((me._scrollContentHeight - me._threshold) <= me._scrollWindowHeight) {
                loadDown(me);
            }
        }
    }
    function fnRecoverContentHeight(me) {
        if (me.opts.scrollArea == win) {
            me._scrollContentHeight = $doc.height();
        } else {
            me._scrollContentHeight = me.$element[0].scrollHeight;
        }
    }
    function loadDown(me) {
        me.direction = 'up';
        me.$domDown.html(me.opts.domDown.domLoad);
        me.loading = true;
        me.opts.loadDownFn(me);
    }
    MyDropLoad.prototype.lock = function (direction) {
        var me = this;
        if (direction === undefined) {
            if (me.direction == 'up') {
                me.isLockDown = true;
            } else if (me.direction == 'down') {
                me.isLockUp = true;
            } else {
                me.isLockUp = true;
                me.isLockDown = true;
            }
        } else if (direction == 'up') {
            me.isLockUp = true;
        } else if (direction == 'down') {
            me.isLockDown = true;
            me.direction = 'up';
        }
    };
    MyDropLoad.prototype.unlock = function () {
        var me = this;
        me.isLockUp = false;
        me.isLockDown = false;
        me.direction = 'up';
    };
    MyDropLoad.prototype.noData = function (flag) {
        var me = this;
        if (flag === undefined || flag == true) {
            me.isData = false;
        } else if (flag == false) {
            me.isData = true;
        }
    };
    MyDropLoad.prototype.resetload = function () {
        var me = this;
        if (me.direction == 'down' && me.upInsertDOM) {
            me.$domUp.css({ 'height': '0' }).on('webkitTransitionEnd mozTransitionEnd transitionend', function () {
                me.loading = false;
                me.upInsertDOM = false;
                $(this).remove();
                fnRecoverContentHeight(me);
            });
        } else if (me.direction == 'up') {
            me.loading = false;
            if (me.isData) {
                me.$domDown.html(me.opts.domDown.domRefresh);
                fnRecoverContentHeight(me);
                fnAutoLoad(me);
            } else {
                me.$domDown.html(me.opts.domDown.domNoData);
            }
        }
    };
    MyDropLoad.prototype.unbind = function () {
        var me = this;
        me.$element.off('touchstart touchmove touchend');
        $(me.opts.scrollArea).off('scroll');
        me.opts.loadDownFn = '';
        me.$domDown.remove();
    };
    function fnTransition(dom, num) {
        dom.css({
            '-webkit-transition': 'all ' + num + 'ms',
            'transition': 'all ' + num + 'ms'
        });
    }
})(window.Zepto || window.jQuery);