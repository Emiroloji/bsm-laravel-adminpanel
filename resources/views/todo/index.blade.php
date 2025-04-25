@extends('layouts.admin')

@section('title', 'Todo Listesi')

@section('content')
    <div class="toolbar mb-5 mb-lg-7 d-flex justify-content-between align-items-center" id="kt_toolbar">
        <div class="page-title d-flex flex-column me-3">
            <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Todo List</h1>
            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Ana Sayfa</a>
                </li>
                <li class="breadcrumb-item text-gray-600">Todo</li>
            </ul>
        </div>
        <button onclick="openCreateModal()" class="btn btn-primary">
            <i class="fa fa-plus"></i> Yeni Todo
        </button>
    </div>

    <div id="todoReportComponent"></div>

    <div id="todoComponent"></div>

    <div id="modalContainer"></div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            loadTodoComponent();
            todoReportComponent();
        });

        function loadTodoComponent() {
            $.ajax({
                url: '{{ route('todo.components.todo-table') }}',
                type: 'GET',
                success: function(data) {
                    $('#todoComponent').html(data);
                },
                error: function(xhr) {
                    console.error('Component yüklenirken hata:', xhr.responseText);
                }
            });
        }

        function openCreateModal() {
            $.ajax({
                url: '{{ route('todo.modal.create') }}',
                type: 'GET',
                success: function(data) {
                    $('#modalContainer').html(data);
                    $('#createTodoModal').modal('show');
                },
                error: function(xhr) {
                    console.error('Modal yüklenirken hata:', xhr.responseText);
                }
            });
        }

        function todoReportComponent() {
            $.ajax({
                url: '{{ route('todo.components.todo-report') }}',
                type: 'GET',
                success: function(data) {
                    $('#todoReportComponent').html(data);
                },
                error: function(xhr) {
                    console.error('Component yüklenirken hata:', xhr.responseText);
                }
            });
        }
    </script>
@endpush
