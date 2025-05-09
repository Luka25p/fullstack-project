const burger = document.getElementById("burger");
const navLinks = document.querySelectorAll(".nav-links");

burger.addEventListener("click", () => {
  navLinks.forEach(nav => nav.classList.toggle("active"));
});
