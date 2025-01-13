window.addEventListener("DOMContentLoaded", () => {
  // (A) GET ALL IMAGES
  var allImages = document.querySelectorAll(".gallery img");
 
  // (B) CLICK ON IMAGE TO TOGGLE FULLSCREEN
  if (allImages.length > 0) { for (let img of allImages) {
    img.onclick = () => img.classList.toggle("full");
  }}
});
