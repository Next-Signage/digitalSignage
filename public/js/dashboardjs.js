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

    document.getElementById("title").addEventListener("input", ()=>{
        let text = document.getElementById("title").value;
        
        if (30 >= text.length >= 3) {
            // ENVIAR PARA O BACKEND VIA WEBSOCKET

            // LEMBRAR DE: FILTRAR O TAMANHO DA PALAVRA (3 até 30), PROTEJER CONTRA SQL INJECTION
        }
    })
}