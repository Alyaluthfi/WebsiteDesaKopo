<section id="dokumen" class="dokumen-section">
    <div class="container">
        <h2 class="section-title">Dokumen Resmi Desa</h2>
        <p class="section-subtitle">Unduh dokumen administrasi, peraturan desa, dan formulir layanan publik Desa Kopo secara gratis dan transparan.</p>

        <div class="dokumen-grid">
            @forelse($documents as $doc)
                <div class="dokumen-card">
                    <div class="doc-icon-wrapper {{ $doc->file_type }}">
                        @if($doc->file_type === 'gambar')
                            <i class="fa-regular fa-file-image"></i>
                        @else
                            <i class="fa-regular fa-file-pdf"></i>
                        @endif
                    </div>
                    <div class="doc-info">
                        <h3>{{ $doc->title }}</h3>
                        <p class="doc-meta">
                            <span><i class="fa-regular fa-calendar"></i> {{ $doc->created_at->format('d M Y') }}</span>
                            <span><i class="fa-solid fa-download"></i> {{ $doc->downloads_count }} Unduhan</span>
                        </p>
                        @if($doc->description)
                            <p class="doc-desc">{{ $doc->description }}</p>
                        @endif
                        <a href="{{ route('document.download', $doc->id) }}" class="btn-download">
                            <i class="fa-solid fa-cloud-arrow-down"></i> Unduh File
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="grid-column: 1 / -1; margin: 2rem auto;">
                    <i class="fa-regular fa-folder-open empty-icon" style="font-size: 3rem; color: var(--text-muted); opacity: 0.5;"></i>
                    <p style="color: var(--text-muted); margin-top: 1rem; font-weight: 500;">Belum ada dokumen publik yang diunggah.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
