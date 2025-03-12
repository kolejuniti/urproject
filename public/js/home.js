document.getElementById("current-year").textContent = new Date().getFullYear();

const carousel = document.querySelector('#carouselExampleIndicators');
const bsCarousel = new bootstrap.Carousel(carousel, {
  interval: 5000, 
  wrap: true, 
});

 
setInterval(() => {
  bsCarousel.next(); 
}, 5000);

document.addEventListener("DOMContentLoaded", function () {
  const counters = document.querySelectorAll(".stat-number");
  const duration = 3000;

  counters.forEach((counter) => {
    const target = parseInt(counter.getAttribute("data-target"), 10);
    let unit = counter.getAttribute("data-unit") || "+";
    let count = 0;
    const increment = Math.max(1, target / (duration / 16));

    if (unit === "+" && target < 10) {
      unit = "";
    }

    const updateCount = () => {
      count += increment;

      if (count < target) {
        counter.innerText = Math.ceil(count) + unit;
        setTimeout(updateCount, 16);
      } else {
        counter.innerText = target + unit; 
      }
    };

    counter.innerText = "0" + unit;
    updateCount();
  });
});
;

function toggleProgram(element) {
  const content = element.nextElementSibling; 
  content.style.display = content.style.display === 'none' || content.style.display === '' ? 'block' : 'none';

  element.classList.toggle('active');
}



  document.addEventListener("DOMContentLoaded", function () {

    const popupLinks = document.querySelectorAll(".popupimage");
    popupLinks.forEach(link => {
      link.addEventListener("click", function (event) {
        event.preventDefault();
        const imageUrl = this.getAttribute("href");
        document.getElementById("popupImage").src = imageUrl;
        const modal = new bootstrap.Modal(document.getElementById("imageModal"));
        modal.show();
      });
    });
  

    const pdfLinks = document.querySelectorAll(".popup-pdf");
    pdfLinks.forEach(link => {
      link.addEventListener("click", function (event) {
        event.preventDefault();
        const pdfUrl = this.getAttribute("href");
        document.getElementById("popupPdf").src = pdfUrl;
        const modal = new bootstrap.Modal(document.getElementById("pdfModal"));
        modal.show();
      });
    });
  });
  

  

  $(document).ready(function(){
    $("#projects-slider").owlCarousel({
      loop: true,
      margin: 10, 
      nav: false,  
      dots: true,
      autoplay: true,
      autoplayTimeout: 4000, 
      autoplayHoverPause: true,
      responsive: {
        0: { items: 1 },      
        576: { items: 1 },    
        768: { items: 3 },    
        992: { items: 3 },    
        1200: { items: 4 },  
        1400: { items: 5 }   
      },
      animateOut: 'fadeOut',
      animateIn: 'fadeIn'
    });
});
