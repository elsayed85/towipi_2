// Trigger Menu
// $(document).ready(function () {
//   $(".navbar-toggler").click(function () {
//     $(this).toggleClass("open");
//     $(".side-navbar").toggleClass("open");
//   });
//   $('.loading').delay(2500).fadeOut();
// });

// $(function () {
//   $("body").niceScroll({
//     cursorcolor: "#33c5aa",
//     cursorwidth: "10px",
//     background: "transparent",
//     cursorborder: "1px solid #33c5aa",
//     zindex: 200,
//     autohidemode: "leave",
//     cursorborderradius: 0,
//   });
// });

$(document).ready(function () {
  "use strict";
  // Get First Child of filter box and show it
  $(".filter-box:first-child").find("ul").show().end().addClass("has-open");
  // Trigger Filter toggles
  $(".filter-box h3").on("click", function () {
    $(this)
      .parent(".filter-box")
      .find("ul")
      .slideToggle()
      .end()
      .toggleClass("has-open");

    $(this)
      .parent(".filter-box")
      .siblings()
      .find("ul")
      .slideUp()
      .end()
      .removeClass("has-open");
  });

  $(".top-seller-carousel").owlCarousel({
    loop: true,
    margin: 20,
    nav: true,
    dots: false,
    thumbs: false,
    navText: [
      "<i class='fa fa-chevron-left'></i>",
      "<i class='fa fa-chevron-right'></i>",
    ],
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 3,
      },
    },
  });

  $(".product-view-gallery").owlCarousel({
    loop: false,
    margin: 0,
    nav: true,
    dots: false,
    thumbs: true,
    items: 1,
    nav: false,
    thumbContainerClass: "owl-thumbs",
    thumbItemClass: "owl-thumb-item",
  });
});

var QtyInput = (function () {
  var $qtyInputs = $(".qty-input");

  if (!$qtyInputs.length) {
    return;
  }

  var $inputs = $qtyInputs.find(".product-qty");
  var $countBtn = $qtyInputs.find(".qty-count");
  var qtyMin = parseInt($inputs.attr("min"));
  var qtyMax = parseInt($inputs.attr("max"));

  $inputs.change(function () {
    var $this = $(this);
    var $minusBtn = $this.siblings(".qty-count--minus");
    var $addBtn = $this.siblings(".qty-count--add");
    var qty = parseInt($this.val());

    if (isNaN(qty) || qty <= qtyMin) {
      $this.val(qtyMin);
      $minusBtn.attr("disabled", true);
    } else {
      $minusBtn.attr("disabled", false);

      if (qty >= qtyMax) {
        $this.val(qtyMax);
        $addBtn.attr("disabled", true);
      } else {
        $this.val(qty);
        $addBtn.attr("disabled", false);
      }
    }
  });

  $countBtn.click(function () {
    var operator = this.dataset.action;
    var $this = $(this);
    var $input = $this.siblings(".product-qty");
    var qty = parseInt($input.val());

    if (operator == "add") {
      qty += 1;
      if (qty >= qtyMin + 1) {
        $this.siblings(".qty-count--minus").attr("disabled", false);
      }

      if (qty >= qtyMax) {
        $this.attr("disabled", true);
      }
    } else {
      qty = qty <= qtyMin ? qtyMin : (qty -= 1);

      if (qty == qtyMin) {
        $this.attr("disabled", true);
      }

      if (qty < qtyMax) {
        $this.siblings(".qty-count--add").attr("disabled", false);
      }
    }

    $input.val(qty);
  });
})();
