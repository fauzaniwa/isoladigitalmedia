let umur = 10

function halo() {
    if (umur < 17) {
    console.log("Sia teh leutik keneh")
    }
    else {
    console.log("ajig ges gede euyy")
    }
}

halo()

function tampilkanmakananfavorit() {
    let makananfavorit = document.getElementById("makananfavorit").value;
    document.getElementById("hasil").innerText = "Makanan Favoritmu adalah " + makananfavorit;
}