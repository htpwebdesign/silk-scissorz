document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("categories").addEventListener("change", function () {
    let selectedCategory = this.value;
    let allCategories = document.querySelectorAll(".category-content");
    let allButton = document.getElementById("all-categories");

    if (selectedCategory == allButton.value){
      allCategories.forEach(function (content) {
      content.style.display = "block";});
    }else{
    allCategories.forEach(function (content) {
      content.style.display = "none";
    });
    document.getElementById(selectedCategory).style.display = "block";}
  });

  
});
