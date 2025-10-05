// DASHBOARD.PHP
function dashboard() {
    document.getElementById("newdisp").addEventListener("click", ()=>{
        document.getElementById("AddDispositivo").style.display = "block";
    })

    document.getElementById("cancelPlaylist").addEventListener("click", ()=>{
        document.getElementById("AddDispositivo").style.display = "none";
        document.getElementById("AddDispositivo").querySelector("form").reset()
    })

    document.getElementById("createPlaylist").addEventListener("click", ()=>{
        // alguma coisa
    })
}

//PLAYLISTCONFIG.JS
function playlistconfig() {
    document.getElementById("associarPlaylist").addEventListener("click", () => {
        document.getElementById("associarPlaylistMSG").style.display = "block";
    });

    document.getElementById("cancelAssociate").addEventListener("click", ()=>{
        document.getElementById("associarPlaylistMSG").style.display = "none";
    })

    document.getElementById("addfile").addEventListener("click", ()=>{
        document.getElementById("sendfile").click();
    })
}