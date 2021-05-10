const profilePic = document.querySelector(".profilePic img");
const links = document.querySelector(".links");

profilePic.addEventListener("click", () => {
    links.classList.toggle("active");
});
