selectorsEl = document.querySelectorAll(".selector-menu .selector");
loc = window.location.href;
let params = (new URL(document.location)).searchParams;
let item = params.get("item");

selectorsEl.forEach(element => {
    element.addEventListener("mouseover", function(e) {
        element.querySelector(".options").style.display = "inherit";
    })
    element.addEventListener("mouseout", function(e) {
        element.querySelector(".options").style.display = "none";
    })
    element.addEventListener("click", function(e) {
        loc = "?select=" + element.querySelector("p").textContent.toLowerCase();
        window.location.href = loc;
    })
    optionsEl = element.querySelectorAll(".options div")
    optionsEl.forEach(option => {
        option.addEventListener("click", function(e) {
            e.stopPropagation();
            loc = "?select=" + element.querySelector("p").textContent.toLowerCase() + "&categorie=" + option.textContent.toLowerCase();
            window.location.href = loc;
        })
    });
});

let image = document.querySelector(".item .buttons .image");
let imgURL = "https://res.cloudinary.com/dj367yxj5/image/upload/v1637497945/computers/" + item + ".jpg";
image.style.backgroundImage = "url(" + imgURL + ")";

