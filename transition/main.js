const sections = document.querySelectorAll(".container");

const options = {
    threshold: 1
};

let observer = new IntersectionObserver(navCheck, options);

function navCheck(entries) {
    entries.forEach(entry => {
        // console.log(entry);
    });
}

sections.forEach(section => {
    section.addEventListener('scroll', (event) => {
        console.log("scrolling");
        var node = event.target;
        const bottom = node.scrollHeight - node.scrollTop === node.clientHeight;
        if (bottom) {
            console.log("BOTTOM REACHED:", bottom);
        }
    })
})