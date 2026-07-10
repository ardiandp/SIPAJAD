@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row row-deck row-cards">
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Guru</div>
                </div>
                <div class="h1 mb-3">{{ $data['total_guru'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Mata Pelajaran</div>
                </div>
                <div class="h1 mb-3">{{ $data['total_mapel'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Kelas</div>
                </div>
                <div class="h1 mb-3">{{ $data['total_kelas'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Ruangan</div>
                </div>
                <div class="h1 mb-3">{{ $data['total_ruangan'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Beban Mengajar</div>
                </div>
                <div class="h1 mb-3">{{ $data['total_beban'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Versi Jadwal</div>
                </div>
                <div class="h1 mb-3">{{ $data['total_versi'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Jadwal Final</div>
                </div>
                <div class="h1 mb-3">{{ $data['jadwal_final'] }}</div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Selamat Datang di SIPAJAD</h3>
            <p class="text-muted">Sistem Penjadwalan Otomatis untuk SMK.</p>
            <p>Langkah-langkah penggunaan:</p>
            <ol>
                <li>Input data <strong>Jurusan</strong> (admin)</li>
                <li>Input data <strong>Guru</strong></li>
                <li>Input data <strong>Mata Pelajaran</strong></li>
                <li>Input data <strong>Kelas</strong></li>
                <li>Input data <strong>Ruangan</strong></li>
                <li>Input <strong>Hari</strong> dan <strong>Jam Pelajaran</strong></li>
                <li>Atur <strong>Beban Mengajar</strong> (guru → mapel → kelas)</li>
                <li>Buat <strong>Versi Jadwal</strong> baru</li>
                <li>Klik <strong>Generate Jadwal</strong> untuk menjalankan otomatisasi</li>
            </ol>
        </div>
    </div>
</div>
@endsection
