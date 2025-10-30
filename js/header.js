// Add 'scrolled' class when you scroll down
window.addEventListener('scroll', function() {
  const navbar = document.getElementById('navbar');
  if (window.scrollY > 50) {  // change 50 to your preferred scroll distance
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
});