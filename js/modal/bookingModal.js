
// Modal ablak bezárása
var closeButton = document.querySelector('.modal-header .btn-close');
closeButton.addEventListener('click', function () {
    var modal = document.getElementById("exampleModal");
    modal.style.display = "none"; 
});
