@extends('layouts.admin')

@section('title', 'Todo Listesi')

@section('content')
    <div class="bg-white rounded shadow-sm p-5">
        <div class="d-flex justify-content-between align-items-center mb-10">
            <h1 class="text-dark fw-bolder fs-2qx">📋 Todo Listesi</h1>
            <button id="openCreateModal" class="btn btn-primary">
                <i class="fa fa-plus"></i> Yeni Todo
            </button>
        </div>

        {{-- Table AJAX container --}}
        <div id="todoTableContainer"></div>

        {{-- Modal container --}}
        <div id="todoModalContainer"></div>
    </div>
@endsection

@push('scripts')
    <script>
        window.attachTableEvents = function() {
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    fetch(`/todo/modal/edit/${id}`)
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById('todoModalContainer').innerHTML = html;
                            const modalEl = document.getElementById('editTodoModal');
                            if (modalEl) {
                                const modal = new bootstrap.Modal(modalEl);
                                modal.show();
                            }
                        });
                });
            });

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Silmek istediğinize emin misiniz?',
                        text: "Bu işlem geri alınamaz!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Evet, sil',
                        cancelButtonText: 'Vazgeç'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${id}`).submit();
                        }
                    });
                });
            });
        }

        function loadTodoTable() {
            fetch("{{ route('todo.table') }}")
                .then(res => res.text())
                .then(html => {
                    document.getElementById("todoTableContainer").innerHTML = html;
                    attachTableEvents();
                })
                .catch(err => {
                    console.error("Tablo yüklenemedi:", err);
                });
        }

        window.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('openCreateModal');
            if (btn) {
                btn.addEventListener('click', function() {
                    fetch("{{ route('todo.modal.create') }}")
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById('todoModalContainer').innerHTML = html;
                            const modalEl = document.getElementById('createTodoModal');
                            const modal = new bootstrap.Modal(modalEl);
                            modal.show();
                        });
                });
            }

            loadTodoTable();
        });
    </script>
@endpush
