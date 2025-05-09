let slider = document.querySelector(".slider")
let nextButton = document.getElementById("next")
let prevButton = document.getElementById("prev")

nextButton.onclick = () =>{
    slider.append(slider.querySelector("h1:first-child"))
}
prevButton.onclick = ()=>{
    slider.prepend(slider.querySelector("h1:last-child"))
}