var malltodo_soft = 'admin';
var malltodoJs = {};

malltodoJs.ajax = function(url, input_data) {
	var ret;
	$.ajax({
		async: false,
		type: "POST",
		dataType: "json",
		url: url,
		data: input_data,
		success: function(data) {
			ret = data
		},
		error: function() {
			ret = 'error';
		}
	});
	return ret;
}

malltodoJs.del = function(url, id) {
	layer.msg('您确定要删除？', {
		time: 0,
		btn: ['确定', '取消'],
		yes: function(index) {
			layer.close(index);
			var input_data = {
				id: id
			}
			var ret = malltodoJs.ajax(url, input_data);
			if (ret.status) {
				if (ret.url) {
					document.location.href = ret.url
				} else {
					window.location.reload();
				}
			} else {
				layer.msg(ret.info)
			}
		}
	});
}

malltodoJs.sub_window = function(title, url) {
	var index = layer.open({
		type: 2,
		title: title,
		shadeClose: true,
		shade: false,
		maxmin: true,
		area: ['893px', '600px'],
		content: [url],
	});
}

malltodoJs.max_sub_window = function(title, url) {
	var index = layer.open({
		type: 2,
		title: title,
		shadeClose: true,
		shade: false,
		maxmin: true,
		area: ['98%', '98%'],
		content: [url],
	});
}

malltodoJs.organization_window_index = null;

malltodoJs.show_organization_window = function(title, organization_type, selected_node, exclude_node) {
	var url = "./admin.system.jsp?m=Organization&c=Organization&a=index&organization_type=" + organization_type +
		"&selected_node=" + selected_node + "&exclude_node=" + exclude_node;
	malltodoJs.organization_window_index = layer.open({
		type: 2,
		title: title,
		shadeClose: true,
		shade: false,
		maxmin: true,
		area: ['893px', '600px'],
		content: [url],
	});
}

malltodoJs.close_organization_window = function(organization_list) {
	parent.layer.close(parent.malltodoJs.organization_window_index);
	if (typeof parent.close_organization_window_after == "function") {
		parent.close_organization_window_after(organization_list);
	}
}

malltodoJs.animation = function() {
	$(function() {
		var len = $("[javatodo-animate]").length;
		$(window).on('scroll', function() {
			for (var i = 0; i < len; i = i + 1) {
				if ($(window).scrollTop() + $(window).height() >= $("[javatodo-animate]").eq(i)
					.offset().top - 50) {
					if (!$("[javatodo-animate]").eq(i).hasClass($("[javatodo-animate]").eq(i).attr(
							"javatodo-animate"))) {
						$("[javatodo-animate]").eq(i).addClass("animated");
						$("[javatodo-animate]").eq(i).addClass($("[javatodo-animate]").eq(i).attr(
							"javatodo-animate"));
					}
				}
			}
		})
	})
}();

malltodoJs.is_mobile = function() {
	var user_agent_info = navigator.userAgent;
	user_agent_info = user_agent_info.toLowerCase();
	var arr = ["240x320",
		"acer",
		"acoon",
		"acs-",
		"abacho",
		"ahong",
		"airness",
		"alcatel",
		"amoi",
		"android",
		"anywhereyougo.com",
		"applewebkit/525",
		"applewebkit/532",
		"asus",
		"audio",
		"au-mic",
		"avantogo",
		"becker",
		"benq",
		"bilbo",
		"bird",
		"blackberry",
		"blazer",
		"bleu",
		"cdm-",
		"compal",
		"coolpad",
		"danger",
		"dbtel",
		"dopod",
		"elaine",
		"eric",
		"etouch",
		"fly ",
		"fly_",
		"fly-",
		"go.web",
		"goodaccess",
		"gradiente",
		"grundig",
		"haier",
		"hedy",
		"hitachi",
		"htc",
		"huawei",
		"hutchison",
		"inno",
		"ipad",
		"ipaq",
		"iphone",
		"ipod",
		"jbrowser",
		"kddi",
		"kgt",
		"kwc",
		"lenovo",
		"lg ",
		"lg2",
		"lg3",
		"lg4",
		"lg5",
		"lg7",
		"lg8",
		"lg9",
		"lg-",
		"lge-",
		"lge9",
		"longcos",
		"maemo",
		"mercator",
		"meridian",
		"micromax",
		"midp",
		"mini",
		"mitsu",
		"mmm",
		"mmp",
		"mobi",
		"mot-",
		"moto",
		"nec-",
		"netfront",
		"newgen",
		"nexian",
		"nf-browser",
		"nintendo",
		"nitro",
		"nokia",
		"nook",
		"novarra",
		"obigo",
		"palm",
		"panasonic",
		"pantech",
		"philips",
		"phone",
		"pg-",
		"playstation",
		"pocket",
		"pt-",
		"qc-",
		"qtek",
		"rover",
		"sagem",
		"sama",
		"samu",
		"sanyo",
		"samsung",
		"sch-",
		"scooter",
		"sec-",
		"sendo",
		"sgh-",
		"sharp",
		"siemens",
		"sie-",
		"softbank",
		"sony",
		"spice",
		"sprint",
		"spv",
		"symbian",
		"tablet",
		"talkabout",
		"tcl-",
		"teleca",
		"telit",
		"tianyu",
		"tim-",
		"toshiba",
		"tsm",
		"up.browser",
		"utec",
		"utstar",
		"verykool",
		"virgin",
		"vk-",
		"voda",
		"voxtel",
		"vx",
		"wap",
		"wellco",
		"wig browser",
		"wii",
		"windows ce",
		"wireless",
		"xda",
		"xde",
		"zte"
	];
	var flag = false;
	for (var i = 0; i < arr.length; i = i + 1) {
		if (user_agent_info.indexOf(arr[i]) > -1) {
			flag = true;
			break;
		}
	}
	return flag;
}

