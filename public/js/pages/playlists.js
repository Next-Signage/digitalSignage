(function () {
    const pageData = window.PlaylistsPageData || { playlists: [] };

    function getPlaylistConfigPath() {
        return "playlistConfig";
    }

    function createCell() {
        return document.createElement("div");
    }

    function createParagraph(value) {
        const paragrafo = document.createElement("p");
        paragrafo.className = "row-input";
        paragrafo.textContent = value || "";
        return paragrafo;
    }
//passando o ID como parametro
    function createDeleteForm(playlistId,playlistName) {
        const form = document.createElement("form");
        form.className = "inline-icon-form";
        form.method = "POST";
        form.action = "deleteplaylist";
        form.dataset.endpoint = "deleteplaylist";
        form.dataset.reloadAfterSubmit = "true";
        form.dataset.playlistDelete = "true";
        form.id = "deletePlaylist"
        form.dataset.playlistName = playlistName;
        //passando o ID para manipulação
        const hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "playlist_id";
        hiddenInput.value = playlistId;

        const submitButton = document.createElement("button");
        submitButton.type = "submit";
        submitButton.className = "icon-button";
        submitButton.setAttribute("aria-label", "Excluir playlist");
        submitButton.innerHTML = '<i class="fa-solid fa-trash"></i>';

        form.append(hiddenInput, submitButton);
        return form;
    }

    function createPlaylistRow(playlist) {
        const row = document.createElement("div");
        row.className = "linha";
        // Guardamos o ID no dataset da linha para qualquer necessidade futura
        row.dataset.playlistId = playlist.playlist_id; 

        const nameCell = createCell();
        nameCell.appendChild(createParagraph(playlist.playlist_name));

        const descriptionCell = createCell();
        descriptionCell.appendChild(createParagraph(playlist.playlist_description));

        const actionsCell = createCell();
        actionsCell.className = "end playlist-actions";

        // BOTÃO EDITAR: Agora guarda o ID para a URL
        const editButton = document.createElement("button");
        editButton.type = "button";
        editButton.className = "icon-button";
        editButton.dataset.playlistEdit = "true";
        editButton.dataset.playlistId = playlist.playlist_id; // <-- CRUCIAL
        editButton.innerHTML = '<i class="fa-solid fa-gear"></i>';

        // FORM EXCLUIR: Passamos ID e Nome
        const deleteForm = createDeleteForm(playlist.playlist_id, playlist.playlist_name);

        actionsCell.append(editButton, deleteForm);
        row.append(nameCell, descriptionCell, actionsCell);
        return row;
    }

    function bindEditButtons(scope) {
        scope.querySelectorAll("[data-playlist-edit]").forEach((button) => {
            if (button.dataset.bound === "true") return;

            button.dataset.bound = "true";
            button.addEventListener("click", () => {
                // Buscamos o ID que salvamos no dataset
                const playlistId = button.dataset.playlistId; 
                window.location.href = `playlistConfig?id=${playlistId}`;
            });
        });
    }   

    function bindDeletePrompts(scope) {
        scope.querySelectorAll("form[data-playlist-delete='true']").forEach((form) => {
            if (form.dataset.promptBound === "true") {
                return;
            }

            form.dataset.promptBound = "true";
            form.addEventListener("submit", (event) => {
                const playlistName = form.dataset.playlistName || "";
                const promptValue = window.prompt(
                    `Digite EXCLUIR para remover a playlist "${playlistName}".`,
                    ""
                );

                if (promptValue !== "EXCLUIR") {
                    event.preventDefault();
                }
            }, true);
        });
    }

    function renderPlaylists() {
        const tableBody = document.getElementById("playlists-table-body");

        if (!tableBody) {
            return;
        }

        tableBody.innerHTML = "";
        pageData.playlists.forEach((playlist) => {
            tableBody.appendChild(createPlaylistRow(playlist));
        });

        window.ViewForms?.registerMockForms(tableBody);
        bindEditButtons(tableBody);
        bindDeletePrompts(tableBody);
    }

    function createInlinePlaylistForm() {
        const form = document.createElement("form");
        form.className = "linha playlist-inline-form";
        form.id = "addPlaylistForm";
        form.method = "POST";
        form.action = "createplaylist";
        form.dataset.endpoint = "createplaylist";
        form.dataset.reloadAfterSubmit = "true";

        const nameCell = createCell();
        const nameInput = document.createElement("input");
        nameInput.type = "text";
        nameInput.name = "playlist_name";
        nameInput.className = "row-input";
        nameInput.placeholder = "Nome da playlist";
        nameInput.maxLength = 40;
        nameInput.required = true;
        nameCell.appendChild(nameInput);

        const descriptionCell = createCell();
        const descriptionInput = document.createElement("input");
        descriptionInput.type = "text";
        descriptionInput.name = "playlist_description";
        descriptionInput.className = "row-input";
        descriptionInput.placeholder = "Descrição da playlist";
        descriptionInput.maxLength = 80;
        descriptionInput.required = true;
        descriptionCell.appendChild(descriptionInput);

        const actionsCell = createCell();
        actionsCell.className = "end playlist-actions";

        const submitButton = document.createElement("button");
        submitButton.type = "submit";
        submitButton.className = "icon-button success-icon";
        submitButton.setAttribute("aria-label", "Salvar playlist");
        submitButton.innerHTML = '<i class="fa-solid fa-check"></i>';

        const cancelButton = document.createElement("button");
        cancelButton.type = "button";
        cancelButton.className = "icon-button cancel-icon";
        cancelButton.setAttribute("aria-label", "Cancelar criação");
        cancelButton.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        cancelButton.addEventListener("click", () => form.remove());

        actionsCell.append(submitButton, cancelButton);
        form.append(nameCell, descriptionCell, actionsCell);
        return form;
    }

    function bindNewPlaylistButton() {
        const newPlaylistButton = document.getElementById("newplaylist");

        newPlaylistButton?.addEventListener("click", () => {
            const tableBody = document.getElementById("playlists-table-body");
            const existingInlineForm = tableBody?.querySelector(".playlist-inline-form");

            if (!tableBody) {
                return;
            }

            if (existingInlineForm) {
                existingInlineForm.querySelector("input[name='playlist_name']")?.focus();
                return;
            }

            const form = createInlinePlaylistForm();
            tableBody.appendChild(form);
            window.ViewForms?.registerMockForms(form);
            form.querySelector("input[name='playlist_name']")?.focus();
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (document.body?.dataset?.page !== "playlists") {
            return;
        }

        renderPlaylists();
        bindNewPlaylistButton();
    });
})();
