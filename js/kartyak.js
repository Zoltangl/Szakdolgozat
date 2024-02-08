// kartyak.js

// Belépés linkre kattintva megjeleníti a Bejelentkezés kártyát és elrejti a Regisztrációs kártyát
document.getElementById("showLoginForm").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("form").style.display = "none";
    document.getElementById("loginForm").style.display = "block";
});