malltodoJs.css_storage_list = {};
malltodoJs.css_storage = function(sign, document_dom) {
	var arr = new Array();
	if (typeof window.getComputedStyle == undefined || typeof window.getComputedStyle == "undefined") {
		arr = document_dom.currentStyle();
	} else {
		arr = window.getComputedStyle(document_dom);
	}
	var temp = {};
	for (var key in arr) {
		var val = arr[key];
		if (typeof val != "function" && (parseInt(key) == 0 || Number.isNaN(parseInt(key))) && key != "0") {
			temp[key] = val;
		}
	}
	malltodoJs.css_storage_list[sign] = temp;
}

malltodoJs.css_recovery = function(sign, jquery_dom) {
	jquery_dom.css(malltodoJs.css_storage_list[sign]);
}

malltodoJs.show_images_window = function(fun_name, id_val) {
	window_layer = layer.open({
		type: 2,
		title: "选择图片",
		shadeClose: true,
		shade: false,
		maxmin: true,
		area: ['98%', '98%'],
		content: ["./index.jsp?m=Index&c=Images&a=index&fun_name=" + fun_name + "&id_val=" + id_val],
	});
}

malltodoJs.images_selected = function(id, pic) {
	layer.close(window_layer);
	$("#" + id).val(pic);
	$("#" + id + "_javatodo_upload_file_outerbox").css({
		'background-image': 'url(' + pic + ')'
	});
};

function I(a) {
	var url = document.location.href;
	url = decodeURI(url);
	if (url.indexOf("?") == -1) {
		url = url + "?";
	}
	var url_arr = url.split("?");
	url = url_arr[1];
	if (url.indexOf("&") == -1) {
		url = url + "&";
	}
	url_arr = url.split("&");
	var map = new Array();
	for (var i = 0; i < url_arr.length; i = i + 1) {
		var param = url_arr[i];
		if (param.indexOf("=") != -1) {
			var param_arr = param.split("=");
			if (param_arr[0].trim() != "") {
				map[param_arr[0].trim()] = param_arr[1];
			}
		}
	}
	if (a == undefined || a == "") {
		return map;
	} else {
		if (map.hasOwnProperty(a)) {
			return map[a];
		} else {
			return "";
		}
	}
}

function U(map, entrance) {
	var url = "";
	for (var k in map) {
		if (url == "") {
			url = k + "=" + map[k];
		} else {
			url = url + "&" + k + "=" + map[k];
		}
	}
	if (url == "") {
		url = "./" + entrance;
	} else {
		url = "./" + entrance + "?" + url;
	}
	return encodeURI(url);
}

function open_call_window(seat_name, seat_id) {
	layer.msg(seat_name + "桌台呼叫", {
		time: 0,
		btn: ['确定', '取消'],
		yes: function(index) {
			layer.close(index);
			if (typeof MalltodoApp != "undefined") {
				MalltodoApp.yes_btn_click(seat_id);
			}
		},
		btn2: function(index) {
			layer.close(index);
			if (typeof MalltodoApp != "undefined") {
				MalltodoApp.cancel_btn_click(seat_id);
			}
		}
	});
	return "0";
}

