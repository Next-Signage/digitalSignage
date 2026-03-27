(function () {
    const pageData = window.PlaylistCreatePageData || { associatedDevices: [] };
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

    function createMediaRow(media) {
        const row = document.createElement("div");
        row.className = "linha media-row";
        row.dataset.mediaRow = "true";
        row.dataset.mediaOrigin = media.media_origin || "new";
        row.dataset.mediaToken = media.media_token || "";

        row.innerHTML = `
          <div><input class="row-input" type="text" name="media_name[]" maxlength="50" required></div>
          <div><input class="row-input" type="text" name="media_description[]" maxlength="80"></div>
          <div class="center"><input class="row-input" type="text" name="media_added_at[]" readonly></div>
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
        row.querySelector("input[name='media_added_at[]']").value = media.media_added_at || getCurrentDateLabel();
        row.querySelector("input[name='media_duration[]']").value = media.media_duration || "00:00";
        row.querySelector("input[name='media_origin[]']").value = media.media_origin || "new";
        row.querySelector("input[name='media_token[]']").value = media.media_token || "";
        row.querySelector("input[name='media_source_name[]']").value = media.media_source_name || "";
        row.querySelector("button").addEventListener("click", () => {
            uploadedMediaState = uploadedMediaState.filter((item) => item.token !== row.dataset.mediaToken);
            row.remove();
            toggleEmptyMediaState();
        });

        return row;
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
                    media_added_at: getCurrentDateLabel(),
                    media_duration: "00:00",
                    media_origin: "new",
                    media_token: token,
                    media_source_name: file.name
                }));
            });

            fileInput.value = "";
            toggleEmptyMediaState();
        });
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

    window.preparePlaylistCreateSubmission = async function preparePlaylistCreateSubmission({ payload }) {
        const mediaRows = Array.from(document.querySelectorAll("[data-media-body] [data-media-row='true']"));
        const orderedFiles = mediaRows
            .filter((row) => row.dataset.mediaOrigin === "new")
            .map((row) => uploadedMediaState.find((item) => item.token === row.dataset.mediaToken)?.file)
            .filter(Boolean);

        payload.media_files = await window.ViewForms.filesToBase64(orderedFiles);
        payload.media_count = mediaRows.length;
        return payload;
    };

    document.addEventListener("DOMContentLoaded", () => {
        if (document.body?.dataset?.page !== "playlistcreate") {
            return;
        }

        renderAssociationDevices();
        bindSelectAllDevices();
        bindMediaUpload();
        bindAssociationModal();
        toggleEmptyMediaState();
    });
})();
