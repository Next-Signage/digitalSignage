function normalizeName(name) {
	return name.endsWith("[]") ? name.slice(0, -2) : name;
}

function assignValue(payload, name, value, forceArray) {
	const key = normalizeName(name);

	if (forceArray) {
		if (!Array.isArray(payload[key])) {
			payload[key] = [];
		}

		if (Array.isArray(value)) {
			payload[key].push(...value);
		} else if (typeof value !== "undefined") {
			payload[key].push(value);
		}

		return;
	}

	if (Object.prototype.hasOwnProperty.call(payload, key)) {
		if (!Array.isArray(payload[key])) {
			payload[key] = [payload[key]];
		}

		payload[key].push(value);
		return;
	}

	payload[key] = value;
}

function readFileAsDataUrl(file) {
	return new Promise((resolve, reject) => {
		const reader = new FileReader();

		reader.onload = () => {
			resolve({
				name: file.name,
				type: file.type,
				size: file.size,
				base64: reader.result,
			});
		};

		reader.onerror = () => reject(reader.error);
		reader.readAsDataURL(file);
	});
}

async function filesToBase64(source) {
	const files = Array.from(source?.files || source || []);

	if (files.length === 0) {
		return [];
	}

	return Promise.all(files.map(readFileAsDataUrl));
}

function collectForms(root) {
	const forms = [];
	const canQuery = typeof root?.querySelectorAll === "function";

	if (root?.matches?.("form[data-endpoint]")) {
		forms.push(root);
	}

	if (canQuery) {
		forms.push(...root.querySelectorAll("form[data-endpoint]"));
	}

	return forms;
}

async function serializeFormToJson(form) {
	const payload = {};
	const elements = Array.from(form.elements || []);
	const checkboxCounts = new Map();

	elements.forEach((element) => {
		const type = (element.type || "").toLowerCase();

		if (type !== "checkbox" || !element.name) {
			return;
		}

		checkboxCounts.set(
			element.name,
			(checkboxCounts.get(element.name) || 0) + 1,
		);
	});

	for (const element of elements) {
		const type = (element.type || "").toLowerCase();
		const tagName = (element.tagName || "").toLowerCase();
		const name = element.name;

		if (!name || element.disabled) {
			continue;
		}

		if (["submit", "button", "reset", "image"].includes(type)) {
			continue;
		}

		if (type === "radio") {
			if (element.checked) {
				assignValue(payload, name, element.value, false);
			} else if (
				!Object.prototype.hasOwnProperty.call(payload, normalizeName(name))
			) {
				payload[normalizeName(name)] = "";
			}
			continue;
		}

		if (type === "checkbox") {
			const isArrayField =
				name.endsWith("[]") || (checkboxCounts.get(name) || 0) > 1;

			if (isArrayField) {
				if (
					!Object.prototype.hasOwnProperty.call(payload, normalizeName(name))
				) {
					payload[normalizeName(name)] = [];
				}

				if (element.checked) {
					assignValue(payload, name, element.value || true, true);
				}
			} else {
				assignValue(payload, name, element.checked, false);
			}

			continue;
		}

		if (type === "file") {
			assignValue(
				payload,
				name,
				await filesToBase64(element),
				name.endsWith("[]"),
			);
			continue;
		}

		if (tagName === "select" && element.multiple) {
			assignValue(
				payload,
				name,
				Array.from(element.selectedOptions).map((option) => option.value),
				name.endsWith("[]"),
			);
			continue;
		}

		assignValue(payload, name, element.value, name.endsWith("[]"));
	}

	payload._meta = {
		endpoint:
			form.dataset.endpoint ||
			form.getAttribute("action") ||
			window.location.href,
		formId: form.id || null,
		submittedAt: new Date().toISOString(),
	};

	return payload;
}

async function submitMockJson(form, payloadOverride) {
	const endpoint =
		form.dataset.endpoint ||
		form.getAttribute("action") ||
		window.location.href;
	const payload = payloadOverride || (await serializeFormToJson(form));
	let responseDetails;

	console.groupCollapsed(`[mock-form] ${form.id || "form"} -> ${endpoint}`);
	console.log(payload);
	console.groupEnd();

	try {
		const response = await fetch(endpoint, {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-Mock-Request": "true",
			},
			body: JSON.stringify(payload),
		});

		responseDetails = {
			ok: response.ok,
			status: response.status,
			statusText: response.statusText,
			body: await response.text(),
		};
	} catch (error) {
		responseDetails = {
			ok: false,
			status: 0,
			statusText: "NETWORK_ERROR",
			body: "",
			error: error.message,
		};
	}

	return {
		endpoint,
		payload,
		response: responseDetails,
	};
}

function createFeedbackElement(form) {
	const element = document.createElement("p");
	element.className = "mock-form-feedback";
	element.dataset.formFeedback = "true";
	form.appendChild(element);
	return element;
}

function setFormFeedback(form, message, isError) {
	const feedback =
		form.querySelector("[data-form-feedback]") || createFeedbackElement(form);

	feedback.textContent = message;
	feedback.classList.toggle("error", Boolean(isError));
}

function clearFormFeedback(form) {
	const feedback = form.querySelector("[data-form-feedback]");

	if (!feedback) {
		return;
	}

	feedback.textContent = "";
	feedback.classList.remove("error");
}

async function runFormSubmission(form, event) {
	clearFormFeedback(form);

	let payload = await serializeFormToJson(form);
	const beforeSubmitName = form.dataset.beforeSubmit;

	if (beforeSubmitName && typeof window[beforeSubmitName] === "function") {
		const maybePayload = await window[beforeSubmitName]({
			form,
			payload,
			submitter: event.submitter || null,
		});

		if (typeof maybePayload !== "undefined") {
			payload = maybePayload;
		}
	}

	const result = await submitMockJson(form, payload);
	const afterSubmitName = form.dataset.afterSubmit;

	if (afterSubmitName && typeof window[afterSubmitName] === "function") {
		await window[afterSubmitName]({
			...result,
			form,
			submitter: event.submitter || null,
		});
	}

	if (form.dataset.reloadAfterSubmit === "true") {
		window.location.reload();
		return result;
	}

	const feedbackMessage = form.dataset.feedbackMessage;

	if (feedbackMessage) {
		setFormFeedback(form, feedbackMessage, false);
	}

	if (form.dataset.resetAfterSubmit === "true") {
		form.reset();
	}

	return result;
}

function registerMockForms(root) {
	const scope = root || document;
	const forms = collectForms(scope);

	forms.forEach((form) => {
		if (form.dataset.mockBound === "true") {
			return;
		}

		form.dataset.mockBound = "true";

		form.addEventListener("submit", async (event) => {
			if (event.defaultPrevented) {
				return;
			}

			event.preventDefault();

			try {
				await runFormSubmission(form, event);
			} catch (error) {
				console.error("[mock-form] submit failed", error);
				setFormFeedback(form, "Não foi possível preparar o envio mock.", true);
			}
		});
	});
}

window.ViewForms = {
	registerMockForms,
	serializeFormToJson,
	submitMockJson,
	filesToBase64,
	setFormFeedback,
	clearFormFeedback,
};

window.registerMockForms = registerMockForms;
window.serializeFormToJson = serializeFormToJson;
window.submitMockJson = submitMockJson;
window.filesToBase64 = filesToBase64;

if (document.readyState === "loading") {
	document.addEventListener("DOMContentLoaded", () => registerMockForms());
} else {
	registerMockForms();
}
