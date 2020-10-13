function minus(id) {
    if (
        isNaN(document.getElementById(id).value) ||
        document.getElementById(id).value == ""
    )
        document.getElementById(id).value = 1;
    else if (document.getElementById(id).value > 1)
        document.getElementById(id).value =
        parseInt(document.getElementById(id).value) - 1;
    goToCalPrice();
}

function plus(id) {
    if (
        isNaN(document.getElementById(id).value) ||
        document.getElementById(id).value == ""
    )
        document.getElementById(id).value = 1;
    else if (document.getElementById(id).value < 99)
        document.getElementById(id).value =
        parseInt(document.getElementById(id).value) + 1;
    goToCalPrice();
}