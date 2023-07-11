const toggleBtn = document.querySelector(".toggle-btn");
const toggleBtnIcon = document.querySelector(".toggle-btn i");
const dropDownMenu = document.querySelector(".dropdown-menu");

toggleBtn.onclick = function () {
  dropDownMenu.classList.toggle("open");
  const isOpen = dropDownMenu.classList.contains("open");

  toggleBtnIcon.classList = isOpen ? "bi bi-x" : "bi bi-list";
};

// function btnClicked() {
//   document.getElementById("section_2").scrollIntoView({ behavior: "smooth" });
// }

const dropdowns = document.querySelectorAll(".dropdown");

dropdowns.forEach((dropdown) => {
  const select = dropdown.querySelector(".select");
  const caret = dropdown.querySelector(".caret");
  const menu = dropdown.querySelector(".menu");
  const options = dropdown.querySelector(".menu li");
  const selected = dropdown.querySelector(".selected");
});

function submitForm() {
    document.getElementById("filterrr").submit();
}