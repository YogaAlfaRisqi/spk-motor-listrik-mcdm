@extends('layouts.app')
@section('title', 'Data Kriteria')

@section('content')
<x-common.page-breadcrumb pageTitle="Data Alternative" />
<div class="space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
        <!-- Header Partials -->
        @include('pages.alternatives.partials.header')

        <div class="overflow-hidden">
            <div class="max-w-full px-5 overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-gray-200 border-y dark:border-gray-700">
                            <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Nama Motor</th>
                            <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Harga</th>
                            <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Jarak Tempuh</th>
                            <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Waktu Pengisian</th>
                            <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Kapasitas Baterai</th>
                            <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Daya Maksimum</th>
                            <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Gambar</th>
                            <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Created By</th>
                            <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($alternatives as $alternative)
                        @include('pages.alternatives.partials.table-row', ['alternative' => $alternative])
                        @empty
                        @include('pages.alternatives.partials.empty-state')
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Pagination -->
        <div class="px-5 py-4">
            {{ $alternatives->links() }}
        </div>
    </div>
</div>
</div>
@endsection

<!-- Modals -->
@push('modals')
@include('pages.alternatives.partials.form-modal')
@include('pages.alternatives.partials.delete-modal')
@endpush

<!-- Modal Scripts -->
@push('scripts')
<script>
    function initAlternativePage() {
        const formModal = document.getElementById('alternativeModal');
        const deleteModal = document.getElementById('deleteAlternativeModal');
        if (!formModal || !deleteModal) return;
        const btnAdd = document.getElementById('btnAddAlternative');
        const btnCloseForm = document.getElementById('closeAlternativeModal');
        const btnCancelForm = document.getElementById('cancelAlternativeModal');
        const form = document.getElementById('alternativeForm');
        const title = document.getElementById('alternativeModalTitle');
        const methodField = document.getElementById('alternativeMethod');
        const idField = document.getElementById('alternativeId');
        const namaMoto = document.getElementById('nama_motor');
        const harga = document.getElementById('harga');
        const jarakTempuh = document.getElementById('jarak_tempuh');
        const waktuPengisian = document.getElementById('waktu_pengisian');
        const kapasitasBatrei = document.getElementById('kapasitas_baterai');
        const dayaMaksimum = document.getElementById('daya_maksimum');
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewWrapper = document.getElementById('imagePreviewWrapper');
        const createdBy = document.getElementById('created_by');

        const deleteForm = document.getElementById('deleteAlternativeForm');
        const deleteName = document.getElementById('deleteAlternativeName');
        const btnCloseDelete = document.getElementById('closeDeleteAlternativeModal');
        const btnCancelDelete = document.getElementById('cancelDeleteAlternativeModal');


        const openFormModal = () => {
            formModal.classList.remove('hidden');
            formModal.classList.add('flex');
        };

        const closeFormModal = () => {
            form.reset();
            form.action = "{{ route('admin.alternatives.store') }}";
            methodField.value = 'POST';
            idField.value = '';
            title.textContent = 'Tambah Alternative';
            formModal.classList.add('hidden');
            formModal.classList.remove('flex');
        };

        const openDeleteModal = () => {
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
        };

        const closeDeleteModal = () => {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
        };

        btnAdd?.addEventListener('click', openFormModal);
        btnCloseForm?.addEventListener('click', closeFormModal);
        btnCancelForm?.addEventListener('click', closeFormModal);

        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                title.textContent = 'Edit Alternative';
                form.action = this.dataset.updateUrl;
                methodField.value = 'PUT';
                idField.value = this.dataset.id;

                namaMoto.value = this.dataset.nama || '';
                harga.value = this.dataset.harga || '';
                jarakTempuh.value = this.dataset.jarakTempuh || '';
                waktuPengisian.value = this.dataset.waktuPengisian || '';
                kapasitasBatrei.value = this.dataset.kapasitasBaterai || '';
                dayaMaksimum.value = this.dataset.dayaMaksimum || '';
                // reset file input
                imageInput.value = '';
                // tampilkan gambar lama
                const imageUrl = this.dataset.image;
                if (imageUrl) {
                    imagePreview.src = imageUrl;
                    imagePreviewWrapper.classList.remove('hidden');
                } else {
                    imagePreview.src = '';
                    imagePreviewWrapper.classList.add('hidden');
                }
                
                createdBy.value = this.dataset.createdBy || '';


                openFormModal();
            });
        });
        imageInput?.addEventListener('change', function() {
            const file = this.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreviewWrapper.classList.remove('hidden');
            };

            reader.readAsDataURL(file);
        });

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                deleteName.textContent = this.dataset.name || '-';
                deleteForm.action = this.dataset.deleteUrl;
                openDeleteModal();
            });
        });

        btnCloseDelete?.addEventListener('click', closeDeleteModal);
        btnCancelDelete?.addEventListener('click', closeDeleteModal);

        [formModal, deleteModal].forEach(modal => {
            modal?.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeFormModal();
                    closeDeleteModal();
                }
            });
        });
    }

    document.addEventListener('livewire:navigated', initAlternativePage);
    initAlternativePage();
</script>
@endpush