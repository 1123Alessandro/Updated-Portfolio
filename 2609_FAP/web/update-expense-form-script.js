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

  select.addEventListener("click", () => {
    alert(
      "WIP: Scroll down while hovering in the dropdown to access other inputs"
    );
    select.classList.toggle("select-clicked");
    caret.classList.toggle("caret-rotate");
    menu.classList.toggle("menu-open");
  });

  options.forEach((option) => {
    option.addEventListener("click", () => {
      selected.innerText = option.innerText;
      select.classList.remove("select-clicked");
      caret.classList.remove("caret-rotate");
      menu.classList.remove("menu-rotate");
      options.forEach((option) => {
        option.classList.remove("active");
      });
      option.classList.add("active");
    });
  });
});

function validate() {
  var price = document.form.price.value;
  var pattern = /^\d{0,8}(\.\d{1,4})?$/;
  var valid = pattern.test(price);
  if (price == null || price == "") {
    alert("Price can't be empty");
    return false;
  }
  if (!valid) {
    alert("Enter correct price");
    return false;
  }
  return true;
}
