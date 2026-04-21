(function () {
    const pageData = window.DashboardPageData || { playlistOptions: [], devices: [] };
    const initialDevicesById = new Map();

    function normalizeDevice(device) {
        return {
            device_id: String(device.device_id),
            device_name: device.device_name || "",
            device_playlist: device.device_playlist || "",
            device_description: device.device_description || ""
        };
    }

    function createCell() {
        return document.createElement("div");
    }

    function createEditableInput(value, fieldName) {
        const input = document.createElement("input");
        input.type = "text";
        input.className = "row-input";
        input.value = value || "";
        input.dataset.deviceField = fieldName;
        return input;
    }

    function createPlaylistSelect(selectedValue) {
        const select = document.createElement("select");
        select.className = "selectplaylist";
        select.dataset.deviceField = "device_playlist";

        pageData.playlistOptions.forEach((optionValue) => {
            const option = document.createElement("option");
            option.value = optionValue;
            option.textContent = optionValue;
            option.selected = optionValue === selectedValue;
            select.appendChild(option);
        });

        return select;
    }

    function createStatusBadge(status) {
        const badge = document.createElement("p");
        const normalizedStatus = status === "online" ? "online" : "offline";

        badge.className = `status-badge ${normalizedStatus}`;
        badge.textContent = normalizedStatus === "online" ? "Online" : "Offline";
        return badge;
    }

    function createDeviceRow(device) {
        const row = document.createElement("div");
        row.className = "linha";
        row.dataset.deviceRow = "true";
        row.dataset.deviceId = String(device.device_id);

        const nameCell = createCell();
        nameCell.appendChild(createEditableInput(device.device_name, "device_name"));

        const statusCell = createCell();
        statusCell.appendChild(createStatusBadge(device.device_status));

        const playlistCell = createCell();
        playlistCell.className = "center";
        playlistCell.appendChild(createPlaylistSelect(device.device_playlist));

        const ipCell = createCell();
        ipCell.className = "center";
        ipCell.textContent = device.device_ip || "";

        const descriptionCell = createCell();
        descriptionCell.appendChild(createEditableInput(device.device_description, "device_description"));

        row.append(nameCell, statusCell, playlistCell, ipCell, descriptionCell);
        return row;
    }

    function getDashboardRows() {
        return Array.from(document.querySelectorAll("#dashboard-table-body [data-device-row='true']"));
    }

    function getRowDeviceData(row) {
        return {
            device_id: row.dataset.deviceId || "",
            device_name: row.querySelector("[data-device-field='device_name']")?.value || "",
            device_playlist: row.querySelector("[data-device-field='device_playlist']")?.value || "",
            device_description: row.querySelector("[data-device-field='device_description']")?.value || ""
        };
    }

    function getChangedDevices() {
        return getDashboardRows()
            .map((row) => getRowDeviceData(row))
            .filter((device) => {
                const original = initialDevicesById.get(device.device_id);

                if (!original) {
                    return false;
                }

                return (
                    original.device_name !== device.device_name ||
                    original.device_playlist !== device.device_playlist ||
                    original.device_description !== device.device_description
                );
            });
    }

    function updateDashboardCounters() {
        const rows = getDashboardRows();
        const onlineCount = rows.filter((row) => row.querySelector(".status-badge.online")).length;
        const offlineCount = rows.filter((row) => row.querySelector(".status-badge.offline")).length;

        document.getElementById("CountDispositivo").textContent = String(rows.length);
        document.getElementById("CountDispOnline").textContent = String(onlineCount);
        document.getElementById("CountDispOffline").textContent = String(offlineCount);
    }

    function updateSubmitButtonState() {
        const updateButton = document.getElementById("dashboardUpdateButton");
        const hasChanges = getChangedDevices().length > 0;

        if (!updateButton) {
            return;
        }

        updateButton.disabled = !hasChanges;
        updateButton.classList.toggle("pending-changes", hasChanges);
    }

    function renderDashboardRows() {
        const tableBody = document.getElementById("dashboard-table-body");

        if (!tableBody) {
            return;
        }

        tableBody.innerHTML = "";
        initialDevicesById.clear();

        pageData.devices.forEach((device) => {
            initialDevicesById.set(String(device.device_id), normalizeDevice(device));
            tableBody.appendChild(createDeviceRow(device));
        });

        updateDashboardCounters();
        updateSubmitButtonState();
    }

    function populateModalPlaylistOptions() {
        const select = document.getElementById("device_playlist");

        if (!select) {
            return;
        }

        select.innerHTML = "";

        const emptyOption = document.createElement("option");
        emptyOption.value = "";
        emptyOption.textContent = "Nenhuma";
        select.appendChild(emptyOption);

        pageData.playlistOptions.forEach((optionValue) => {
            const option = document.createElement("option");
            option.value = optionValue;
            option.textContent = optionValue;
            select.appendChild(option);
        });
    }

    function openModal(modal) {
        if (modal) {
            modal.style.display = "block";
        }
    }

    function closeModal(modal) {
        if (modal) {
            modal.style.display = "none";
        }
    }

    function bindEditableTable() {
        const tableBody = document.getElementById("dashboard-table-body");

        if (!tableBody) {
            return;
        }

        const handleChange = (event) => {
            if (!event.target.matches("[data-device-field]")) {
                return;
            }

            updateSubmitButtonState();
        };

        tableBody.addEventListener("input", handleChange);
        tableBody.addEventListener("change", handleChange);
    }

    function bindDashboardButtons() {
        const modal = document.getElementById("AddDispositivo");
        const newDeviceButton = document.getElementById("newdisp");
        const cancelButton = document.getElementById("cancelPlaylist");
        const newPlaylistButton = document.getElementById("newplaylist");

        newDeviceButton?.addEventListener("click", () => openModal(modal));
        cancelButton?.addEventListener("click", () => {
            closeModal(modal);
            document.getElementById("addDispForm")?.reset();
        });
        newPlaylistButton?.addEventListener("click", () => {
            window.location.href = "playlists";
        });
    }

    window.prepareDashboardUpdateSubmission = function prepareDashboardUpdateSubmission({ payload }) {
        payload.changed_devices = getChangedDevices();
        return payload;
    };

    document.addEventListener("DOMContentLoaded", () => {
        if (document.body?.dataset?.page !== "dashboard") {
            return;
        }

        renderDashboardRows();
        populateModalPlaylistOptions();
        bindEditableTable();
        bindDashboardButtons();
    });
})();
