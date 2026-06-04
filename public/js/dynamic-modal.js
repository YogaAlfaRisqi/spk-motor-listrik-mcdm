// Fungsi untuk membuka modal
function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

// Fungsi untuk menutup modal
function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.style.overflow = 'auto';
    // Reset form
    const form = document.getElementById(`${modalId}Form`);
    if (form) form.reset();
}

// Class untuk handle dynamic modal
class DynamicModal {
    constructor(modalId) {
        this.modalId = modalId;
        this.form = document.getElementById(`${modalId}Form`);
        this.titleElement = document.getElementById(`${modalId}Title`);
        this.submitBtn = document.getElementById(`${modalId}SubmitBtn`);
        this.submitText = document.getElementById(`${modalId}SubmitText`);
        this.methodInput = document.getElementById(`${modalId}Method`);
        this.bodyElement = document.getElementById(`${modalId}Body`);
    }

    // CREATE
    showCreate(url, title = 'Tambah Data') {
        this.reset();
        this.setTitle(title);
        this.setAction(url, 'POST');
        this.setSubmitText('Simpan');
        this.setSubmitButtonColor('blue');
        openModal(this.modalId);
    }

    // EDIT
    showEdit(url, title = 'Edit Data', data = {}) {
        this.reset();
        this.setTitle(title);
        this.setAction(url, 'PUT');
        this.setSubmitText('Update');
        this.setSubmitButtonColor('blue');
        this.fillForm(data);
        openModal(this.modalId);
    }

    // VIEW (Read-only)
    showView(title = 'Detail Data', data = {}) {
        this.reset();
        this.setTitle(title);
        this.fillForm(data);
        this.disableForm();
        this.hideSubmitButton();
        openModal(this.modalId);
    }

    // DELETE
    showDelete(url, title = 'Hapus Data', message = 'Apakah Anda yakin ingin menghapus data ini?', data = {}) {
        this.reset();
        this.setTitle(title);
        this.setAction(url, 'DELETE');
        this.setSubmitText('Hapus');
        this.setSubmitButtonColor('red');
        
        // Ganti isi body dengan pesan konfirmasi
        this.bodyElement.innerHTML = `
            <div class="p-4 rounded-lg bg-red-50 dark:bg-red-900/20">
                <p class="text-sm text-red-800 dark:text-red-200">${message}</p>
                ${data.nama_kriteria ? `<p class="mt-2 text-sm font-semibold text-red-900 dark:text-red-100">${data.nama_kriteria}</p>` : ''}
            </div>
        `;
        
        openModal(this.modalId);
    }

    setTitle(title) {
        this.titleElement.textContent = title;
    }

    setAction(url, method = 'POST') {
        this.form.action = url;
        this.methodInput.value = method;
    }

    setSubmitText(text) {
        this.submitText.textContent = text;
    }

    setSubmitButtonColor(color) {
        this.submitBtn.className = `inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white rounded-lg`;
        
        if (color === 'red') {
            this.submitBtn.classList.add('bg-red-600', 'hover:bg-red-700');
        } else {
            this.submitBtn.classList.add('bg-blue-600', 'hover:bg-blue-700');
        }
    }

    fillForm(data) {
        Object.keys(data).forEach(key => {
            const input = this.form.querySelector(`[name="${key}"]`);
            if (input) {
                if (input.type === 'checkbox') {
                    input.checked = data[key];
                } else if (input.type === 'radio') {
                    const radio = this.form.querySelector(`[name="${key}"][value="${data[key]}"]`);
                    if (radio) radio.checked = true;
                } else {
                    input.value = data[key];
                }
            }
        });
    }

    reset() {
        this.form.reset();
        this.enableForm();
        this.showSubmitButton();
        // Restore original slot content if needed
        const originalContent = this.bodyElement.dataset.originalContent;
        if (originalContent) {
            this.bodyElement.innerHTML = originalContent;
        }
    }

    disableForm() {
        const inputs = this.form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => input.disabled = true);
    }

    enableForm() {
        const inputs = this.form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => input.disabled = false);
    }

    hideSubmitButton() {
        this.submitBtn.style.display = 'none';
    }

    showSubmitButton() {
        this.submitBtn.style.display = 'inline-flex';
    }

    setLoading(isLoading) {
        if (isLoading) {
            this.submitBtn.disabled = true;
            this.submitText.innerHTML = `
                <svg class="w-4 h-4 mr-2 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
            `;
        } else {
            this.submitBtn.disabled = false;
        }
    }
}