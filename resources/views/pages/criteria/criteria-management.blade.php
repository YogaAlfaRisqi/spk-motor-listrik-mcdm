@extends('layouts.app')

@section('title', 'Data Kriteria')

@section('content')
<x-common.page-breadcrumb pageTitle="Data Kriteria" />

<div class="space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex flex-col gap-2 px-5 mb-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Latest Criteria</h3>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <form method="GET" action="{{ route('admin.criteria.index') }}">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search..."
                            class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-4 pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-blue-800 xl:w-[300px]"
                        />
                    </div>
                </form>

                <button type="button" id="btnAddCriteria"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Data
                </button>
            </div>
        </div>

        <div class="overflow-hidden">
            <div class="max-w-full px-5 overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-gray-200 border-y dark:border-gray-700">
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Kode Kriteria</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Nama Kriteria</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Keterangan</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Satuan</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Tipe</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($criterias as $criteria)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap font-semibold">{{ $criteria->kode_kriteria }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $criteria->nama_kriteria }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $criteria->keterangan }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $criteria->skala_penilaian ?? '-' }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        {{ $criteria->tipe === 'benefit' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        {{ ucfirst($criteria->tipe) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <button
                                            type="button"
                                            class="btn-edit p-2 rounded-lg hover:bg-blue-50 text-blue-500 hover:text-blue-700 transition"
                                            data-id="{{ $criteria->id_kriteria }}"
                                            data-kode="{{ $criteria->kode_kriteria }}"
                                            data-nama="{{ $criteria->nama_kriteria }}"
                                            data-keterangan="{{ $criteria->keterangan }}"
                                            data-satuan="{{ $criteria->skala_penilaian }}"
                                            data-tipe="{{ $criteria->tipe }}"
                                            data-update-url="{{ route('admin.criteria.update', $criteria->id_kriteria) }}"
                                        >✎</button>

                                        <button
                                            type="button"
                                            class="btn-delete p-2 rounded-lg hover:bg-red-50 text-red-500 hover:text-red-700 transition"
                                            data-id="{{ $criteria->id_kriteria }}"
                                            data-name="{{ $criteria->nama_kriteria }}"
                                            data-delete-url="{{ route('admin.criteria.destroy', $criteria->id_kriteria) }}"
                                        >🗑</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-500">Data kriteria belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="px-5 py-4">
            {{ $criterias->links() }}
        </div>
    </div>
</div>
@endsection

@push('modals')
    @include('pages.criteria.partials.form-modal')
    @include('pages.criteria.partials.delete-modal')
@endpush

@push('scripts')
<script>
    const formModal   = document.getElementById('criteriaModal');
    const deleteModal = document.getElementById('deleteCriteriaModal');

    const btnAdd        = document.getElementById('btnAddCriteria');
    const btnCloseForm  = document.getElementById('closeCriteriaModal');
    const btnCancelForm = document.getElementById('cancelCriteriaModal');

    const form        = document.getElementById('criteriaForm');
    const title       = document.getElementById('criteriaModalTitle');
    const methodField = document.getElementById('criteriaMethod');
    const idField     = document.getElementById('criteriaId');

    const kode       = document.getElementById('kode_kriteria');
    const nama       = document.getElementById('nama_kriteria');
    const keterangan = document.getElementById('keterangan');
    const satuan     = document.getElementById('skala_penilaian');
    const tipe       = document.getElementById('tipe');

    const deleteForm   = document.getElementById('deleteCriteriaForm');
    const deleteName   = document.getElementById('deleteCriteriaName');
    const btnCloseDelete  = document.getElementById('closeDeleteCriteriaModal');
    const btnCancelDelete = document.getElementById('cancelDeleteCriteriaModal');

    const openFormModal = () => {
        formModal.classList.remove('hidden');
        formModal.classList.add('flex');
    };

    const closeFormModal = () => {
        form.reset();
        form.action       = "{{ route('admin.criteria.store') }}";
        methodField.value = 'POST';
        idField.value     = '';
        title.textContent = 'Tambah Kriteria';
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
        button.addEventListener('click', function () {
            title.textContent = 'Edit Kriteria';
            form.action       = this.dataset.updateUrl;
            methodField.value = 'PUT';
            idField.value     = this.dataset.id;

            kode.value       = this.dataset.kode       || '';
            nama.value       = this.dataset.nama       || '';
            keterangan.value = this.dataset.keterangan || '';
            satuan.value     = this.dataset.satuan     || '';
            tipe.value       = this.dataset.tipe       || '';

            openFormModal();
        });
    });

    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            deleteName.textContent = this.dataset.name || '-';
            deleteForm.action      = this.dataset.deleteUrl;
            openDeleteModal();
        });
    });

    btnCloseDelete?.addEventListener('click', closeDeleteModal);
    btnCancelDelete?.addEventListener('click', closeDeleteModal);

    [formModal, deleteModal].forEach(modal => {
        modal?.addEventListener('click', function (e) {
            if (e.target === this) {
                closeFormModal();
                closeDeleteModal();
            }
        });
    });
</script>
@endpush