function enlarge(id) {
    document.getElementById("myModal").style.display = "block";
    document.getElementById("img01").src = document.getElementById(id).src;
    document.getElementById("caption").innerHTML = document.getElementById(
        id
    ).alt;
}