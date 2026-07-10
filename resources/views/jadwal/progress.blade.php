@extends('layouts.app')

@section('title', 'Generate Jadwal')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body text-center py-5">
                <h3 class="card-title mb-2">Generate Jadwal</h3>
                <p class="text-muted mb-4" id="versionName">{{ $version->nama }}</p>

                <div class="progress mb-4" style="height:24px;">
                    <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                         role="progressbar" style="width:0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        0%
                    </div>
                </div>

                <div id="stepList" class="text-start mx-auto" style="max-width:500px;">
                    <div class="step-item" data-step="mulai">
                        <span class="step-icon">⏳</span>
                        <span class="step-text">Memulai proses generate...</span>
                    </div>
                    <div class="step-item" data-step="data">
                        <span class="step-icon">⏳</span>
                        <span class="step-text">Mengumpulkan data master...</span>
                    </div>
                    <div class="step-item" data-step="kirim">
                        <span class="step-icon">⏳</span>
                        <span class="step-text">Mengirim data ke Python scheduler...</span>
                    </div>
                    <div class="step-item" data-step="tunggu">
                        <span class="step-icon">⏳</span>
                        <span class="step-text">Menunggu hasil OR-Tools (bisa 30-120 detik)...</span>
                    </div>
                    <div class="step-item" data-step="simpan">
                        <span class="step-icon">⏳</span>
                        <span class="step-text">Menyimpan jadwal ke database...</span>
                    </div>
                    <div class="step-item" data-step="selesai">
                        <span class="step-icon">⏳</span>
                        <span class="step-text">Selesai!</span>
                    </div>
                </div>

                <div id="infoMessage" class="alert alert-info mt-4 d-none">
                    <span id="infoText"></span>
                </div>

                <div id="errorMessage" class="alert alert-danger mt-4 d-none">
                    <i class="ti ti-alert-triangle"></i>
                    <span id="errorText"></span>
                </div>

                <div id="successActions" class="mt-4 d-none">
                    <a href="{{ route('jadwal.keseluruhan', ['version_id' => $version->id]) }}" class="btn btn-primary">
                        <i class="ti ti-calendar-stats"></i> Lihat Jadwal Keseluruhan
                    </a>
                    <a href="{{ route('jadwal.versi') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left"></i> Kembali ke Versi
                    </a>
                </div>

                <div id="errorActions" class="mt-4 d-none">
                    <button onclick="location.reload()" class="btn btn-warning">
                        <i class="ti ti-refresh"></i> Coba Lagi
                    </button>
                    <a href="{{ route('jadwal.versi') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .step-item {
        padding: 10px 15px;
        margin-bottom: 4px;
        border-radius: 8px;
        background: #f8f9fa;
        transition: all 0.3s;
    }
    .step-item.active {
        background: #e8f0fe;
        border-left: 4px solid #206bc4;
        font-weight: 600;
    }
    .step-item.done {
        background: #e9f7ef;
        border-left: 4px solid #2fb344;
    }
    .step-item.error {
        background: #fff0f0;
        border-left: 4px solid #d63939;
    }
    .step-icon {
        display: inline-block;
        width: 24px;
        margin-right: 8px;
    }
    .progress-bar {
        transition: width 0.5s ease;
    }
</style>
@endpush

@push('scripts')
<script>
    var versionId = {{ $version->id }};
    var pollInterval;

    function updateProgress(data) {
        var percent = Math.min(data.percent, 100);
        var bar = document.getElementById('progressBar');
        bar.style.width = percent + '%';
        bar.setAttribute('aria-valuenow', percent);
        bar.textContent = percent + '%';

        document.querySelectorAll('.step-item').forEach(function(el) {
            var step = el.getAttribute('data-step');
            el.classList.remove('active', 'done', 'error');

            var stepOrder = ['mulai', 'data', 'kirim', 'tunggu', 'simpan', 'selesai'];
            var currentIdx = stepOrder.indexOf(data.step);
            var thisIdx = stepOrder.indexOf(step);

            if (data.error && step === 'selesai') {
                el.classList.add('error');
                el.querySelector('.step-icon').textContent = '❌';
            } else if (thisIdx < currentIdx) {
                el.classList.add('done');
                el.querySelector('.step-icon').textContent = '✅';
            } else if (thisIdx === currentIdx) {
                el.classList.add('active');
                el.querySelector('.step-icon').textContent = '⏳';
            } else {
                el.querySelector('.step-icon').textContent = '⏳';
            }
        });

        document.getElementById('infoText').textContent = data.message;
        var infoBox = document.getElementById('infoMessage');
        var errorBox = document.getElementById('errorMessage');
        var successActions = document.getElementById('successActions');
        var errorActions = document.getElementById('errorActions');

        if (data.error) {
            errorBox.classList.remove('d-none');
            document.getElementById('errorText').textContent = data.message;
            infoBox.classList.add('d-none');
            successActions.classList.add('d-none');
            errorActions.classList.remove('d-none');
            stopPolling();
        } else if (data.done) {
            infoBox.classList.add('d-none');
            errorBox.classList.add('d-none');
            successActions.classList.remove('d-none');
            errorActions.classList.add('d-none');
            stopPolling();
        } else {
            infoBox.classList.remove('d-none');
            errorBox.classList.add('d-none');
            successActions.classList.add('d-none');
            errorActions.classList.add('d-none');
        }
    }

    function pollProgress() {
        fetch('{{ route("jadwal.progress-data", $version->id) }}')
            .then(function(r) { return r.json(); })
            .then(function(data) {
                updateProgress(data);
            })
            .catch(function(err) {
                console.error('Polling error:', err);
            });
    }

    function stopPolling() {
        if (pollInterval) {
            clearInterval(pollInterval);
            pollInterval = null;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        pollProgress();
        pollInterval = setInterval(pollProgress, 2000);
    });

    window.addEventListener('beforeunload', function() {
        stopPolling();
    });
</script>
@endpush
