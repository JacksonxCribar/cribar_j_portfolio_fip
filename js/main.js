indow.onload = () => {

    const
        button = document.getElementById("send-button"),
        form = document.getElementById("contact-form"),
        formError = document.getElementById("form-error"),
        xhr = new XMLHttpRequest();

    // disables the form send button
    const disableBtn = () => {
        button.disabled = true;
        button.innerHTML = "Sending...";
    };

    // enables the form send button
    const resetFormState = () => {
        button.disabled = false;
        button.innerHTML = "Send Inquiry";
        formError.innerHTML = "";
        form.classList.remove("success", "error");
    };

    handleXhrResponse = () => {
        // only do something when ready state is done (4)
        if (xhr.readyState === 4) {
            resetFormState();

            switch (xhr.responseText) {
                case "success":
                    form.classList.add("success");
                    form.innerHTML = "<p>Thank you for your inquiry!</p>";
                    break;

                case "recaptcha-error":
                    form.classList.add("error");
                    formError.innerHTML = "<p>Please complete the Google reCaptcha.</p>";
                    break;

                default:
                case "error":
                    form.classList.add("error");
                    formError.innerHTML = "<p>Sorry, something went wrong. Please try again.</p>";
                    break;
            }
        }
    };

    // submit the form using AJAX and handle any errors
    submitForm = (event) => {
        event.preventDefault();
        disableBtn();

        let data = new FormData(form);
        data.append("ajax", true);

        xhr.onreadystatechange = handleXhrResponse;

        xhr.open("POST", form.getAttribute("action"));
        xhr.send(data);
    };

    form.addEventListener("submit", submitForm, false);
};