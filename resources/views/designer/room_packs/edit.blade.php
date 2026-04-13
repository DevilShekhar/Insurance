@extends('designer.layouts.app')

@section('content')

<style>
    /* ─── Premium Edit Page Styles ─── */
    .edit-page-header {
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
        border-radius: 16px;
        padding: 28px 32px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }
    .edit-page-header::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 200px; height: 200px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .edit-page-header h1 {
        color: #fff;
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0 0 6px;
        letter-spacing: -0.3px;
    }
    .edit-page-header .breadcrumb {
        margin: 0;
        background: transparent;
        padding: 0;
    }
    .edit-page-header .breadcrumb-item,
    .edit-page-header .breadcrumb-item a {
        color: rgba(255,255,255,0.65);
        font-size: 0.82rem;
        text-decoration: none;
    }
    .edit-page-header .breadcrumb-item.active { color: rgba(255,255,255,0.95); }
    .edit-page-header .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.4); }

    .edit-card {
        background: #fff;
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 24px rgba(0,0,0,0.07);
        overflow: hidden;
    }
    .edit-card-header {
        background: linear-gradient(90deg, #f8f7ff 0%, #ede9fe 100%);
        border-bottom: 1px solid #e5e3ff;
        padding: 18px 28px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .edit-card-header .icon-wrap {
        width: 40px; height: 40px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.1rem;
        flex-shrink: 0;
    }
    .edit-card-header h5 {
        margin: 0;
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1rem;
    }
    .edit-card-header p {
        margin: 0;
        color: #6b7280;
        font-size: 0.8rem;
    }

    .edit-card .card-body { padding: 28px; }

    /* Field Groups */
    .field-section {
        margin-bottom: 8px;
    }
    .field-section-title {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #6366f1;
        margin-bottom: 14px;
        padding-bottom: 8px;
        border-bottom: 2px solid #ede9fe;
    }

    .form-label-custom {
        font-size: 0.85rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        display: block;
    }
    .form-label-custom .badge-hint {
        font-size: 0.7rem;
        font-weight: 500;
        background: #ede9fe;
        color: #6366f1;
        padding: 2px 8px;
        border-radius: 20px;
        margin-left: 6px;
    }

    .form-control {
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.875rem;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: #fafafa;
    }
    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        background: #fff;
        outline: none;
    }
    input[type="file"].form-control {
        padding: 8px 12px;
        cursor: pointer;
    }

    /* Current File Preview */
    .current-file-card {
        border: 1.5px solid #e5e3ff;
        border-radius: 12px;
        padding: 14px 16px;
        background: #f8f7ff;
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .current-file-card .preview-thumb {
        width: 70px; height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e5e3ff;
        flex-shrink: 0;
    }
    .current-file-card .file-info { flex: 1; min-width: 0; }
    .current-file-card .file-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #6366f1;
        margin-bottom: 3px;
    }
    .current-file-card .file-name {
        font-size: 0.78rem;
        color: #374151;
        word-break: break-all;
        font-weight: 500;
    }
    .current-file-card .btn-view {
        font-size: 0.75rem;
        padding: 5px 14px;
        border-radius: 20px;
        background: linear-gradient(135deg,#6366f1,#8b5cf6);
        color: #fff;
        border: none;
        text-decoration: none;
        white-space: nowrap;
        transition: opacity 0.2s;
    }
    .current-file-card .btn-view:hover { opacity: 0.85; color:#fff; }

    /* Optional Renders Grid */
    .optional-renders-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 10px;
        margin-top: 10px;
    }
    .render-thumb-wrap {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid #e5e3ff;
    }
    .render-thumb-wrap img {
        width: 100%; height: 80px;
        object-fit: cover;
        display: block;
    }
    .render-thumb-wrap .render-remove {
        position: absolute;
        top: 4px; right: 4px;
        width: 20px; height: 20px;
        background: rgba(239,68,68,0.9);
        border-radius: 50%;
        font-size: 0.65rem;
        color: #fff;
        border: none;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        line-height: 1;
    }

    .add-more-btn {
        background: transparent;
        border: 1.5px dashed #6366f1;
        color: #6366f1;
        border-radius: 10px;
        padding: 8px 18px;
        font-size: 0.82rem;
        font-weight: 600;
        transition: background 0.2s, color 0.2s;
        cursor: pointer;
    }
    .add-more-btn:hover {
        background: #ede9fe;
    }
    .add-more-btn:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }

    /* Alert */
    .alert-danger {
        background: #fff5f5;
        border: 1.5px solid #fecaca;
        border-radius: 12px;
        color: #c0392b;
        padding: 14px 18px;
        font-size: 0.85rem;
    }

    /* Submit Buttons */
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid #f3f4f6;
        align-items: center;
    }
    .btn-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 12px 32px;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.01em;
        cursor: pointer;
        transition: transform 0.15s, box-shadow 0.15s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(99,102,241,0.35);
    }
    .btn-cancel {
        background: #f3f4f6;
        color: #374151;
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.15s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-cancel:hover { background: #e5e7eb; color: #111827; }

    .divider { height: 1px; background: #f3f4f6; margin: 24px 0; }
</style>

{{-- ─── HEADER ─── --}}
<div class="edit-page-header">
    <h1><i class="bi bi-pencil-square me-2"></i>Edit Room Pack</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('room_packs.index') }}">Room Packs</a></li>
            <li class="breadcrumb-item active">Edit — {{ $roomPack->name }}</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="edit-card">

                {{-- Card Header --}}
                <div class="edit-card-header">
                    <div class="icon-wrap"><i class="bi bi-box-seam"></i></div>
                    <div>
                        <h5>Room Pack Details</h5>
                        <p>Update the fields below. Leave file inputs empty to keep existing files.</p>
                    </div>
                </div>

                <div class="card-body">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <strong><i class="bi bi-exclamation-triangle-fill me-1"></i> Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('room_packs.update', $roomPack->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- ── SECTION 1: Basic Info ── --}}
                        <div class="field-section">
                            <div class="field-section-title">Basic Information</div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-custom" for="name">Room Pack Name</label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="e.g. Luxury Master Suite"
                                        required
                                        value="{{ old('name', $roomPack->name) }}"
                                    >
                                    @error('name')
                                        <small class="text-danger d-block mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        {{-- ── SECTION 2: Cover Render ── --}}
                        <div class="field-section">
                            <div class="field-section-title">Cover Render</div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-custom" for="cover_render">
                                        Replace Cover Image
                                        <span class="badge-hint">JPG / PNG / WEBP</span>
                                    </label>
                                    <input
                                        type="file"
                                        id="cover_render"
                                        name="cover_render"
                                        class="form-control @error('cover_render') is-invalid @enderror"
                                        accept="image/*"
                                        onchange="previewCoverRender(this)"
                                    >
                                    @error('cover_render')
                                        <small class="text-danger d-block mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</small>
                                    @enderror

                                    @if($roomPack->cover_render)
                                        <div class="current-file-card" id="cover-preview-wrap">
                                            <img src="{{ asset('storage/' . $roomPack->cover_render) }}"
                                                 id="cover-preview-img"
                                                 alt="Cover Render"
                                                 class="preview-thumb">
                                            <div class="file-info">
                                                <div class="file-label">Current Cover</div>
                                                <div class="file-name">{{ basename($roomPack->cover_render) }}</div>
                                            </div>
                                            <a href="{{ asset('storage/' . $roomPack->cover_render) }}" target="_blank" class="btn-view">View</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        {{-- ── SECTION 3: Optional Renders ── --}}
                        <div class="field-section">
                            <div class="field-section-title">Optional Renders <span class="badge-hint" style="font-size:0.68rem;background:#ede9fe;color:#6366f1;padding:2px 8px;border-radius:20px;margin-left:6px;">Max 3 images</span></div>

                            {{-- Existing renders --}}
                            @if(is_array($roomPack->optional_renders) && count($roomPack->optional_renders))
                                <div class="mb-3">
                                    <label class="form-label-custom mb-2">Current Optional Renders</label>
                                    <div class="optional-renders-grid">
                                        @foreach($roomPack->optional_renders as $render)
                                            <div class="render-thumb-wrap">
                                                <img src="{{ asset('storage/' . $render) }}" alt="Render">
                                                <button type="button" class="render-remove" title="Remove (upload new files to replace)">✕</button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small class="text-muted d-block mt-2"><i class="bi bi-info-circle"></i> Upload new files below to replace all optional renders.</small>
                                </div>
                            @endif

                            {{-- New uploads --}}
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label-custom">Upload New Optional Renders</label>
                                    <div id="optional_renders_container">
                                        <input type="file" name="optional_renders[]" class="form-control mb-2" accept="image/*">
                                    </div>
                                    <button type="button" id="add_render_btn" class="add-more-btn mt-1">
                                        <i class="bi bi-plus-circle"></i> Add Another Render
                                    </button>
                                    @error('optional_renders.*')
                                        <small class="text-danger d-block mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        {{-- ── SECTION 4: Documents ── --}}
                        <div class="field-section">
                            <div class="field-section-title">Documents</div>

                            <div class="row">
                                {{-- 2D Drawing (PDF) --}}
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-custom" for="pdf_2d_drawing">
                                        Replace 2D Drawing
                                        <span class="badge-hint">PDF Only</span>
                                    </label>
                                    <input
                                        type="file"
                                        id="pdf_2d_drawing"
                                        name="pdf_2d_drawing"
                                        class="form-control @error('pdf_2d_drawing') is-invalid @enderror"
                                        accept=".pdf"
                                    >
                                    @error('pdf_2d_drawing')
                                        <small class="text-danger d-block mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</small>
                                    @enderror

                                    @if($roomPack->pdf_2d_drawing)
                                        <div class="current-file-card mt-2">
                                            <div class="icon-wrap" style="background:linear-gradient(135deg,#dc2626,#ef4444);width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                <i class="bi bi-file-earmark-pdf text-white" style="font-size:1.3rem;"></i>
                                            </div>
                                            <div class="file-info">
                                                <div class="file-label">Current 2D Drawing</div>
                                                <div class="file-name">{{ basename($roomPack->pdf_2d_drawing) }}</div>
                                            </div>
                                            <a href="{{ asset('storage/' . $roomPack->pdf_2d_drawing) }}" target="_blank" class="btn-view">Open PDF</a>
                                        </div>
                                    @endif
                                </div>

                                {{-- Decor / Material Chart --}}
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-custom" for="decor_material_chart">
                                        Replace Decor/Material Chart
                                        <span class="badge-hint">Any File</span>
                                    </label>
                                    <input
                                        type="file"
                                        id="decor_material_chart"
                                        name="decor_material_chart"
                                        class="form-control @error('decor_material_chart') is-invalid @enderror"
                                    >
                                    @error('decor_material_chart')
                                        <small class="text-danger d-block mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</small>
                                    @enderror

                                    @if($roomPack->decor_material_chart)
                                        <div class="current-file-card mt-2">
                                            <div class="icon-wrap" style="background:linear-gradient(135deg,#0891b2,#06b6d4);width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                <i class="bi bi-file-earmark-arrow-down text-white" style="font-size:1.3rem;"></i>
                                            </div>
                                            <div class="file-info">
                                                <div class="file-label">Current Material Chart</div>
                                                <div class="file-name">{{ basename($roomPack->decor_material_chart) }}</div>
                                            </div>
                                            <a href="{{ asset('storage/' . $roomPack->decor_material_chart) }}" download class="btn-view">Download</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- ── Form Actions ── --}}
                        <div class="form-actions">
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-check-circle"></i> Update Room Pack
                            </button>
                            <a href="{{ route('room_packs.index') }}" class="btn-cancel">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                        </div>

                    </form>
                </div>{{-- /.card-body --}}
            </div>{{-- /.edit-card --}}
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // ── Cover Render live preview ──
    window.previewCoverRender = function(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById('cover-preview-img');
                if (img) img.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    };

    // ── Add More optional renders ──
    const container = document.getElementById('optional_renders_container');
    const addBtn    = document.getElementById('add_render_btn');
    let count = 1;

    addBtn.addEventListener('click', function () {
        if (count >= 3) return;

        const input = document.createElement('input');
        input.type  = 'file';
        input.name  = 'optional_renders[]';
        input.className = 'form-control mb-2';
        input.accept    = 'image/*';
        container.appendChild(input);

        count++;
        if (count >= 3) { addBtn.disabled = true; }
    });

    // ── Cosmetic remove buttons on existing renders (visual only) ──
    document.querySelectorAll('.render-remove').forEach(btn => {
        btn.addEventListener('click', function () {
            this.closest('.render-thumb-wrap').style.opacity = '0.35';
            this.closest('.render-thumb-wrap').style.outline = '2px solid #ef4444';
            this.title = 'Will be replaced when you upload new files';
        });
    });

});
</script>

@endsection
