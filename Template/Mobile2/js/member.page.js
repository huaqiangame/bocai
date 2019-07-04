(function($) {
	$.pagination = function(options) {
		var language = $.extend({}, $.pagination.language, options.language);
		var opts = $.extend({}, $.pagination.defaults, options);
		var render = $(opts.render);
		var page = 1, size = opts.pageSize;
		var load = function() {
			var data = opts.ajaxData;
			if($.isFunction(data)) {
				data = data();
			}
			data = $.extend({}, data, {jqueryGridPage: page, jqueryGridRows: size});
			$.ajax({
				type: opts.ajaxType,
				url: opts.ajaxUrl,
				data: data,
				dataType: 'json',
				beforeSend: opts.beforeSend,
				complete: opts.complete,
				success: function(response) {
					if(response.root){
						if(response.records && response.records > 0 && response.root && response.root.length > 0) {
							update(response.records);
							opts.success(response.root,response);
						} else {
							opts.success([]);
							opts.emptyData();
							render.empty();
						}
					} else if(response.data && response.data.root){
						if(response.data.records && response.data.records > 0 && response.data.root && response.data.root.length > 0) {
							update(response.data.records);
							opts.success(response.data.root,response);
						} else {
							opts.success([],response);
							opts.emptyData();
							render.empty();
						}
					} else if(response.sign) {
						if(response.totalCount && response.totalCount > 0 && response.data && response.data.length > 0) {
							update(response.totalCount);
							opts.success(response.data,response);
						} else {
							opts.success([],response);
							opts.emptyData();
							render.empty();
						}
					} else {
						opts.success([],response);
						opts.emptyData();
						render.empty();
						opts.pageError(response);
					}
				}
			});
		};
		var update = function(totalCount) {
			if(totalCount < 1) {return;}
			var pageCount = Math.ceil(totalCount/size);
			var pagination = $('<div style="text-align: center;">');
			var infos = '';
			var infosP = '';
			//infosP.append(language.infos.replace('${currPage}', page).replace('${totalPage}', pageCount).replace('${total}', totalCount));
			//infos.append(infosP);
			var pages = $('<ul class="r">');
			pages.append($('<li>').html($('<a class="prev" href="javascript:;">').html(language.prev)));
			var topPage = $('<li>').html($('<a class="start" href="javascript:;">').html(1));
			if(page == 1) {
				topPage.addClass('cur');
			}
			pages.append(topPage);
			
			var pageLength = opts.pageLength;
			if(pageCount < pageLength) {
				pageLength = pageCount;
			}
			if(pageCount > 2){
				var startPage = page - (Math.ceil(pageLength/2) - 1);
				var endPage = page + Math.floor(pageLength/2);
				if(startPage < 1) {
					startPage = 1;
					endPage = pageLength;
				}else if(endPage > pageCount) {
					startPage = pageCount - pageLength + 1;
					endPage = pageCount;
				}
				if(startPage == 1) {
					startPage = 2;
				} else if(startPage > 2) {
					pages.append($('<li>').html('...'));
				}
				if(endPage == pageCount) {
					endPage--;
				}
				for (var i = startPage; i <= endPage; i++) {
					var thisPage = $('<li>').html($('<a class="apage" href="javascript:;">').html(i));
					if(i == page) {
						thisPage.addClass('cur');
					}
					pages.append(thisPage);
				}
				if(endPage < pageCount-1) {
					pages.append($('<li>').html('...'));
				}
			}
			if(pageCount >= 2) {
				var endPages = $('<li>').html($('<a class="end" href="javascript:;">').html(pageCount));
				if(page == pageCount) {
					endPages.addClass('cur');
				}
				pages.append(endPages);
			}
			pages.append($('<li>').html($('<a class="next" href="javascript:;">').html(language.next)));
			pages.find('.apage').click(function() {
				var idx = $(this).html();
				idx = parseInt(idx);
				if(idx != page) {
					page = idx;
					load();
				}
			});
			pages.find('.start').click(function() {
				if(page > 1) {
					page = 1;
					load();
				}
			});
			pages.find('.prev').click(function() {
				if(page > 1) {
					page--;
					load();
				}
			});
			pages.find('.end').click(function() {
				if(page < pageCount) {
					page = pageCount;
					load();
				}
			});
			pages.find('.next').click(function() {
				if(page < pageCount) {
					page++;
					load();
				}
			});
			var go = $('<div class="go">').append($('<input type="text" />').val(page)).append($('<a class="btn-go">').html(language.go));
			go.find('.btn-go').click(function() {
				var idx = go.find('input[type="text"]').val();
				idx = parseInt(idx);
				if(idx > 0 && idx <= pageCount) {
					if(idx != page) {
						page = idx;
						load();
					}
				} else {
					opts.pageError(language.msg);
				}
			});
			if(!opts.hideInfos) {
				pagination.append(infos);
			}
			pagination.append(pages);
			if(!opts.hideGo) {
				pagination.append(go);
			}
			render.html(pagination);
		};
		var init = function() {
			page = 1;
			load();
		};
		return {
			init: init,
			reload: load
		};
	};
	
	$.pagination.language = {
		//infos: '当前第${currPage}/${totalPage}页，显示${start}至${end}条数据，总计${total}条数据。',
		infos: '${currPage}/${totalPage}页，记录总数：${total}条',
		top: '首页',
		end: '尾页',
		prev: '上一页',
		next: '下一页',
		go: '搜索',
		msg: '请输入正确的页数。'
	};
	
	$.pagination.defaults = {
		render: '.pagination',
		hideInfos: false,
		hideGo: false,
		pageLength: 10,
		pageSize: 10,
		ajaxType: 'post',
		ajaxUrl: '',
		ajaxData: {},
		beforeSend: function() {},
		complete: function() {},
		success: function(list) {},
		pageError: function(response) {
			alert(response.message);
		},
		emptyData: function() {
			
		}
	};
})(Zepto);