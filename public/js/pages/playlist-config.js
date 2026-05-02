(function () {
    const pageData = window.PlaylistConfigPageData || {
        id_playlist:null,
        playlist_name: "",
        associatedDevices: [],
        mediaItems: [],
        updated_at:"",
        duration:0
    };
    let initialPlaylistState = null;
    let uploadedMediaState = [];

    function getCurrentDateLabel() {
        const date = new Date();
        const day = String(date.getDate()).padStart(2, "0");
        const month = String(date.getMonth() + 1).padStart(2, "0");
        const year = date.getFullYear();

        return `${day}/${month}/${year}`;
    }

    function createToken(prefix) {
        return `${prefix}-${Date.now()}-${Math.random().toString(16).slice(2, 10)}`;
    }

    function toggleEmptyMediaState() {
        const emptyState = document.getElementById("nomidia");
        const rows = document.querySelectorAll("[data-media-body] [data-media-row='true']");

        if (emptyState) {
            emptyState.style.display = rows.length === 0 ? "flex" : "none";
        }
    }

    function normalizeMediaItem(media) {
        console.log(media.media_token);
        

        return {
            id: media.id || media.id_media || media.media_token||null, // Certifique-se de pegar o ID do PHP aqui
            media_name: media.media_name || "",
            media_description: media.media_description || "",
            // Corrigido para ler "duration" do PHP
            duration: media.duration || "00:00", 
            // Corrigido para ler "updated_at" do PHP
            updated_at: media.updated_at || "", 
            media_origin: media.media_origin || "existing",
            media_token: media.media_token || "",
            media_source_name: media.media_source_name || ""
        };
    }

    function getCurrentPlaylistState() {
        const mediaRows = Array.from(document.querySelectorAll("[data-media-body] [data-media-row='true']"));

        return {
            playlist_name: document.getElementById("title")?.value || "",
            mediaItems: mediaRows.map((row) => ({
                media_name: row.querySelector("input[name='media_name[]']")?.value || "",
                media_description: row.querySelector("input[name='media_description[]']")?.value || "",
                duration: row.querySelector("input[name='media_duration[]']")?.value || "",
                media_origin: row.querySelector("input[name='media_origin[]']")?.value || "",
                media_token: row.querySelector("input[name='media_token[]']")?.value || "",
                media_source_name: row.querySelector("input[name='media_source_name[]']")?.value || ""
            }))
        };
    }

    function updatePlaylistSubmitButtonState() {
        const updateButton = document.getElementById("updatePlaylist");

        if (!updateButton || !initialPlaylistState) {
            return;
        }

        const hasChanges = JSON.stringify(getCurrentPlaylistState()) !== JSON.stringify(initialPlaylistState);

        updateButton.disabled = !hasChanges;
        updateButton.classList.toggle("pending-changes", hasChanges);
    }

    function createMediaRow(media) {
        const row = document.createElement("div");
        row.className = "linha media-row";
        row.dataset.mediaRow = "true";
        row.dataset.mediaOrigin = media.media_origin || "existing";
        row.dataset.mediaToken = media.media_token || "";

        row.innerHTML = `
          <div><input class="row-input" type="text" name="media_name[]" maxlength="50" required></div>
          <div><input class="row-input" type="text" name="media_description[]" maxlength="80"></div>
          <!-- O name aqui foi mantido, mas a injeção de dados mudou abaixo -->
          <div class="center" name="media_added_at[]"></div>
          <div class="center">
            <input
              class="row-input"
              type="text"
              name="media_duration[]"
              placeholder="00:00"
              maxlength="5"
              pattern="^[0-9]{1,2}:[0-9]{2}$"
              title="Use o formato mm:ss (ex: 0:03)"
              style="width: 40px"
            >
          </div>
          <div class="end">
            <input type="hidden" name="media_origin[]">
            <input type="hidden" name="media_token[]">
            <input type="hidden" name="media_source_name[]">
            <button type="button" class="icon-button" aria-label="Remover mídia">
              <i class="fa-solid fa-trash"></i>
            </button>
          </div>
        `;

        row.querySelector("input[name='media_name[]']").value = media.media_name || "";
        row.querySelector("input[name='media_description[]']").value = media.media_description || "";
        
        // CORREÇÃO 1: DIV usa textContent, não value. E mapeia para o media.updated_at do PHP
        row.querySelector("div[name='media_added_at[]']").textContent = media.updated_at || getCurrentDateLabel();
        
        // CORREÇÃO 2: Mapeia a duração para o media.duration do PHP
        row.querySelector("input[name='media_duration[]']").value = media.duration || "00:00";
        
        row.querySelector("input[name='media_origin[]']").value = media.media_origin || "existing";
        row.querySelector("input[name='media_token[]']").value = media.media_token || "";
        row.querySelector("input[name='media_source_name[]']").value = media.media_source_name || "";
        
        row.querySelector("button").addEventListener("click", async () => {
        // Verifica se a mídia já existe no banco de dados e se possui um ID
        // (Ajuste "media.id" para o nome exato da propriedade de ID que vem do seu PHP)
        if (media.media_origin === "existing" && media.media_token) {
            try {
                // Exemplo de requisição DELETE via Fetch API
                // Substitua '/sua-rota-de-delete' pela URL correta da sua API
                const response = await fetch(`deletecontent`, {
                    method: 'POST', // ou 'POST' dependendo de como sua API foi construída
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ 
                    id: media.media_token 
                })
                });

                if (!response.ok) {
                    throw new Error('Falha ao deletar a mídia no servidor.');
                }
                // Se chegou aqui, deletou com sucesso no backend
            } catch (error) {
                console.error(error);
                alert('Erro ao tentar remover a mídia. Tente novamente.');
                return; // Interrompe a execução para não remover da tela se a requisição falhar
            }
        }

        // Comportamento padrão: remove a mídia do estado local e da tela
        uploadedMediaState = uploadedMediaState.filter((item) => item.token !== row.dataset.mediaToken);
        row.remove();
        toggleEmptyMediaState();
        updatePlaylistSubmitButtonState();
    });

        return row;
    }

    function renderExistingMedia() {
        const mediaBody = document.querySelector("[data-media-body]");

        if (!mediaBody) {
            return;
        }

        mediaBody.innerHTML = "";
        pageData.mediaItems.forEach((media) => {
            mediaBody.appendChild(createMediaRow(media));
        });
        toggleEmptyMediaState();
    }

    function renderAssociationDevices() {
        const container = document.getElementById("associated-devices-body");

        if (!container) {
            return;
        }

        container.innerHTML = "";
        pageData.associatedDevices.forEach((deviceName) => {
            const row = document.createElement("div");
            row.className = "linha2";
            row.innerHTML = `
              <div><p></p></div>
              <div><input type="checkbox" name="associated_devices[]" value=""></div>
            `;

            row.querySelector("p").textContent = deviceName;
            row.querySelector("input").value = deviceName;
            container.appendChild(row);
        });
    }

    function bindSelectAllDevices() {
        const selectAll = document.querySelector("[data-select-all-devices]");

        selectAll?.addEventListener("change", () => {
            document
                .querySelectorAll("#associarPlaylistForm input[name='associated_devices[]']")
                .forEach((checkbox) => {
                    checkbox.checked = selectAll.checked;
                });
        });
    }

    function bindMediaUpload() {
        const addFileButton = document.getElementById("addfile");
        const fileInput = document.getElementById("sendfile");
        const mediaBody = document.querySelector("[data-media-body]");

        if (!addFileButton || !fileInput || !mediaBody) {
            return;
        }

        addFileButton.addEventListener("click", () => fileInput.click());
        fileInput.addEventListener("change", () => {
            Array.from(fileInput.files || []).forEach((file) => {
                const token = createToken("media");

                uploadedMediaState.push({ token, file });
                mediaBody.appendChild(createMediaRow({
                    media_name: file.name,
                    media_description: "",
                    updated_at: getCurrentDateLabel(), // Corrigido para updated_at
                    duration: "00:00",                 // Corrigido para duration
                    media_origin: "new",
                    media_token: token,
                    media_source_name: file.name
                }));
            });

            fileInput.value = "";
            toggleEmptyMediaState();
            updatePlaylistSubmitButtonState();
        });
    }

    function bindPlaylistStateTracking() {
        const titleInput = document.getElementById("title");
        const mediaBody = document.querySelector("[data-media-body]");
        const handleStateChange = (event) => {
            if (
                event.target === titleInput ||
                event.target.closest?.("[data-media-row='true']")
            ) {
                updatePlaylistSubmitButtonState();
            }
        };

        titleInput?.addEventListener("input", handleStateChange);
        titleInput?.addEventListener("change", handleStateChange);
        mediaBody?.addEventListener("input", handleStateChange);
        mediaBody?.addEventListener("change", handleStateChange);
    }

    function captureInitialPlaylistState() {
        initialPlaylistState = {
            playlist_name: pageData.playlist_name || "",
            mediaItems: (pageData.mediaItems || []).map(normalizeMediaItem)
        };
        updatePlaylistSubmitButtonState();
    }

    function bindAssociationModal() {
        const modal = document.getElementById("associarPlaylistMSG");
        const openButton = document.getElementById("associarPlaylist");
        const cancelButton = document.getElementById("cancelAssociate");

        openButton?.addEventListener("click", () => {
            modal.style.display = "block";
        });

        cancelButton?.addEventListener("click", () => {
            modal.style.display = "none";
        });
    }

    window.preparePlaylistConfigSubmission = async function preparePlaylistConfigSubmission({ payload }) {
        const mediaRows = Array.from(document.querySelectorAll("[data-media-body] [data-media-row='true']"));
        const orderedFiles = mediaRows
            .filter((row) => row.dataset.mediaOrigin === "new")
            .map((row) => uploadedMediaState.find((item) => item.token === row.dataset.mediaToken)?.file)
            .filter(Boolean);

        payload.media_files = await window.ViewForms.filesToBase64(orderedFiles);
        payload.media_count = mediaRows.length;
        payload.id_playlist = pageData.id_playlist;
        payload.updated_at = pageData.updated_at;
        payload.duration = pageData.duration;

        return payload;
    };

    document.addEventListener("DOMContentLoaded", () => {
        if (document.body?.dataset?.page !== "playlistconfig") {
            return;
        }

        const titleInput = document.getElementById("title");

        if (titleInput) {
            titleInput.value = pageData.playlist_name || "";
        }

        renderExistingMedia();
        captureInitialPlaylistState();
        renderAssociationDevices();
        bindSelectAllDevices();
        bindMediaUpload();
        bindAssociationModal();
        bindPlaylistStateTracking();
    });
})();