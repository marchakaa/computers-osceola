selectorsEl = document.querySelectorAll(".selector-menu .selector");
loc = window.location.href;
let params = (new URL(document.location)).searchParams;
let select = params.get("select");
let categorie = params.get("categorie");
let storeSelectEl = document.querySelector(".store p");
if (select == null) select = "All";
if (categorie == null) categorie = "All";
storeSelectEl.textContent = select + " > " + categorie;

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

let storeElements = document.querySelectorAll(".store a");
let imageURLs = document.querySelectorAll(".imageUrl")
let index = 0;
imageURLs.forEach(element => {
    console.log(element.textContent);
    let imgURL = "https://res.cloudinary.com/dj367yxj5/image/upload/v1637497945/computers/" + element.textContent + ".jpg";
    storeElements[index].style.backgroundImage = "url(" + imgURL + ")";
    storeElements[index].setAttribute("href", "select?item=" + element.textContent);
    index++;
});