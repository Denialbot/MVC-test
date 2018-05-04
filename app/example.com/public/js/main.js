let elements = Array.from(document.getElementsByClassName("deletion")); //hämtar alla delete-länkar från Admin Dashboard
elements.forEach( element => {
    element.addEventListener("click", (event) =>{ //ett inlägg tas bort när dess "delete"-knapp trycks
        const posid = element.dataset.id; //hämtar inläggets id genom attributet "data-id" i Admin Dashboard
        const url = element.dataset.url;
        event.preventDefault(); //stoppar länken från att skicka användaren till en annan sida
        fetch(url +"/posts/delete/" + posid) //skickar ett HTTP-GET-Request och tar bort inlägget
        .then(function(){
            const post= document.getElementById("post-"+posid);
            post.innerHTML = ""; //tömmer html-koden för inlägget som just togs bort
        })
    })
});