document.addEventListener("DOMContentLoaded", function() {
    var paymentOptions = document.getElementById("payment_options");
    if (paymentOptions) {
        paymentOptions.addEventListener("change", function() {
            var selectedOption = this.value;
            if (selectedOption === "Online fizetés") {
                document.getElementById("redirectButton").style.display = "block";
            } else {
                document.getElementById("redirectButton").style.display = "none";
            }
        });
    }

    var redirectButton = document.getElementById("redirectButton");
    if (redirectButton) {
        redirectButton.addEventListener("click", function(event) {
            event.preventDefault();
            document.getElementById("modalPayContainer").style.display = "block";
            document.body.style.overflow = "hidden"; 
        });
    }

    var closeModal = document.getElementById("closeModal");
    if (closeModal) {
        closeModal.addEventListener("click", function() {
            document.getElementById("modalPayContainer").style.display = "none";
            document.body.style.overflow = "auto"; 
        });
    }

    var cardNumber = document.getElementById("cardNumber");
    if (cardNumber) {
        cardNumber.addEventListener("input", function() {
            var cardNumber = this.value.replace(/\D/g, '');
            var formattedCardNumber = '';
            for (var i = 0; i < cardNumber.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedCardNumber += '-';
                }
                formattedCardNumber += cardNumber[i];
            }
            this.value = formattedCardNumber;
        });
    }

    var expiryDate = document.getElementById("expiryDate");
    if (expiryDate) {
        expiryDate.addEventListener("input", function() {
            var expiryDate = this.value.replace(/\D/g, '');
            var formattedExpiryDate = '';
            for (var i = 0; i < expiryDate.length; i++) {
                if (i > 0 && i % 2 === 0) {
                    formattedExpiryDate += '/';
                }
                formattedExpiryDate += expiryDate[i];
            }
            this.value = formattedExpiryDate;
        });
    }

    var cardOwner = document.getElementById("cardOwner");
    if (cardOwner) {
        cardOwner.addEventListener("blur", function() {
            var cardOwnerValue = this.value.trim();
            if (cardOwnerValue === "") {
                document.getElementById("cardOwnerError").style.display = "block";
            } else {
                document.getElementById("cardOwnerError").style.display = "none";
            }
        });

        cardOwner.addEventListener("input", function() {
            var cardOwnerValue = this.value;
            if (!/^[a-zA-ZüÜöÖóÓőŐúÚéÉáÁíÍ\s]*$/.test(cardOwnerValue)) {
                document.getElementById("cardOwnerError").style.display = "block";
            } else {
                document.getElementById("cardOwnerError").style.display = "none";
            }
        });
    }

    var paymentForm = document.getElementById("paymentForm");
    if (paymentForm) {
        paymentForm.addEventListener("submit", function(event) {
            event.preventDefault();
            saveData();
            document.getElementById("modalPayContainer").style.display = "none";
        });
    }
});
