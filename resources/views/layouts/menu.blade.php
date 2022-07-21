@if(auth()->user()->username == 'penjualan' OR auth()->user()->username == 'ridho')
<div class="sb-sidenav-menu-heading">Admin Penjualan</div>
<a class="nav-link single-menu {{ (request()->segment(1)=='distribusi') ? 'active' : '' }}" href="{{route('penjualan')}}">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Data Penjualan
</a>
<a class="nav-link mt-2 single-menu {{ (request()->segment(1)=='distributor') ? 'active' : '' }}" href="{{route('distributor')}}">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Distributor
</a>
<a class="nav-link mt-2 collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#penjualan" aria-expanded="{{ (request()->segment(2)=='rekap') ? 'true' : 'false' }}" aria-controls="penjualan">
    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
    Rekap Data Penjualan
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse " id="penjualan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested  nav">
        <a class="nav-link " href="{{route('penjualan.rekap.harian')}}">Harian</a>
        <a class="nav-link2" href="{{route('penjualan.rekap.bulanan')}}">Bulanan</a>
    </nav>
</div>

@endif
@if(auth()->user()->username == 'keuangan' OR auth()->user()->username == 'ridho')
<div class="sb-sidenav-menu-heading">Admin Keuangan</div>
<a class="nav-link single-menu {{ (request()->segment(1)=='keuangan') ? 'active' : '' }}" href="{{route('keuangan')}}">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Data Keuangan
</a>
<a class="nav-link mt-2 single-menu {{ (request()->segment(1)=='distributor') ? 'active' : '' }}" href="{{route('distributor')}}">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Distributor
</a>
<a class="nav-link mt-2 collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#keuangan" aria-expanded="false" aria-controls="keuangan">
    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
    Rekap Data Keuangan
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="keuangan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link2" href="{{route('keuangan.rekap.harian')}}">Harian</a>
        <a class="nav-link2" href="{{route('keuangan.rekap.bulanan')}}">Bulanan</a>
    </nav>
</div>

@endif
@if(auth()->user()->username == 'produksi' OR auth()->user()->username == 'ridho')
<div class="sb-sidenav-menu-heading">Admin Produksi</div>
<a class="nav-link single-menu {{ (request()->segment(1)=='produksi') ? 'active' : '' }}" href="{{route('produksi')}}">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Data Produksi
</a>
<a class="nav-link mt-2 single-menu {{ (request()->segment(1) == 'hasil') ? 'active' : '' }} " href="{{route('produksi.hasil')}}">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Hasil Produksi
</a>
<a class="nav-link  {{ (request()->segment(2)=='rekap') ? 'active' : 'collapsed' }} text-wh mt-2 " href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="{{ (request()->segment(2)=='rekap') ? 'true' : 'false' }}" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
    Rekap Data Produksi
    <div class="sb-sidenav-collapse-arrow {{ (request()->segment(2)=='rekap') ? 'text-white' : '' }}"><i class="fas fa-angle-down"></i></div>
</a>
<div class="{{ (request()->segment(2)=='rekap') ? 'collapse show' : 'collapse' }}" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link2 {{ (request()->segment(3)=='harian') ? 'nav-link active' : '' }}" href="{{route('produksi.rekap.harian')}}">Harian</a>
        <a class="nav-link2 {{ (request()->segment(3)=='bulanan') ? 'nav-link active' : '' }}" href="{{route('produksi.rekap.bulanan')}}">Bulanan</a>
    </nav>
</div>

@endif

@if(auth()->user()->username == 'inventori' OR auth()->user()->username == 'ridho')
<div class="sb-sidenav-menu-heading">Admin Inventori</div>
<a class="nav-link single-menu {{ (request()->segment(1)=='inventori') ? 'active' : '' }}" href="{{route('inventori')}}">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Data Inventori
</a>
<a class="nav-link mt-2 {{ (request()->segment(2)=='b') ? 'active' : 'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#databarang" aria-expanded="{{ (request()->segment(2)=='b') ? 'true' : 'false' }}" aria-controls="databarang">
    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
    Data Barang
    <div class="sb-sidenav-collapse-arrow {{ (request()->segment(2)=='b') ? 'text-white' : '' }}"><i class="fas fa-angle-down"></i></div>
</a>
<div class="{{ (request()->segment(2)=='b') ? 'collapse show' : 'collapse' }}" id="databarang" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link2 {{ (request()->segment(3)=='masuk') ? 'nav-link active' : '' }}" href="{{route('inventori.masuk')}}">Data Barang Masuk</a>
        <a class="nav-link2  {{ (request()->segment(3)=='keluar') ? 'nav-link active' : '' }}" href="{{route('inventori.keluar')}}">Data Barang Keluar</a>
    </nav>
</div>

<a class="nav-link mt-2 collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
    Rekap Data Inventori
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link2" href="{{route('inventori.rekap.harian')}}">Harian</a>
        <a class="nav-link2" href="{{route('inventori.rekap.bulanan')}}">Bulanan</a>
    </nav>
</div>
@endif

@if(auth()->user()->username == 'distribusi' OR auth()->user()->username == 'ridho')
<div class="sb-sidenav-menu-heading">Admin Distribusi</div>
<a class="nav-link single-menu {{ (request()->segment(1)=='distribusi') ? 'active' : '' }}" href="{{route('produksi')}}">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Data Barang Masuk
</a>
<a class="nav-link mt-2 single-menu{{ (request()->segment(1) == 'hasil') ? 'active' : '' }} " href="{{route('produksi.hasil')}}">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Data Barang Keluar
</a>
<a class="nav-link mt-2 collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
    Rekap Data Inventori
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link2" href="{{route('produksi.rekap.harian')}}">Harian</a>
        <a class="nav-link2" href="{{route('produksi.rekap.hasil.harian')}}">Harian Hasil Produksi</a>
        <a class="nav-link2" href="{{route('produksi.rekap.bulanan')}}">Bulanan</a>
    </nav>
</div>
@endif


