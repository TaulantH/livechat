const form = document.querySelector(".signup form");
continueBtn = form.querySelector("input[type='submit']");
errorText = form.querySelector(".error-text"); // Select the submit button

form.onsubmit = (e) => {
    e.preventDefault();
}

continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if(data == "success"){
                    location.href = "users.php"
                }else{
                    errorText.style.display = "block";
                    errorText.textContent = data;
                   
                }
            }
        }
    }

    let formData = new FormData(form); // Corrected the typo
    xhr.send(formData);
}
