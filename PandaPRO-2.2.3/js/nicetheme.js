/*
            /$$
    /$$    /$$$$
   | $$   |_  $$    /$$$$$$$
 /$$$$$$$$  | $$   /$$_____/
|__  $$__/  | $$  |  $$$$$$
   | $$     | $$   \____  $$
   |__/    /$$$$$$ /$$$$$$$/
          |______/|_______/
================================
        Keep calm and get rich.
                    Is the best.
*/
window.$ = jQuery;
const isApollo = $("meta[name=apollo-enabled]").attr("content") === "1";
var { __ } = wp.i18n;
function toggleCommentAuthorInfo() {
    var changeMsg = __("[Edit]", "pandapro");
    var closeMsg = __("[Close]", "pandapro");

    $(".comment-form-info").slideToggle("slow", function () {
        if ($(".comment-form-info").css("display") == "none") {
            $("#toggle-comment-author-info").html(changeMsg);
        } else {
            $("#toggle-comment-author-info").html(closeMsg);
        }
    });
}

function setLightModeClass() {
    $("body").removeClass("nice-dark-mode");
    $(".logo-dark").removeClass("d-inline-block");
    $(".logo-dark").addClass("d-none");
    $(".logo-light").removeClass("d-none");
    $(".logo-light").addClass("d-inline-block");
}

function setDarkMode() {
    $.ajax({
        url: globals.ajax_url,
        type: "POST",
        dataType: "html",
        data: {
            toggle_action: "on",
            action: "pandapro_toggle_dark_mode",
        },
    }).done(function () {
        setDarkModeClass();
    });
}

function setDarkModeClass() {
    $("body").addClass("nice-dark-mode");
    $(".logo-dark").removeClass("d-none");
    $(".logo-dark").addClass("d-inline-block");
    $(".logo-light").removeClass("d-inline-block");
    $(".logo-light").addClass("d-none");
}

function setLightMode() {
    $.ajax({
        url: globals.ajax_url,
        type: "POST",
        dataType: "html",
        data: {
            toggle_action: "off",
            action: "pandapro_toggle_dark_mode",
        },
    }).done(function () {
        setLightModeClass();
    });
}

// mobile Sidebar
function toggleSidebar() {
    $(".sidebar-close, .mobile-overlay").on("click", function () {
        $("body").removeClass("modal-open");
        $(".mobile-sidebar").removeClass("active");
        $(".mobile-overlay").removeClass("active");
    });
    $("#sidebarCollapse").on("click", function () {
        $("body").addClass("modal-open");
        $(".mobile-sidebar").addClass("active");
        $(".mobile-overlay").addClass("active");
        $(".collapse.in").toggleClass("in");
        $("a[aria-expanded=true]").attr("aria-expanded", "false");
    });
}

function setCurrentmenu() {
    var b = $(".mobile-sidebar-menu .current-menu-parent");
    if (b.hasClass("current-menu-ancestor")) {
        b.children().siblings(".sub-menu").stop(!0).slideDown(300);
    }
}

