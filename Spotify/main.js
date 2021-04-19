const buttons = document.querySelectorAll(".buttonContainer");

// console.log(typeof (buttons));
document.querySelectorAll(".buttonContainer").forEach(item => {
    item.addEventListener('click', event => {
        //handle click
        if (item.classList.contains('active')) {
            item.classList.remove('active');
        }
        else {
            item.classList.add('active');
        }
    })
})