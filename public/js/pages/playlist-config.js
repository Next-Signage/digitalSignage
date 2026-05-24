(function () {
  const pageData = window.PlaylistConfigPageData || {
    id_playlist:null,
    playlist_name: "",
    associatedDevices: [],
    mediaItems: [],
    updated_at:"",
    duration:0
  };
  const DEFAULT_MEDIA_DESCRIPTION = "Sem descrição...";
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

  function getVideoDuration(file) {
    return new Promise((resolve) => {
      if (!file.type.startsWith("video/")) {
        resolve("00:00:05");
        return;
      }
      const video = document.createElement("video");
      video.preload = "metadata";
      video.onloadedmetadata = () => {
        const totalSeconds = Math.round(video.duration);
        const h = Math.floor(totalSeconds / 3600);
        const m = Math.floor((totalSeconds % 3600) / 60);
        const s = totalSeconds % 60;
        const formatted = String(h).padStart(2, "0") + ":" + String(m).padStart(2, "0") + ":" + String(s).padStart(2, "0");
        URL.revokeObjectURL(video.src);
        resolve(formatted);
      };
      video.onerror = () => {
        URL.revokeObjectURL(video.src);
        resolve("00:00:05");
      };
      video.src = URL.createObjectURL(file);
    });
  }

  function durationToSeconds(duration) {
    if (!duration) return 5;
    const parts = duration.split(":").map(Number);
    if (parts.length === 3) {
      return parts[0] * 3600 + parts[1] * 60 + parts[2];
    }
    if (parts.length === 2) {
      return parts[0] * 60 + parts[1];
    }
    return 5;
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
      id: media.id || media.id_media || media.media_token||null,
      media_name: media.media_name || "",
      media_description: media.media_description || DEFAULT_MEDIA_DESCRIPTION,
      duration: media.duration || "00:00:00",
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
      <div><input class="row-input" type="text" name="media_description[]" maxlength="80" placeholder="Insira descrição..."></div>
      <div class="center" name="media_added_at[]"></div>
      <div class="center duration-cell">
        <input
          type="time"
          step="1"
          name="media_duration[]"
        >
      </div>
      <div class="end media-actions-cell">
        <input type="hidden" name="media_origin[]">
        <input type="hidden" name="media_token[]">
        <input type="hidden" name="media_source_name[]">
        <button type="button" class="icon-button" aria-label="Remover mídia">
          <i class="fa-solid fa-trash"></i>
        </button>
        <button type="button" class="icon-button drag-handle" aria-label="Mover mídia">
          <i class="fa-solid fa-arrows-up-down"></i>
        </button>
      </div>
    `;

    row.querySelector("input[name='media_name[]']").value = media.media_name || "";
    row.querySelector("input[name='media_description[]']").value = media.media_description || DEFAULT_MEDIA_DESCRIPTION;
    row.querySelector("div[name='media_added_at[]']").textContent = media.updated_at || getCurrentDateLabel();
    row.querySelector("input[name='media_duration[]']").value = media.duration || "00:00:00";
    row.querySelector("input[name='media_origin[]']").value = media.media_origin || "existing";
    row.querySelector("input[name='media_token[]']").value = media.media_token || "";
    row.querySelector("input[name='media_source_name[]']").value = media.media_source_name || "";

    row.querySelector("button[aria-label='Remover mídia']").addEventListener("click", async () => {
      if (media.media_origin === "existing" && media.media_token) {
        try {
          const response = await fetch(`deletecontent`, {
            method: 'POST',
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
        } catch (error) {
          console.error(error);
          alert('Erro ao tentar remover a mídia. Tente novamente.');
          return;
        }
      }

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
        <div><input type="checkbox" id="btnSalvarAssociacao" name="associated_devices[]" value=""></div>`;

      row.querySelector("p").textContent = deviceName.name;
      row.querySelector("input").value = deviceName.id;

      container.appendChild(row);
    });
  }

  function bindSubmitAssociation() {
    const submitButton = document.getElementById("confirmAssociate");

    if (submitButton) {
      submitButton.addEventListener("click", (event) => {
        event.preventDefault();
        sendAssociatedDevices();
      });
    }
  }

  async function sendAssociatedDevices() {
    const selectedCheckboxes = document.querySelectorAll('input[name="associated_devices[]"]:checked');
    const selectedIds = Array.from(selectedCheckboxes).map(cb => cb.value);

    const payload = {
      id_playlist: pageData.id_playlist,
      device_ids: selectedIds
    };

    try {
      const response = await fetch('associate', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(payload)
      });

      const textResponse = await response.text();

      if (!response.ok) {
        console.error("Erro HTTP do servidor:", response.status);
        console.error("Corpo da resposta do erro:", textResponse);
        throw new Error(`Erro no servidor: ${response.status}`);
      }

      try {
        const result = JSON.parse(textResponse);
        console.log("Sucesso:", result);
        console.log("Associação realizada com sucesso!");
      } catch (parseError) {
        console.error("O servidor NÃO retornou um JSON válido. Veja o que ele retornou:");
        console.error(textResponse);
        console.log("Erro: O servidor retornou um formato inválido. Verifique o console.");
      }

    } catch (error) {
      console.error("Erro ao tentar fazer a requisição:", error);
    }
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
    fileInput.addEventListener("change", async () => {
      for (const file of Array.from(fileInput.files || [])) {
        const token = createToken("media");
        const duration = await getVideoDuration(file);

        uploadedMediaState.push({ token, file, duration });
        mediaBody.appendChild(createMediaRow({
          media_name: file.name,
          media_description: DEFAULT_MEDIA_DESCRIPTION,
          updated_at: getCurrentDateLabel(),
          duration: duration,
          media_origin: "new",
          media_token: token,
          media_source_name: file.name
        }));
      }

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
    const orderedItems = mediaRows
      .filter((row) => row.dataset.mediaOrigin === "new")
      .map((row) => {
        const stateItem = uploadedMediaState.find((item) => item.token === row.dataset.mediaToken);
        const durationInput = row.querySelector("input[name='media_duration[]']");
        return {
          file: stateItem?.file,
          duration: durationInput?.value || stateItem?.duration || "00:00:05"
        };
      })
      .filter((item) => item.file);

    const base64Files = await window.ViewForms.filesToBase64(orderedItems);

    payload.media_files = base64Files.map((file, index) => ({
      ...file,
      media_duration: durationToSeconds(orderedItems[index].duration)
    }));

    payload.media_count = mediaRows.length;
    payload.id_playlist = pageData.id_playlist;
    payload.updated_at = pageData.updated_at;
    payload.duration = pageData.duration;

    return payload;
  };

  function bindDragAndDrop() {
    const mediaBody = document.querySelector("[data-media-body]");
    if (!mediaBody) return;

    let dragSourceRow = null;

    mediaBody.addEventListener("mousedown", (e) => {
      const handle = e.target.closest(".drag-handle");
      if (!handle) return;
      const row = handle.closest("[data-media-row='true']");
      if (row) row.draggable = true;
    });

    mediaBody.addEventListener("mouseup", () => {
      mediaBody.querySelectorAll("[data-media-row='true']").forEach((row) => {
      row.draggable = false;
      });
    });

    mediaBody.addEventListener("dragstart", (e) => {
      const row = e.target.closest("[data-media-row='true']");
      if (!row) {
      e.preventDefault();
      return;
      }
      dragSourceRow = row;
      row.classList.add("dragging");
      e.dataTransfer.effectAllowed = "move";
      e.dataTransfer.setData("text/plain", "");
    });

    mediaBody.addEventListener("dragend", (e) => {
      const row = e.target.closest("[data-media-row='true']");
      if (row) {
      row.classList.remove("dragging");
      row.draggable = false;
      }
      dragSourceRow = null;
      document.querySelectorAll(".drag-over").forEach((el) => el.classList.remove("drag-over"));
    });

    mediaBody.addEventListener("dragover", (e) => {
      e.preventDefault();
      e.dataTransfer.dropEffect = "move";

      const targetRow = e.target.closest("[data-media-row='true']");
      if (!targetRow || targetRow === dragSourceRow) return;

      document.querySelectorAll(".drag-over").forEach((el) => el.classList.remove("drag-over"));
      targetRow.classList.add("drag-over");
    });

    mediaBody.addEventListener("dragleave", (e) => {
      const targetRow = e.target.closest("[data-media-row='true']");
      if (targetRow && !targetRow.contains(e.relatedTarget)) {
      targetRow.classList.remove("drag-over");
      }
    });

    mediaBody.addEventListener("drop", (e) => {
      e.preventDefault();
      const targetRow = e.target.closest("[data-media-row='true']");
      if (!targetRow || !dragSourceRow || targetRow === dragSourceRow) return;

      targetRow.classList.remove("drag-over");

      const rows = Array.from(mediaBody.querySelectorAll("[data-media-row='true']"));
      const sourceIndex = rows.indexOf(dragSourceRow);
      const targetIndex = rows.indexOf(targetRow);

      if (sourceIndex < targetIndex) {
      mediaBody.insertBefore(dragSourceRow, targetRow.nextSibling);
      } else {
      mediaBody.insertBefore(dragSourceRow, targetRow);
      }

      updatePlaylistSubmitButtonState();
    });
  }

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
    bindDragAndDrop();
    bindSubmitAssociation();
  });
})();
