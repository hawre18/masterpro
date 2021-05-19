const modal = document.querySelector(".modal-video");
const headVideo = document.querySelector("#head-video");
const body = document.querySelector("body");
headVideo.addEventListener("click", () => {
  modal.classList.add("active");
  body.style.overflow = "hidden";
});

document.addEventListener("click", (e) => {
  if (modal.contains(e.target)) {
    modal.classList.remove("active");
    body.style.overflow = "inherit";
  }
});
