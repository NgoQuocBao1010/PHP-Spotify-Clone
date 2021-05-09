const logoContainer = document.querySelector(".logoContainer");
const img = document.querySelector("img");
const h2 = document.querySelector("h2");
const ul = document.querySelector("ul");
img.addEventListener("click", () => {
    logoContainer.classList.toggle("active");

    if (
        !logoContainer.classList.contains("active") &
        ul.classList.contains("activeUl")
    ) {
        ul.classList.toggle("activeUl");
    }
});
h2.addEventListener("click", () => {
    ul.classList.toggle("activeUl");
});
