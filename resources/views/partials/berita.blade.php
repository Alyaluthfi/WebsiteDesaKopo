<section id="berita" class="berita-section">
    <h2 class="section-title">Berita Acara Kegiatan</h2>
    <p class="section-subtitle">Dokumentasi kegiatan dan pembangunan terkini di Desa Kopo secara transparan dan realtime.</p>

    @if(count($beritaList) === 0)
        <div class="empty-state">
            <div class="empty-icon"><i class="fa-regular fa-folder-open"></i></div>
            <p>Belum ada berita acara kegiatan saat ini.</p>
        </div>
    @else
        <div class="berita-grid">
            @foreach($beritaList as $berita)
            <div class="berita-card">
                <div class="berita-img-wrapper">
                    <img src="{{ asset($berita->foto_kegiatan) }}" alt="{{ $berita->nama_kegiatan }}" class="berita-img">
                    <span class="berita-date">
                        <i class="fa-regular fa-calendar-days"></i> 
                        {{ \Carbon\Carbon::parse($berita->tanggal_pelaksanaan)->translatedFormat('d M Y') }}
                    </span>
                </div>
                <div class="berita-content">
                    <h3>{{ $berita->nama_kegiatan }}</h3>
                    <p class="berita-desc">{{ Str::limit($berita->deskripsi_kegiatan, 120) }}</p>
                    <button class="btn-read-more" onclick="showBeritaDetail({{ json_encode($berita) }})">
                        Baca Selengkapnya <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</section>

<!-- Detail Berita Modal -->
<div id="beritaModal" class="modal-overlay" onclick="closeBeritaModal(event)">
    <div class="modal-container" onclick="event.stopPropagation()">
        <button class="modal-close-btn" onclick="closeBeritaModal(event)">&times;</button>
        <div class="modal-img-wrapper">
            <img id="modal-img" src="" alt="Foto Kegiatan">
        </div>
        <div class="modal-content">
            <div class="modal-meta">
                <span id="modal-date" class="modal-date-tag"></span>
            </div>
            <h3 id="modal-title" class="modal-title"></h3>
            <div id="modal-desc" class="modal-desc-body"></div>
        </div>
    </div>
</div>

<script>
    function showBeritaDetail(berita) {
        document.getElementById('modal-img').src = "{{ asset('') }}" + berita.foto_kegiatan;
        
        // Format date in ID locale
        const dateObj = new Date(berita.tanggal_pelaksanaan);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const formattedDate = dateObj.toLocaleDateString('id-ID', options);
        
        document.getElementById('modal-date').innerHTML = '<i class="fa-regular fa-calendar-days"></i> ' + formattedDate;
        document.getElementById('modal-title').innerText = berita.nama_kegiatan;
        document.getElementById('modal-desc').innerText = berita.deskripsi_kegiatan;
        
        const modal = document.getElementById('beritaModal');
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeBeritaModal(e) {
        const modal = document.getElementById('beritaModal');
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
</script>
