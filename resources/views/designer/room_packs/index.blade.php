@extends('designer.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>My Room Packs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Room Packs</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="card info-card customers-card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ route('room_packs.create') }}" class="mt-3 btn btn-primary">Upload New Room Pack</a>
                                </div>
                                <div class="col-md-9">
                                    <form action="{{ route('room_packs.index') }}" method="GET" class="mt-3">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" placeholder="Search by room pack name" value="{{ request()->query('search') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-success" type="submit">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <table class="table table-bordered mt-3">
                                <thead style="background-color: #f8f9fa;">
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Room Pack Name</th>
                                        <th>Cover Render</th>
                                        <th>2D Drawing</th>
                                        <th>Decor/Material Chart</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($roomPacks as $pack)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('room_packs.show', $pack->id) }}">
                                                    {{ $pack->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/' . $pack->cover_render) }}" width="100">
                                            </td>
                                            <td>
                                                <a href="{{ asset('storage/' . $pack->pdf_2d_drawing) }}" target="_blank">View PDF</a>
                                            </td>
                                            <td>
                                                <a href="{{ asset('storage/' . $pack->decor_material_chart) }}" download>Download</a>
                                            </td>

                                            {{-- ── Actions Column ── --}}
                                            <td class="text-center" style="position:relative; overflow:visible;">
                                                <div class="action-dropdown-wrap">
                                                    {{-- 3-dot button --}}
                                                    <button class="action-dots-btn" onclick="toggleDropdown(this)" title="Actions">
                                                        <span></span><span></span><span></span>
                                                    </button>

                                                    {{-- Dropdown options --}}
                                                    <div class="action-dropdown-menu">
                                                        <a href="{{ route('room_packs.show', $pack->id) }}" class="action-item view">
                                                            <i class="bi bi-eye"></i> View
                                                        </a>
                                                        <a href="{{ route('room_packs.edit', $pack->id) }}" class="action-item edit">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </a>
                                                        <button type="button" class="action-item delete" onclick="confirmDelete({{ $pack->id }})">
                                                            <i class="bi bi-trash3"></i> Delete
                                                        </button>
                                                    </div>
                                                </div>

                                                {{-- Hidden delete form --}}
                                                <form id="delete-form-{{ $pack->id }}"
                                                      action="{{ route('room_packs.destroy', $pack->id) }}"
                                                      method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No Room Packs Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{-- Pagination --}}
                            <div class="pagination d-flex justify-content-center mt-5">
                                @if ($roomPacks->onFirstPage())
                                    <span class="rounded">&laquo;</span>
                                @else
                                    <a href="{{ $roomPacks->previousPageUrl() }}" class="rounded">&laquo;</a>
                                @endif

                                @foreach ($roomPacks->links()->elements[0] as $page => $url)
                                    @if ($page == $roomPacks->currentPage())
                                        <a href="#" class="active rounded">{{ $page }}</a>
                                    @else
                                        <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if ($roomPacks->hasMorePages())
                                    <a href="{{ $roomPacks->nextPageUrl() }}" class="rounded">&raquo;</a>
                                @else
                                    <span class="rounded">&raquo;</span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <style>
        /* ── Pagination ── */
        .pagination {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }
        .pagination a {
            display: inline-block;
            padding: 0.5rem 0.75rem;
            color: #007bff;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            text-decoration: none;
            transition: background-color 0.2s, color 0.2s;
        }
        .pagination a:hover { background-color: #007bff; color: #fff; }
        .pagination .active { color: #fff; background-color: #007bff; border-color: #007bff; }
        .pagination span {
            display: inline-block;
            padding: 0.5rem 0.75rem;
            color: #6c757d;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
        .pagination .rounded {
            border-radius: 50%;
            width: 2rem; height: 2rem;
            display: flex; align-items: center; justify-content: center;
        }

        /* ── 3-dot Button ── */
        .action-dropdown-wrap {
            position: relative;
            display: inline-block;
        }
        .action-dots-btn {
            background: #f3f4f6;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            width: 36px; height: 36px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3.5px;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
            padding: 0;
        }
        .action-dots-btn:hover,
        .action-dots-btn.open {
            background: #ede9fe;
            border-color: #6366f1;
        }
        .action-dots-btn span {
            display: block;
            width: 4px; height: 4px;
            background: #6b7280;
            border-radius: 50%;
            transition: background 0.2s;
        }
        .action-dots-btn:hover span,
        .action-dots-btn.open span { background: #6366f1; }

        /* ── Dropdown Menu ── */
        .action-dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 6px);
            background: #fff;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 8px 28px rgba(0,0,0,0.13);
            min-width: 155px;
            z-index: 9999;
            overflow: hidden;
            animation: dropIn 0.17s ease;
        }
        @keyframes dropIn {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .action-dropdown-menu.show { display: block; }

        .action-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 11px 16px;
            font-size: 0.855rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            transition: background 0.15s;
            color: #374151;
        }
        .action-item + .action-item { border-top: 1px solid #f3f4f6; }
        .action-item i { font-size: 0.95rem; }

        .action-item.view  { color: #0284c7; }
        .action-item.view:hover  { background: #eff8ff; }

        .action-item.edit  { color: #7c3aed; }
        .action-item.edit:hover  { background: #f5f3ff; }

        .action-item.delete { color: #dc2626; }
        .action-item.delete:hover { background: #fff5f5; }

        /* Make table overflow visible so dropdown shows */
        .table { overflow: visible !important; }
        .table td { overflow: visible !important; }
    </style>

    <script>
        // ── Toggle dropdown
        function toggleDropdown(btn) {
            const menu = btn.nextElementSibling;
            const isOpen = menu.classList.contains('show');

            // Close all open menus first
            document.querySelectorAll('.action-dropdown-menu.show').forEach(m => m.classList.remove('show'));
            document.querySelectorAll('.action-dots-btn.open').forEach(b => b.classList.remove('open'));

            if (!isOpen) {
                menu.classList.add('show');
                btn.classList.add('open');
            }
        }

        // ── Close when clicking outside
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.action-dropdown-wrap')) {
                document.querySelectorAll('.action-dropdown-menu.show').forEach(m => m.classList.remove('show'));
                document.querySelectorAll('.action-dots-btn.open').forEach(b => b.classList.remove('open'));
            }
        });

        // ── Confirm delete with SweetAlert
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6366f1',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
