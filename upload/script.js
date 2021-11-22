let changeButton = document.querySelector(".change");
changeButton.addEventListener("click", function(e) {
    let tableEl = document.querySelector(".table");
    console.log(tableEl.value);
    
    e.stopPropagation();
    loc = "?table=" + tableEl.value;
    window.location.href = loc;

})