// Navbar Section Start
let menu = document.querySelector('#menu-bars');
let navbar = document.querySelector('.navbar');
// Navbar Mobile Active Button
menu.onclick = () => {
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
}
// Navbar Mobile Active Responsive
let section = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header .navbar a');
window.onscroll = () => {
  menu.classList.remove('fa-times');
  navbar.classList.remove('active');
  section.forEach(sec => {
    let top = window.scrollY;
    let height = sec.offsetHeight;
    let offset = sec.offsetTop - 150;
    let id = sec.getAttribute('id');
    if (top >= offset && top < offset + height) {
      navLinks.forEach(links => {
        links.classList.remove('active');
        document.querySelector('header .navbar a[href*=' + id + ']').classList.add('active');
      });
    };
  });
}



// About Section Start\
// Show More - Show Less
function moreFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("moreBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less";
    moreText.style.display = "inline";
  }
}



// Menu Section Start
// Menu Filter Style
const selected = document.querySelector(".selected");
const optionsContainer = document.querySelector(".list-menu");
const optionsList = document.querySelectorAll(".option");
selected.addEventListener("click", () => {
  optionsContainer.classList.toggle("active");
});

optionsList.forEach(o => {
  o.addEventListener("click", () => {
    selected.innerHTML = o.querySelector("button").innerHTML;
    optionsContainer.classList.remove("active");
  });
});
// Menu Filter On Click
$(document).ready(function () {
  var showmore = document.getElementById("showmore");
  var $list = $(".box-container .box").hide(),
    $content;
  $(".option").on("click", function () {
    var $this = $(this);
    $this.addClass("active").siblings().removeClass("active");
    $content = $list.filter("." + this.id).hide();
    $content.slice(0, 6).show(1000);
    $list.not($content).hide(1000);
    showmore.style.display = "block";
  })
    .filter(".active")
    .click();
  $(".showmore").on("click", function () {
    $content.filter(":hidden").slice(0, 1000).slideDown("slow");
    showmore.style.display = "none";
  });
});


// Menu Popup View
$('.btn').click(function () {
  $(this).addClass('active').siblings().removeClass('active');
})
var popupViews = document.querySelectorAll('.popup-view');
var popupBtns = document.querySelectorAll('.popup-btn');
var closeBtns = document.querySelectorAll('.close-btn');
//javascript for quick view button
var popup = function (popupClick) {
  popupViews[popupClick].classList.add('active');
}
popupBtns.forEach((popupBtn, i) => {
  popupBtn.addEventListener("click", () => {
    popup(i);
  });
});
//javascript for close button
closeBtns.forEach((closeBtn) => {
  closeBtn.addEventListener("click", () => {
    popupViews.forEach((popupView) => {
      popupView.classList.remove('active');
    });
  });
});


// Review Section Start
var swiper = new Swiper(".review-slider", {
  spaceBetween: 10,
  // centeredSlides: true, (Position Center)
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
    },
    640: {
      slidesPerView: 3,
    },
    768: {
      slidesPerView: 3,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});


// Back-To-Top Section Start
$(window).scroll(function () {
  if ($(this).scrollTop() > 100) {
    $('.back-to-top').fadeIn('slow');
  } else {
    $('.back-to-top').fadeOut('slow');
  }
});


// Loader Section Start
// function loader(){
//   document.querySelector('.loader-container').classList.add('fade-out');
// }

// function fadeOut(){
//   setInterval(loader, 3000);
// }

// window.onload = fadeOut;


