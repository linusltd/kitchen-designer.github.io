let slideIndex = 1;
let slides;
let headerWrapper = document.querySelector('.header__wrapper')
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    console.log('callings')
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}
function showSlides(n) {
    let i;
    slides = document.getElementsByClassName("slides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    if(headerWrapper){
        headerWrapper.style.backgroundColor = slides[slideIndex-1].getAttribute('data-id')
    }

}

let i=1;

setInterval(() => {
    showSlides(slideIndex += i);
    if(i === slides.length){
        i=0;
    }
}, 5000)

// Get the modal
var modal = document.getElementById("myModal");
var addToCartModal = document.getElementById("addToCartModal");
var cartModal = document.getElementById("cartModal");
var login__popup = document.querySelector('.login__popup')
var desktop__user = document.querySelector('.desktop__user')


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {

  if (event.target == modal) {
    modal.style.display = "none";
  }
  if (event.target == addToCartModal) {
    addToCartModal.style.display = "none";
  }
  if (event.target == cartModal) {
    cartModal.style.display = "none";
  }



}
