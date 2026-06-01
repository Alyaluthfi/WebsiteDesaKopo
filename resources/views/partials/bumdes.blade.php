<section id="bumdes">
    <h2 class="section-title">Badan Usaha Milik Desa (BUMDes)</h2>
    <p class="section-subtitle">Mendorong perekonomian lokal Desa Kopo melalui berbagai unit usaha yang dikelola secara
        profesional untuk kesejahteraan warga.</p>

    <div class="bumdes-grid">
        @foreach($bumdesList as $bumdes)
        <div class="bumdes-card">
            <div class="bumdes-img-wrapper">
                <span class="bumdes-tag">{{ $bumdes->category }}</span>
                <img src="{{ asset($bumdes->image) }}" alt="{{ $bumdes->name }}" class="bumdes-img">
            </div>
            <div class="bumdes-content">
                <h3>{{ $bumdes->name }}</h3>
                <p>{{ $bumdes->description }}</p>
                <a href="{{ route('bumdes.show', $bumdes->slug) }}" class="read-more">Selengkapnya <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        @endforeach
    </div>
</section>