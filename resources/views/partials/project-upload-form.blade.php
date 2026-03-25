@php
    $show = $showAlerts ?? true;
@endphp

@php
    $isEditing = isset($editingProject) && $editingProject;
    $action = $isEditing ? route('projects.update', $editingProject->id) : route('projects.store');
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="project-upload-form">
    @csrf
    @if($isEditing)
        @method('PUT')
        <!-- Header handled by Modal -->
    @else
        <h3>Upload Project Baru</h3>
    @endif

    <div>
        <label class="form-group-label">Judul Project</label>
        <input type="text" name="title" value="{{ old('title', $isEditing ? $editingProject->title : '') }}"
            placeholder="Masukkan judul project" class="form-input">
        @if($show)
            @error('title') <span class="form-error">{{ $message }}</span> @enderror
        @endif
    </div>

    <div>
        <label class="form-group-label">Deskripsi</label>
        <textarea name="description" placeholder="Deskripsi singkat project (opsional)"
            class="form-textarea">{{ old('description', $isEditing ? $editingProject->description : '') }}</textarea>
        @if($show)
            @error('description') <span class="form-error">{{ $message }}</span> @enderror
        @endif
    </div>

    <div>
        <label class="form-group-label">Kategori</label>
        <select name="category" class="form-input">
            <option value="">-- Pilih Kategori --</option>
            @php
                $currentCategory = old('category', $isEditing ? $editingProject->category : '');
            @endphp
            <option value="design" {{ $currentCategory == 'design' ? 'selected' : '' }}>Design</option>
            <option value="pdf" {{ $currentCategory == 'pdf' ? 'selected' : '' }}>PDF</option>
            <option value="cybersecurity" {{ $currentCategory == 'cybersecurity' ? 'selected' : '' }}>Cybersecurity
            </option>
            <option value="tutorial" {{ $currentCategory == 'tutorial' ? 'selected' : '' }}>Tutorial</option>
            <option value="certificate" {{ $currentCategory == 'certificate' ? 'selected' : '' }}>Sertifikat</option>
        </select>
        @if($show)
            @error('category') <span class="form-error">{{ $message }}</span> @enderror
        @endif
    </div>

    @if(!$isEditing)
        <div>
            <label class="form-group-label">File (Max 10MB)</label>
            <input type="file" name="file" class="form-input">
            @if($show)
                @error('file') <span class="form-error">{{ $message }}</span> @enderror
            @endif
        </div>
    @else
        {{-- FILE LAMA --}}
        <div>
            <label class="form-group-label">File Saat Ini</label>
            <p>
                <strong>{{ $editingProject->original_filename }}</strong><br>
                <small>
                    {{ number_format($editingProject->file_size / 1024, 2) }} KB
                </small>
            </p>
        </div>

        {{-- FILE BARU (OPSIONAL) --}}
        <div>
            <label class="form-group-label">Ganti File (Opsional)</label>
            <input type="file" name="file" class="form-input">
            <small>
                Kosongkan jika tidak ingin mengganti file
            </small>
            @if($show)
                @error('file') <span class="form-error">{{ $message }}</span> @enderror
            @endif
        </div>
    @endif


    <div>
        <button type="submit" class="btn">
            {{ $isEditing ? 'Simpan' : 'Upload Project' }}
        </button>
        @if($isEditing)
            <a href="{{ route('dashboard') }}" class="btn-secondary">Batal</a>
        @endif
    </div>
</form>
</div>