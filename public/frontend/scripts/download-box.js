const downloadIcon = document.querySelectorAll(".download-icon");
const downloadContainer = document.querySelectorAll(".downloads-box");

downloadIcon.forEach((icon) => {
  icon.addEventListener("click", () => {
    downloadContainer.forEach((con) => {
      con.classList.toggle("active");
    });
  });
});
