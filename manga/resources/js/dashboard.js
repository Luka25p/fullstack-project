

let following = document.getElementById("following");
let followingCard = document.querySelector(".following-card");
let followingCardF = document.querySelector(".filter");


let notification = document.getElementById("notification");
let notificationCard = document.querySelector(".notificationCard")
let notificationCardF = document.querySelector(".filter3");


notification.addEventListener("click", ()=>{
    notificationCard.classList.toggle("show")
});

notificationCardF.addEventListener("click", ()=>{
    notificationCard.classList.remove("show")
});


following.addEventListener("click", ()=>{
    followingCard.classList.toggle("show")
});

followingCardF.addEventListener("click", ()=>{
    followingCard.classList.remove("show")
});

let followers = document.getElementById("followers");
let followersCard = document.querySelector(".followers-card");
let followersCardF = document.querySelector(".filter2");

followers.addEventListener("click", ()=>{
    followersCard.classList.toggle("show")
});

followersCardF.addEventListener("click", ()=>{
    followersCard.classList.remove("show")
});