@extends('layouts.admin')

@section('title', 'Todo Listesi')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-10">
        <h1 class="text-dark fw-bolder fs-2qx">📋 Todo Listesi</h1>
        <button id="openCreateModal" class="btn btn-primary">
            <i class="fa fa-plus"></i> Yeni Todo
        </button>
    </div>

    {{-- Table AJAX container --}}
    <div id="todoTableContainer">
        {{-- JS ile yüklenir --}}
    </div>

    {{-- Modal container --}}
    <div id="todoModalContainer"></div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function loadTodoTable() {
            fetch("{{ route('todo.table') }}")
                .then(res => res.text())
                .then(html => {
                    document.getElementById("todoTableContainer").innerHTML = html;
                })
                .catch(err => {
                    console.error("Tablo yüklenemedi:", err);
                    alert("Tablo yüklenemedi");
                });
        }

        window.addEventListener('DOMContentLoaded', function() {
            console.log("DOM yüklendi");

            const btn = document.getElementById('openCreateModal');
            if (!btn) {
                console.error("Yeni Todo butonu bulunamadı!");
                return;
            }

            btn.addEventListener('click', function() {
                console.log("Yeni Todo butonuna tıklandı");
                fetch("{{ route('todo.modal.create') }}")
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('todoModalContainer').innerHTML = html;

                        const modalEl = document.getElementById('createTodoModal');
                        if (!modalEl) {
                            console.error("Modal bulunamadı!");
                            return;
                        }

                        const modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    })
                    .catch(err => {
                        console.error("Modal yüklenemedi:", err);
                        alert("Modal yüklenemedi");
                    });
            });

            loadTodoTable();
        });




        //////////////////////////

        window.attachTableEvents = function() {
            // Edit
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

            // Delete
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

        // İlk yükleme
        function loadTodoTable() {
            fetch("{{ route('todo.table') }}")
                .then(res => res.text())
                .then(html => {
                    document.getElementById("todoTableContainer").innerHTML = html;
                    attachTableEvents(); // 💥 Burada tanımlı fonksiyon çalışıyor
                })
                .catch(err => {
                    console.error("Tablo yüklenemedi:", err);
                });
        }

        window.addEventListener('DOMContentLoaded', function() {
            document.getElementById('openCreateModal')?.addEventListener('click', function() {
                fetch("{{ route('todo.modal.create') }}")
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('todoModalContainer').innerHTML = html;
                        const modalEl = document.getElementById('createTodoModal');
                        const modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    });
            });

            loadTodoTable();
        });
    </script>
@endpush