malltodoJs.build_qqmap = function(js_dom, lat, lng) {
	if (lat == "" || lat == undefined || lat == NaN || lng == "" || lng == undefined || lng == NaN) {
		lat = "40.00286734916531";
		lng = "116.32294822667086";
	}
	var center = new TMap.LatLng(lat, lng);
	var map = new TMap.Map(js_dom, {
		center: center, //设置地图中心点坐标
		zoom: 17.2, //设置地图缩放级别
	});
	var geometries = [{
		"id": "1",
		"position": new TMap.LatLng(lat, lng),
		"properties": {
			"title": "marker1"
		}
	}]
	var marker = new TMap.MultiMarker({
		map: map,
		geometries: geometries
	});
}

function add_icon(jquery_dom) {
	var javatodo_icon = jquery_dom.attr("javatodo-icon");
	var class_string = jquery_dom.attr("class");
	var class_arr = class_string.split(" ");
	jquery_dom.attr("class", "");
	for (var i = 0; i < class_arr.length; i = i + 1) {
		var _class = class_arr[i];
		if (_class.indexOf("icon-") == -1) {
			jquery_dom.addClass(_class);
		}
	}
	jquery_dom.addClass(javatodo_icon);
}

function build_icon_panel(id) {
	var icon_arr = ["icon-glass", "icon-music", "icon-search", "icon-envelope-o", "icon-heart", "icon-star",
		"icon-star-o", "icon-user", "icon-film", "icon-th-large", "icon-th", "icon-th-list", "icon-check",
		"icon-times", "icon-search-plus", "icon-search-minus", "icon-power-off", "icon-signal", "icon-gear",
		"icon-cog", "icon-trash-o", "icon-home", "icon-file-o", "icon-clock-o", "icon-road", "icon-download",
		"icon-arrow-circle-o-down", "icon-arrow-circle-o-up", "icon-inbox", "icon-play-circle-o",
		"icon-rotate-right", "icon-repeat", "icon-refresh", "icon-list-alt", "icon-lock", "icon-flag",
		"icon-headphones", "icon-volume-off", "icon-volume-down", "icon-volume-up", "icon-qrcode", "icon-barcode",
		"icon-tag", "icon-tags", "icon-book", "icon-bookmark", "icon-print", "icon-camera", "icon-font",
		"icon-bold", "icon-italic", "icon-text-height", "icon-text-width", "icon-align-left", "icon-align-center",
		"icon-align-right", "icon-align-justify", "icon-list", "icon-dedent", "icon-outdent", "icon-indent",
		"icon-video-camera", "icon-photo", "icon-image", "icon-picture-o", "icon-pencil", "icon-map-marker",
		"icon-adjust", "icon-tint", "icon-edit", "icon-pencil-square-o", "icon-share-square-o",
		"icon-check-square-o", "icon-arrows", "icon-step-backward", "icon-fast-backward", "icon-backward",
		"icon-play", "icon-pause", "icon-stop", "icon-forward", "icon-fast-forward", "icon-step-forward",
		"icon-eject", "icon-chevron-left", "icon-chevron-right", "icon-plus-circle", "icon-minus-circle",
		"icon-times-circle", "icon-check-circle", "icon-question-circle", "icon-info-circle", "icon-crosshairs",
		"icon-times-circle-o", "icon-check-circle-o", "icon-ban", "icon-arrow-left", "icon-arrow-right",
		"icon-arrow-up", "icon-arrow-down", "icon-mail-forward", "icon-share", "icon-expand", "icon-compress",
		"icon-plus", "icon-minus", "icon-asterisk", "icon-exclamation-circle", "icon-gift", "icon-leaf",
		"icon-fire", "icon-eye", "icon-eye-slash", "icon-warning", "icon-exclamation-triangle", "icon-plane",
		"icon-calendar", "icon-random", "icon-comment", "icon-magnet", "icon-chevron-up", "icon-chevron-down",
		"icon-retweet", "icon-shopping-cart", "icon-folder", "icon-folder-open", "icon-arrows-v", "icon-arrows-h",
		"icon-bar-chart-o", "icon-twitter-square", "icon-facebook-square", "icon-camera-retro", "icon-key",
		"icon-gears", "icon-cogs", "icon-comments", "icon-thumbs-o-up", "icon-thumbs-o-down", "icon-star-half",
		"icon-heart-o", "icon-sign-out", "icon-linkedin-square", "icon-thumb-tack", "icon-external-link",
		"icon-sign-in", "icon-trophy", "icon-github-square", "icon-upload", "icon-lemon-o", "icon-phone",
		"icon-square-o", "icon-bookmark-o", "icon-phone-square", "icon-twitter", "icon-facebook", "icon-github",
		"icon-unlock", "icon-credit-card", "icon-rss", "icon-hdd-o", "icon-bullhorn", "icon-bell",
		"icon-certificate", "icon-hand-o-right", "icon-hand-o-left", "icon-hand-o-up", "icon-hand-o-down",
		"icon-arrow-circle-left", "icon-arrow-circle-right", "icon-arrow-circle-up", "icon-arrow-circle-down",
		"icon-globe", "icon-wrench", "icon-tasks", "icon-filter", "icon-briefcase", "icon-arrows-alt", "icon-group",
		"icon-users", "icon-chain", "icon-link", "icon-cloud", "icon-flask", "icon-cut", "icon-scissors",
		"icon-copy", "icon-files-o", "icon-paperclip", "icon-save", "icon-floppy-o", "icon-square", "icon-navicon",
		"icon-reorder", "icon-bars", "icon-list-ul", "icon-list-ol", "icon-strikethrough", "icon-underline",
		"icon-table", "icon-magic", "icon-truck", "icon-pinterest", "icon-pinterest-square",
		"icon-google-plus-square", "icon-google-plus", "icon-money", "icon-caret-down", "icon-caret-up",
		"icon-caret-left", "icon-caret-right", "icon-columns", "icon-unsorted", "icon-sort", "icon-sort-down",
		"icon-sort-desc", "icon-sort-up", "icon-sort-asc", "icon-envelope", "icon-linkedin", "icon-rotate-left",
		"icon-undo", "icon-legal", "icon-gavel", "icon-dashboard", "icon-tachometer", "icon-comment-o",
		"icon-comments-o", "icon-flash", "icon-bolt", "icon-sitemap", "icon-umbrella", "icon-paste",
		"icon-clipboard", "icon-lightbulb-o", "icon-exchange", "icon-cloud-download", "icon-cloud-upload",
		"icon-user-md", "icon-stethoscope", "icon-suitcase", "icon-bell-o", "icon-coffee", "icon-cutlery",
		"icon-file-text-o", "icon-building-o", "icon-hospital-o", "icon-ambulance", "icon-medkit",
		"icon-fighter-jet", "icon-beer", "icon-h-square", "icon-plus-square", "icon-angle-double-left",
		"icon-angle-double-right", "icon-angle-double-up", "icon-angle-double-down", "icon-angle-left",
		"icon-angle-right", "icon-angle-up", "icon-angle-down", "icon-desktop", "icon-laptop", "icon-tablet",
		"icon-mobile-phone", "icon-mobile", "icon-circle-o", "icon-quote-left", "icon-quote-right", "icon-spinner",
		"icon-circle", "icon-mail-reply", "icon-reply", "icon-github-alt", "icon-folder-o", "icon-folder-open-o",
		"icon-smile-o", "icon-frown-o", "icon-meh-o", "icon-gamepad", "icon-keyboard-o", "icon-flag-o",
		"icon-flag-checkered", "icon-terminal", "icon-code", "icon-mail-reply-all", "icon-reply-all",
		"icon-star-half-empty", "icon-star-half-full", "icon-star-half-o", "icon-location-arrow", "icon-crop",
		"icon-code-fork", "icon-unlink", "icon-chain-broken", "icon-question", "icon-info", "icon-exclamation",
		"icon-superscript", "icon-subscript", "icon-eraser", "icon-puzzle-piece", "icon-microphone",
		"icon-microphone-slash", "icon-shield", "icon-calendar-o", "icon-fire-extinguisher", "icon-rocket",
		"icon-maxcdn", "icon-chevron-circle-left", "icon-chevron-circle-right", "icon-chevron-circle-up",
		"icon-chevron-circle-down", "icon-html5", "icon-css3", "icon-anchor", "icon-unlock-alt", "icon-bullseye",
		"icon-ellipsis-h", "icon-ellipsis-v", "icon-rss-square", "icon-play-circle", "icon-ticket",
		"icon-minus-square", "icon-minus-square-o", "icon-level-up", "icon-level-down", "icon-check-square",
		"icon-pencil-square", "icon-external-link-square", "icon-share-square", "icon-compass", "icon-toggle-down",
		"icon-caret-square-o-down", "icon-toggle-up", "icon-caret-square-o-up", "icon-toggle-right",
		"icon-caret-square-o-right", "icon-euro", "icon-eur", "icon-gbp", "icon-dollar", "icon-usd", "icon-rupee",
		"icon-inr", "icon-cny", "icon-rmb", "icon-yen", "icon-jpy", "icon-ruble", "icon-rouble", "icon-rub",
		"icon-won", "icon-krw", "icon-bitcoin", "icon-btc", "icon-file", "icon-file-text", "icon-sort-alpha-asc",
		"icon-sort-alpha-desc", "icon-sort-amount-asc", "icon-sort-amount-desc", "icon-sort-numeric-asc",
		"icon-sort-numeric-desc", "icon-thumbs-up", "icon-thumbs-down", "icon-youtube-square", "icon-youtube",
		"icon-xing", "icon-xing-square", "icon-youtube-play", "icon-dropbox", "icon-stack-overflow",
		"icon-instagram", "icon-flickr", "icon-adn", "icon-bitbucket", "icon-bitbucket-square", "icon-tumblr",
		"icon-tumblr-square", "icon-long-arrow-down", "icon-long-arrow-up", "icon-long-arrow-left",
		"icon-long-arrow-right", "icon-apple", "icon-windows", "icon-android", "icon-linux", "icon-dribbble",
		"icon-skype", "icon-foursquare", "icon-trello", "icon-female", "icon-male", "icon-gittip", "icon-sun-o",
		"icon-moon-o", "icon-archive", "icon-bug", "icon-vk", "icon-weibo", "icon-renren", "icon-pagelines",
		"icon-stack-exchange", "icon-arrow-circle-o-right", "icon-arrow-circle-o-left", "icon-toggle-left",
		"icon-caret-square-o-left", "icon-dot-circle-o", "icon-wheelchair", "icon-vimeo-square",
		"icon-turkish-lira", "icon-try", "icon-plus-square-o", "icon-space-shuttle", "icon-slack",
		"icon-envelope-square", "icon-wordpress", "icon-openid", "icon-institution", "icon-bank", "icon-university",
		"icon-mortar-board", "icon-graduation-cap", "icon-yahoo", "icon-google", "icon-reddit",
		"icon-reddit-square", "icon-stumbleupon-circle", "icon-stumbleupon", "icon-delicious", "icon-digg",
		"icon-pied-piper-square", "icon-pied-piper", "icon-pied-piper-alt", "icon-drupal", "icon-joomla",
		"icon-language", "icon-fax", "icon-building", "icon-child", "icon-paw", "icon-spoon", "icon-cube",
		"icon-cubes", "icon-behance", "icon-behance-square", "icon-steam", "icon-steam-square", "icon-recycle",
		"icon-automobile", "icon-car", "icon-cab", "icon-taxi", "icon-tree", "icon-spotify", "icon-deviantart",
		"icon-soundcloud", "icon-database", "icon-file-pdf-o", "icon-file-word-o", "icon-file-excel-o",
		"icon-file-powerpoint-o", "icon-file-photo-o", "icon-file-picture-o", "icon-file-image-o",
		"icon-file-zip-o", "icon-file-archive-o", "icon-file-sound-o", "icon-file-audio-o", "icon-file-movie-o",
		"icon-file-video-o", "icon-file-code-o", "icon-vine", "icon-codepen", "icon-jsfiddle", "icon-life-bouy",
		"icon-life-saver", "icon-support", "icon-life-ring", "icon-circle-o-notch", "icon-ra", "icon-rebel",
		"icon-ge", "icon-empire", "icon-git-square", "icon-git", "icon-hacker-news", "icon-tencent-weibo",
		"icon-qq", "icon-wechat", "icon-weixin", "icon-send", "icon-paper-plane", "icon-send-o",
		"icon-paper-plane-o", "icon-history", "icon-circle-thin", "icon-header", "icon-paragraph", "icon-sliders",
		"icon-share-alt", "icon-share-alt-square", "icon-bomb"
	]
	var html = "";
	for (var i = 0; i < icon_arr.length; i = i + 1) {
		html = html + "<div class=\"ui-c-icon " + icon_arr[i] + "\" onclick=\"_icon.todo('" + id + "', '" + icon_arr[
			i] + "')\"></div>";
	}
	return html;
}

$(function() {
	var icon_length = $("[javatodo-icon]").length;
	for (var i = 0; i < icon_length; i = i + 1) {
		add_icon($("[javatodo-icon]").eq(i));
	}
	var len = $(".javatodo-map").length;
	for (var i = 0; i < len; i = i + 1) {
		var lat = $(".javatodo-map").eq(i).attr("javatodo-map-lat");
		var lng = $(".javatodo-map").eq(i).attr("javatodo-map-lng");
		malltodoJs.build_qqmap(document.getElementsByClassName("javatodo-map")[i], lat, lng);
	}
})
