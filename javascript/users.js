const searchBar = document.querySelector(".users .search input"),
searchBtn = document.querySelector(".users .search button"),
usersList = document.querySelector(".users .users-list");

searchBtn.onclick = () =>{
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value ="";
}

searchBar.onkeyup = () =>{
    let searchTerm = searchBar.value;
    if(searchTerm != ""){
        searchBar.classList.add("active");

    }else{
        searchBar.classList.remove("active");

    }
    const usersList = document.querySelector(".users-list");

    // Function to check for new messages
    function checkForNewMessages() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "php/check-new-messages.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = xhr.responseText;
                if (response) {
                    // If there are new messages, display a notification or update the user list
                    usersList.innerHTML = response;
                }
            }
        };
        xhr.send();
    }
    
    // Periodically check for new messages
    setInterval(checkForNewMessages, 5000);
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/search.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
               usersList.innerHTML = data;
               
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/users.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
               if(!searchBar.classList.contains("active")){
                usersList.innerHTML = data;

               }
            }
        }
    }
    xhr.send();
}, 500);