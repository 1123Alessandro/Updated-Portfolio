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

const editBtn = document.getElementById("edit-btn");
const updateBtn = document.getElementById("update-btn");
const nameField = document.getElementById("name");
const typeField = document.getElementById("type");
const addressField = document.getElementById("address");
const phoneNumberField = document.getElementById("phone-number");
const occupationField = document.getElementById("occupation");
const emailField = document.getElementById("email");
const passwordField = document.getElementById("password");
const statusMsg = document.getElementById("status-msg");
const inputs = document.querySelectorAll("input");
const form = document.getElementById("update-acc");

editBtn.addEventListener("click", function () {
  nameField.disabled = false;
  typeField.disabled = false;
  addressField.disabled = false;
  phoneNumberField.disabled = false;
  occupationField.disabled = false;
  emailField.disabled = false;
  passwordField.disabled = false;

  updateBtn.style.display = "block";
  editBtn.style.display = "none";

  nameField.style.backgroundColor = "rgba(122, 145, 121, 0.14)";
  nameField.style.borderRadius = "15px";
  nameField.style.paddingLeft = "15px";
  typeField.style.backgroundColor = "rgba(122, 145, 121, 0.14)";
  typeField.style.borderRadius = "15px";
  typeField.style.paddingLeft = "15px";
  addressField.style.backgroundColor = "rgba(122, 145, 121, 0.14)";
  addressField.style.borderRadius = "15px";
  addressField.style.paddingLeft = "15px";
  phoneNumberField.style.backgroundColor = "rgba(122, 145, 121, 0.14)";
  phoneNumberField.style.borderRadius = "15px";
  phoneNumberField.style.paddingLeft = "15px";
  occupationField.style.backgroundColor = "rgba(122, 145, 121, 0.14)";
  occupationField.style.borderRadius = "15px";
  occupationField.style.paddingLeft = "15px";
  emailField.style.backgroundColor = "rgba(122, 145, 121, 0.14)";
  emailField.style.borderRadius = "15px";
  emailField.style.paddingLeft = "15px";
  passwordField.style.backgroundColor = "rgba(122, 145, 121, 0.14)";
  passwordField.style.borderRadius = "15px";
  passwordField.style.paddingLeft = "15px";
});

updateBtn.addEventListener("click", function () {
  if (
    nameField.value !== "" &&
    typeField.value !== "" &&
    addressField.value !== "" &&
    phoneNumberField.value !== "" &&
    occupationField.value !== "" &&
    emailField.value !== "" &&
    passwordField.value !== ""
  ) {
    form.submit();
    statusMsg.innerHTML = "Changes Saved";
    statusMsg.style.color = "green";
    setTimeout(function () {
      statusMsg.style.display = "none";
    }, 6000);

    nameField.style.backgroundColor = "white";
    nameField.style.paddingLeft = "0px";
    typeField.style.backgroundColor = "white";
    typeField.style.paddingLeft = "0px";
    addressField.style.backgroundColor = "white";
    addressField.style.paddingLeft = "0px";
    phoneNumberField.style.backgroundColor = "white";
    phoneNumberField.style.paddingLeft = "0px";
    occupationField.style.backgroundColor = "white";
    occupationField.style.paddingLeft = "0px";
    emailField.style.backgroundColor = "white";
    emailField.style.paddingLeft = "0px";
    passwordField.style.backgroundColor = "white";
    passwordField.style.paddingLeft = "0px";

    nameField.disabled = true;
    typeField.disabled = true;
    addressField.disabled = true;
    phoneNumberField.disabled = true;
    occupationField.disabled = true;
    emailField.disabled = true;
    passwordField.disabled = true;

    updateBtn.style.display = "none";
    editBtn.style.display = "block";
  } else {
    statusMsg.innerHTML = "Do not leave a field empty";
    statusMsg.style.color = "red";
  }
});
