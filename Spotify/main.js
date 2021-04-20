const buttons = document.querySelectorAll(".buttonContainer");

// console.log(typeof (buttons));
document.querySelectorAll(".buttonContainer").forEach(button => {
    button.addEventListener('click', event => {
        //handle click
        if (button.classList.contains('active')) {
            button.classList.remove('active');
        }
        else {
            button.classList.add('active');
        }
    })
})