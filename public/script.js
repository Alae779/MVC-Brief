let avcbtn = document.getElementById("avocatBtn")
let hsbtn = document.getElementById("huissierBtn")
let hsfield = document.getElementById("huissierFields")
let avcfield = document.getElementById("avocatFields")
let selected = document.getElementById("professionalType")
    hsbtn.addEventListener("click", (e) => {
        e.preventDefault();
        selected.value = "huissier"
        hsbtn.classList.add("active")
        avcbtn.classList.remove("active")
        avcfield.classList.add("hidden")
        hsfield.classList.remove("hidden")
    })
    avcbtn.addEventListener("click", (e) => {
        e.preventDefault();
        selected.value = "avocat"
        avcbtn.classList.add("active")
        hsbtn.classList.remove("active")
        avcfield.classList.remove("hidden")
        hsfield.classList.add("hidden")
    })
