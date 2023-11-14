document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("categories").addEventListener("change", function () {
    let selectedCategory = this.value;
    let allCategories = document.querySelectorAll(".category-content");
    allCategories.forEach(function (content) {
      content.style.display = "none";
    });
    document.getElementById(selectedCategory).style.display = "block";
  });
});