jQuery(document).ready(function ($) {
    toggleSidebar();
    setCurrentmenu();

    $("#email").emailautocomplete({
        domains: [
            "qq.com",
            "163.com",
            "126.com",
            "sina.com",
            "21cn.com",
            "sogou.com",
            "aliyun.com",
            "56.com",
            "sohu.com",
            "yahoo.cn",
            "yahoo.com",
            "msn.com",
            "aol.com",
            "ask.com",
            "live.com",
            "gmail.com",
            "hotmail.com",
            "live.cn",
        ],
    });

    const loadingSvg = `<div class="text-center"><div class="spinner-border spinner-border-sm text-light" role="status"></div></div>`;

    var innerHeight = window.innerHeight;
    var mainHeight = $("main").innerHeight();
    if (mainHeight > innerHeight) {
        var headerHeight = $(".header").height();
        $(window).on(
            "scroll",
            {
                TopPrev: 0,
            },
            function () {
                var TopCurrent = $(window).scrollTop();
                //check if user is scroll up
                if (TopCurrent < this.TopPrev) {
                    //if scroll up
                    if (
                        TopCurrent > 0 &&
                        $(".header").hasClass("fixed-header")
                    ) {
                        $(".header").addClass("visible-scroll-up");
                    } else {
                        $(".header").removeClass(
                            "visible-scroll-up fixed-header"
                        );
                    }
                } else {
                    //if scroll down
                    $(".header").removeClass("visible-scroll-up");
                    if (
                        TopCurrent > headerHeight &&
                        !$(".header").hasClass("fixed-header")
                    )
                        $(".header").addClass("fixed-header");
                }
                this.TopPrev = TopCurrent;
            }
        );
    }

    $(window).scroll(function () {
        var $window = $(window),
            $window_width = $window.width();

        if ($(this).scrollTop() > 200 && $window_width >= 1024) {
            $("#scrollToTOP").filter(":hidden").fadeIn("fast");
        } else {
            $("#scrollToTOP").filter(":visible").fadeOut("fast");
        }
    });
    $("#scrollToTOP").on("click", function () {
        $("html, body").animate(
            {
                scrollTop: 0,
            },
            "slow"
        );
        return false;
    });

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (
            location.pathname.replace(/^\//, "") ==
                this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname
        ) {
            var target = $(this.hash);
            target = target.length
                ? target
                : $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
                $("html, body").animate(
                    {
                        scrollTop: target.offset().top - 60,
                    },
                    1000,
                    "easeInOutExpo"
                );
                return false;
            }
        }
    });

    // theiaStickySidebar
    $(".sidebar").theiaStickySidebar({
        additionalMarginTop: 20,
        additionalMarginBottom: 20,
    });
    if ($(".main-menu li").hasClass("menu-item-has-children")) {
        $(".main-menu .menu-item-has-children").prepend(
            '<div class="submenu-arrow iconfont icon-jiantou1"></div>'
        );
    }
    $(".mobile-sidebar-menu .menu-item-has-children > a").append(
        '<div class="dropdown-sub-menu"><span class="iconfont icon-right"></span></div>'
    ),
        $(document).on(
            "click",
            ".mobile-sidebar-menu .menu-item-has-children > a",
            function (event) {
                var i = $(this);
                i.siblings(".mobile-sidebar-menu .sub-menu")[0] &&
                    (event.preventDefault(),
                    i.parent().hasClass("in")
                        ? (i.parent().removeClass("in"),
                          i.parent().find(".in").removeClass("in"),
                          i.parent().find(".sub-menu").stop(!0).slideUp(300))
                        : (i.closest(".in")[0] ||
                              (i
                                  .find(".menu-item-has-children.in .sub-menu")
                                  .stop(!0)
                                  .slideUp(300),
                              i
                                  .find(".menu-item-has-children.in")
                                  .removeClass("in")),
                          i.parent().addClass("in"),
                          i
                              .parent()
                              .siblings(".in")
                              .find(".sub-menu")
                              .stop(!0)
                              .slideUp(300),
                          i
                              .parent()
                              .siblings(".current-menu-parent")
                              .find(".sub-menu")
                              .stop(!0)
                              .slideUp(300),
                          i.parent().siblings(".in").removeClass("in"),
                          i.siblings(".sub-menu").stop(!0).slideDown(300)));
            }
        );

    // banner
    var banner1 = $(".slide-style-1");
    if (banner1.length > 0) {
        var banner1 = new Swiper(".slide-style-1", {
            loop: true,
            spaceBetween: 15,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    }
    var banner2 = $(".slide-style-2");
    if (banner2.length > 0) {
        var banner2 = new Swiper(".slide-style-2", {
            loop: true,
            spaceBetween: 15,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    }
    var banner3 = $(".slide-style-3 .swiper");
    if (banner3.length > 0) {
        var banner3 = new Swiper(".slide-style-3 .swiper", {
            loop: true,
            spaceBetween: 15,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    }
    var banner4 = $(".slide-style-4");
    if (banner4.length > 0) {
        var banner2 = new Swiper(".slide-style-4", {
            loop: true,
            spaceBetween: 15,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    }
    var ajaxSwiper = $(".slide-ajax-menu");
    if (ajaxSwiper.length > 0) {
        var ajaxSwiper = new Swiper(".slide-ajax-menu", {
            spaceBetween: 10,
            slidesPerView: "auto",
            breakpoints: {
                320: {
                    spaceBetween: 5,
                },
                // when window width is >= 640px
                640: {
                    navigation: {
                        nextEl: ".slide-ajax-menu .button-next",
                        prevEl: ".slide-ajax-menu .button-prev",
                    },
                },
            },
        });
    }

    var columnsSwiper = $(".index-columns-cat");
    if (columnsSwiper.length > 0) {
        var columnsSwiper = new Swiper(".index-columns-cat", {
            freeMode: true,
            breakpoints: {
                320: {
                    spaceBetween: 8,
                    slidesPerView: "auto",
                },

                640: {
                    spaceBetween: 6,
                    slidesPerView: "auto",
                },
                768: {
                    spaceBetween: 8,
                    slidesPerView: "auto",
                },
                1200: {
                    spaceBetween: 8,
                    slidesPerView: 10,
                },
            },
        });
    }

    $(document).on("click", ".list-ajax-menu .btn-ajaxpost", function (event) {
        event.preventDefault();
        var t = $(this);
        var cid = t.data("cid");
        $(".list-ajax-menu .btn-ajaxpost").removeClass("active");
        t.addClass("active");
        if (cid) {
            $(".dposts-ajax-load").data("tabcid", cid);
        } else {
            $(".dposts-ajax-load").removeData("tabcid");
        }
        $(".dposts-ajax-load").data("paged", 1);
        $("." + $(".dposts-ajax-load").data().append).html("");
        // disable button when loading
        $(".dposts-ajax-load")
            .addClass("loading")
            .text(__("Load more...", "pandapro"));
        $(".list-ajax-menu .btn-ajaxpost").attr("disabled", "disabled");
        $(".dposts-ajax-load").removeAttr("disabled");
        ajax_load_posts($(".dposts-ajax-load").data(), function () {
            $(".list-ajax-menu .btn-ajaxpost").removeAttr("disabled");
        });
    });

    function ajax_load_comments(data) {
        const buttonDOM = $("#comments-next-button");
        const buttonText = buttonDOM.text();

        buttonDOM.html(loadingSvg).attr("disabled", "disabled");
        $.ajax({
            url: globals.ajax_url,
            type: "POST",
            dataType: "html",
            data: data,
        }).done(function (response) {
            if (response) {
                if (data.commentspage == "newest") {
                    buttonDOM.data("paged", data.paged * 1 - 1);
                } else {
                    buttonDOM.data("paged", data.paged * 1 + 1);
                }
                $("." + data.append).append(response);
                buttonDOM.text(buttonText).removeAttr("disabled");
            } else {
                buttonDOM.hide();
            }
        });
    }

    if ($(".toc").length > 0) {
        var headerEl = "h2,h3,h4",
            content = ".toc-class",
            idArr = {};

        $(".post-content").find(headerEl).parent().addClass("toc-class");

        $(content)
            .children(headerEl)
            .each(function () {
                var headerId = $(this)
                    .text()
                    .replace(
                        /[\s|\~|`|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\_|\+|\=|\||\|\[|\]|\{|\}|\;|\:|\"|\'|\,|\<|\.|\>|\/|\?|\：|\，|\。]/g,
                        ""
                    );

                headerId = headerId.toLowerCase();
                if (idArr[headerId]) {
                    $(this).attr("id", headerId + "-" + idArr[headerId]);
                    idArr[headerId]++;
                } else {
                    idArr[headerId] = 1;
                    $(this).attr("id", headerId);
                }
            });

        tocbot.init({
            tocSelector: ".toc",
            contentSelector: content,
            headingSelector: headerEl,
            positionFixedSelector: ".toc",
            positionFixedClass: "is-position-fixed",
            scrollSmooth: true,
            scrollSmoothOffset: -100,
            headingsOffset: 100,
        });
    }

    $(document).on("click", "#comments-next-button", function (event) {
        event.preventDefault();
        ajax_load_comments($("#comments-next-button").data());
    });

    $(document).on(
        "click",
        '.post-like-button[data-action="like"]',
        function (event) {
            event.preventDefault();
            var $this = $(".post-like-button");
            var id = $(this).data("id");

            if ($this.hasClass("requesting")) {
                return false;
            }

            $this.addClass("requesting");
            $.ajax({
                url: globals.ajax_url,
                type: "POST",
                dataType: "html",
                data: { action: "pandapro_like", id, like_action: "like" },
            })
                .done(function (data) {
                    $this.addClass("active");
                    $this.attr("data-action", "unlike");
                    ncPopupTips(1, __("Thank you!", "pandapro"));
                    $(".like-count").html(data.trim());
                    isApollo && apolloAjaxPostLikeSection(id);
                })
                .always(function () {
                    $this.removeClass("requesting");
                });
            return false;
        }
    );

    $(document).on(
        "click",
        '.post-like-button[data-action="unlike"]',
        function (event) {
            event.preventDefault();
            var $this = $(".post-like-button");
            var id = $(this).data("id");

            if ($this.hasClass("requesting")) {
                return false;
            }
            $this.addClass("requesting");

            $this.removeClass("active");

            $.ajax({
                url: globals.ajax_url,
                type: "POST",
                dataType: "html",
                data: { action: "pandapro_like", id, like_action: "unlike" },
            })
                .done(function (data) {
                    $this.removeClass("active");
                    $this.attr("data-action", "like");
                    ncPopupTips(0, __("Cancelled.", "pandapro"));
                    $(".like-count").html(data.trim());
                    isApollo && apolloAjaxPostLikeSection(id);
                })
                .always(function () {
                    $this.removeClass("requesting");
                });
            return false;
        }
    );

    function apolloAjaxPostLikeSection(id) {
        $.ajax({
            url: globals.ajax_url,
            type: "POST",
            dataType: "html",
            data: {
                action: "ajax_apollo_userlike_section",
                id: id,
            },
        }).done(function (response) {
            $("#apollo-postlike-section").length > 0 &&
                $("#apollo-postlike-section").remove();
            if (response.trim()) {
                $(".post-actions").after(response);
            }
        });
    }

    $(document).on("click", ".single-popup", function (event) {
        event.preventDefault();
        var img = $(this).data("img");
        var title = $(this).data("title");
        var desc = $(this).data("desc");
        var html =
            '<div class="text-center"><h6 class="py-1">' +
            title +
            '</h6>\
                    <div class="text-muted text-sm mb-2" > ' +
            desc +
            ' </div>\
                    <img src="' +
            img +
            '" alt="' +
            title +
            '" style="width:100%;height:auto;">\
                    </div>';
        ncPopup("small", html);
    });

    $(document).on("click", ".plus-power-popup", function (event) {
        event.preventDefault();
        var $this = $("#plus-power-popup-wrap");
        ncPopup("no-padding", $this.html());
    });

    $(document).on("click", ".btn-share-toggler", function (event) {
        event.preventDefault();
        ncPopup("middle", $("#single-share-template").html());
    });

    function isElementInViewport(el) {
        var rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <=
                (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <=
                (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    function givenElementInViewport(el, fn) {
        return function () {
            if (isElementInViewport(el)) {
                fn.call();
            }
        };
    }

    function addViewportEvent(el, fn) {
        if (window.addEventListener) {
            addEventListener(
                "DOMContentLoaded",
                givenElementInViewport(el, fn),
                false
            );
            addEventListener("load", givenElementInViewport(el, fn), false);
            addEventListener("scroll", givenElementInViewport(el, fn), false);
            addEventListener("resize", givenElementInViewport(el, fn), false);
        } else if (window.attachEvent) {
            attachEvent("DOMContentLoaded", givenElementInViewport(el, fn));
            attachEvent("load", givenElementInViewport(el, fn));
            attachEvent("scroll", givenElementInViewport(el, fn));
            attachEvent("resize", givenElementInViewport(el, fn));
        }
    }

    if ($(".list-ajax-load").length > 0) {
        addViewportEvent(
            document.querySelector(".list-ajax-load"),
            function () {
                if ($(".dposts-ajax-load").data("comments") == "comments") {
                    return false;
                }

                if ($(".list-ajax-load").hasClass("loading") === false) {
                    var data = $(".dposts-ajax-load").data();
                    if ($(".dposts-ajax-load").data("paged") <= 3) {
                        $(".list-ajax-load").addClass("loading");
                        ajax_load_posts($(".dposts-ajax-load").data());
                    }
                }
            }
        );
    }

    $(document).on("click", ".refresh-random-post", function (event) {
        event.preventDefault();
        var $this = jQuery(this);

        $.ajax({
            url: globals.ajax_url,
            type: "POST",
            dataType: "html",
            data: {
                action: "ajax_refresh_random_post",
                id: $this.data().id,
            },
        }).done(function (response) {
            if (response.trim()) {
                $this.parents(".widget_post_card").html(response.trim());
            }
        });
    });

    // dark mode
    if (globals.allow_switch_darkmode !== "0") {
        if (
            globals.allow_switch_darkmode === "device" &&
            window.matchMedia &&
            window.matchMedia("(prefers-color-scheme)").media !== "not all"
        ) {
            if (window.matchMedia("(prefers-color-scheme: dark)").matches)
                setDarkMode();
            window
                .matchMedia("(prefers-color-scheme: dark)")
                .addListener(function (e) {
                    e.matches && setDarkMode();
                });
            if (window.matchMedia("(prefers-color-scheme: light)").matches)
                setLightMode();
            window
                .matchMedia("(prefers-color-scheme: light)")
                .addListener(function (e) {
                    e.matches && setLightMode();
                });
        }

        $(document).on("click", ".switch-dark-mode", function (event) {
            event.preventDefault();
            $.ajax({
                url: globals.ajax_url,
                type: "POST",
                dataType: "html",
                data: {
                    toggle_action:
                        $("body").hasClass("nice-dark-mode") === true
                            ? "off"
                            : "on",
                    action: "pandapro_toggle_dark_mode",
                },
            }).done(function (response) {
                if (!$("body").hasClass("nice-dark-mode")) {
                    setDarkModeClass();
                    return;
                }
                setLightModeClass();
            });
        });
    }

    $(document).on("click", ".dposts-ajax-load", function (event) {
        event.preventDefault();
        var $this = jQuery(this);
        if ($(".list-ajax-load").hasClass("loading") === false) {
            $(".list-ajax-load").addClass("loading");
            ajax_load_posts($this.data());
        }
    });

    function ajax_load_posts(data, callback = function () {}) {
        const loadButton = $(".dposts-ajax-load");
        const listAjaxLoad = $(".list-ajax-load");

        if (loadButton.attr("disabled")) {
            return false;
        }
        loadButton.html(loadingSvg).attr("disabled", "disabled");

        $.ajax({
            url: globals.ajax_url,
            type: "POST",
            dataType: "html",
            data: data,
        }).done(function (response) {
            callback();
            if (response.trim()) {
                loadButton.removeAttr("disabled");
                loadButton.data("paged", data.paged * 1 + 1);
                $("." + data.append).append(response);
                listAjaxLoad.removeClass("loading");
                loadButton.text(__("Load more...", "pandapro"));
            } else {
                loadButton.attr("disabled", "disabled");
                loadButton.text(__("You've reached the end.", "pandapro"));
            }
        });
    }
}); // End of use strict
console.log(
    "\n" +
        " %c PandaPRO Designed by nicetheme® %c https://www.nicetheme.cn " +
        "\n",
    "color: #fadfa3; background: #030307; padding:5px 0; font-size:12px;",
    "background: #fadfa3; padding:5px 0; font-size:12px;"
);
