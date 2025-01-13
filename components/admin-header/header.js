//Menu Toggle
document.addEventListener("DOMContentLoaded", function() {
  const menuToggle = document.getElementById("menu-toggle");
  const sidebar = document.getElementById("sidebar");
  const mainContent = document.querySelector(".main-body");

  menuToggle.addEventListener("click", function() {
    sidebar.classList.toggle("collapsed");
    mainContent.classList.toggle("expanded");
  });
});