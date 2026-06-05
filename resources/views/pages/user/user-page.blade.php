@extends('layouts.app')
@section('content')
<x-common.page-breadcrumb pageTitle="Data User" />
<!-- table content -->
    <div class="space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
            <!-- Header -->
            <div class="flex flex-col gap-2 px-5 mb-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Latest User</h3>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <form>
                        <div class="relative">
                            <button type="button" class="absolute -translate-y-1/2 left-4 top-1/2">
                                <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z" fill="" />
                                </svg>
                            </button>
                            <input type="text" placeholder="Search..." class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-[42px] pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-blue-800 xl:w-[300px]" />
                        </div>
                    </form>

                    <!-- ADD BUTTON -->
                    <button id="btnAddUser"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition">

                        <!-- PLUS ICON -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>

                        Tambah Data
                    </button>

                </div>
            </div>

            <!-- Table -->
            <div class="overflow-hidden">
                <div class="max-w-full px-5 overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-gray-200 border-y dark:border-gray-700">
                                <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Nama User</th>
                                <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Email</th>
                                <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Role</th>
                                <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-center text-theme-sm dark:text-gray-400">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($users as $user)
                            <tr>
                                <!-- KODE -->
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $user->name}}
                                    </div>
                                </td>

                                <!-- NAMA -->
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600 dark:text-gray-300">
                                        {{ $user->email}}
                                    </div>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600 dark:text-gray-300">
                                        Admin
                                    </div>
                                </td>

                                <!-- ACTION -->
                                <td class="px-4 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center gap-3">

                                        <!-- EDIT -->
                                        <button type="button" class="btn-edit p-2 rounded-lg hover:bg-blue-50 text-blue-500 hover:text-blue-700 transition"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}"
                                            data-role="admin"
                                            data-update-url="{{ route('admin.users.update', $user->id) }}">

                                            <!-- Pencil Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5h2m-1-1v2m-6 9l9-9 3 3-9 9H5v-3z" />
                                            </svg>
                                        </button>

                                        <!-- DELETE -->
                                        <button type="button" class="btn-delete p-2 rounded-lg hover:bg-red-50 text-red-500 hover:text-red-700 transition"
                                            data-name="{{ $user->name }}"
                                            data-delete-url="{{ route('admin.users.destroy', $user->id) }}">

                                            <!-- Trash Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 7h12M9 7V4h6v3m-7 4v6m4-6v6m4-6v6M5 7h14l-1 14H6L5 7z" />
                                            </svg>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-500">
                                    Data kriteria belum tersedia
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pagination -->
        </div>
    </div>
    </div>
    @endsection


    @push('modals')
    @include('pages.user.partials.form-modal')
    @include('pages.user.partials.delete-modal')
@endpush

@push('scripts')
<script>
    const formModal   = document.getElementById('userModal');
    const deleteModal = document.getElementById('deleteUserModal');

    const btnAdd        = document.getElementById('btnAddUser');
    const btnCloseForm  = document.getElementById('closeUserModal');
    const btnCancelForm = document.getElementById('cancelUserModal');

    const form        = document.getElementById('userForm');
    const title       = document.getElementById('userModalTitle');
    const methodField = document.getElementById('userMethod');
    const idField     = document.getElementById('userId');

    const name     = document.getElementById('name');
    const email    = document.getElementById('email');
    const password = document.getElementById('password');
    const role     = document.getElementById('role');

    const deleteForm   = document.getElementById('deleteUserForm');
    const deleteName   = document.getElementById('deleteUserName');
    const btnCloseDelete  = document.getElementById('closeDeleteUserModal');
    const btnCancelDelete = document.getElementById('cancelDeleteUserModal');

    const openFormModal = () => {
        formModal.classList.remove('hidden');
        formModal.classList.add('flex');
    };

    const closeFormModal = () => {
        form.reset();
        form.action       = "{{ route('admin.users.store') }}";
        methodField.value = 'POST';
        idField.value     = '';
        title.textContent = 'Tambah User';
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
            title.textContent = 'Edit User';
            form.action       = this.dataset.updateUrl;
            methodField.value = 'PUT';
            idField.value     = this.dataset.id;

            name.value     = this.dataset.name     || '';
            email.value    = this.dataset.email    || '';
            password.value = '';
            role.value     = this.dataset.role     || '';

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