@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <!-- Statistik Token -->
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card z-index-2 mb-4">
            <div class="card-body p-3">
                <h6 class="ms-2 mt-4 mb-0">Token's Statistics</h6>
                <p class="text-sm ms-2">(<span class="font-weight-bolder">+23%</span>) than last week</p>
                <div class="container border-radius-lg">
                    <div class="row">
                        <div class="col-3 py-3 ps-0">
                            <div class="d-flex mb-2">
                                <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-primary text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-layer-group text-white"></i>
                                </div>
                                <p class="text-xs mt-1 mb-0 font-weight-bold">All Tokens</p>
                            </div>
                            <h4 class="font-weight-bolder">36K</h4>
                            <div class="progress w-75">
                                <div class="progress-bar bg-dark w-60"></div>
                            </div>
                        </div>
                        <div class="col-3 py-3 ps-0">
                            <div class="d-flex mb-2">
                                <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check-circle text-white"></i>
                                </div>
                                <p class="text-xs mt-1 mb-0 font-weight-bold">Available</p>
                            </div>
                            <h4 class="font-weight-bolder">2M</h4>
                            <div class="progress w-75">
                                <div class="progress-bar bg-dark w-90"></div>
                            </div>
                        </div>
                        <div class="col-3 py-3 ps-0">
                            <div class="d-flex mb-2">
                                <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-warning text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-hourglass-half text-white"></i>
                                </div>
                                <p class="text-xs mt-1 mb-0 font-weight-bold">Pending</p>
                            </div>
                            <h4 class="font-weight-bolder">435</h4>
                            <div class="progress w-75">
                                <div class="progress-bar bg-dark w-30"></div>
                            </div>
                        </div>
                        <div class="col-3 py-3 ps-0">
                            <div class="d-flex mb-2">
                                <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-danger text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-fire text-white"></i>
                                </div>
                                <p class="text-xs mt-1 mb-0 font-weight-bold">Used</p>
                            </div>
                            <h4 class="font-weight-bolder">43</h4>
                            <div class="progress w-75">
                                <div class="progress-bar bg-dark w-50"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 🧠 Token Insights -->
        <div class="card blur shadow-blur border-radius-xl">
            <div class="card-header pb-0 bg-transparent d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-dark font-weight-bolder mb-0">
                        <i class="fas fa-chart-line text-success me-2"></i> Token Insights
                    </h6>
                    <p class="text-sm mb-0 text-secondary">Tren penggunaan dan aktivitas terbaru</p>
                </div>
            </div>
            <div class="card-body">
                <h6 class="text-dark font-weight-bold mb-3">Aktivitas Terbaru</h6>
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md me-3">
                                <i class="fas fa-plus text-white"></i>
                            </div>
                            <div>
                                <h6 class="text-sm mb-0">Pembelian Token Baru</h6>
                                <p class="text-xs text-secondary mb-0">5 menit yang lalu</p>
                            </div>
                        </div>
                        <span class="badge bg-gradient-success text-xs">+1.000</span>
                    </li>

                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md me-3">
                                <i class="fas fa-exchange-alt text-white"></i>
                            </div>
                            <div>
                                <h6 class="text-sm mb-0">Token digunakan untuk API</h6>
                                <p class="text-xs text-secondary mb-0">30 menit yang lalu</p>
                            </div>
                        </div>
                        <span class="badge bg-gradient-danger text-xs">-250</span>
                    </li>

                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md me-3">
                                <i class="fas fa-gift text-white"></i>
                            </div>
                            <div>
                                <h6 class="text-sm mb-0">Bonus Token Diterima</h6>
                                <p class="text-xs text-secondary mb-0">1 jam yang lalu</p>
                            </div>
                        </div>
                        <span class="badge bg-gradient-success text-xs">+500</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Token Cart -->
    <div class="col-lg-5">
        <div class="card blur shadow-blur border-radius-xl">
            <div class="card-header pb-0 bg-transparent">
                <h6 class="text-dark font-weight-bolder mb-0">
                    <i class="fas fa-shopping-cart text-primary me-2"></i> Token Cart
                </h6>
                <p class="text-sm mb-0 text-secondary">Pesan token baru untuk keperluan aplikasi</p>
            </div>
            <div class="card-body">
                <form id="tokenOrderForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Jumlah Token</label>
                        <input type="number" class="form-control border px-3" id="amount" name="amount" placeholder="Contoh: 1000" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori Token</label>
                        <select class="form-select border" id="category" name="category" required>
                            <option value="">Pilih kategori</option>
                            <option value="standard">Standard</option>
                            <option value="premium">Premium</option>
                            <option value="enterprise">Enterprise</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea class="form-control border" id="note" name="note" rows="2" placeholder="Tambahkan keterangan..."></textarea>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <h6 class="mb-0">Total Estimasi</h6>
                        <h5 class="text-gradient text-primary fw-bold" id="totalEstimate">Rp 0</h5>
                    </div>

                    <hr class="horizontal dark mt-3 mb-5">

                    <button type="submit" class="btn bg-gradient-primary w-100 mb-2">
                        <i class="fas fa-paper-plane me-2"></i> Pesan Sekarang
                    </button>
                    <button type="reset" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-undo me-2"></i> Reset
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- History Pembelian Token -->
<div class="row mt-3">
    <div class="col-12">
        <div class="card blur shadow-blur border-radius-xl">
            <div class="card-header bg-transparent pb-0 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-dark font-weight-bolder mb-0">
                        <i class="fas fa-history text-primary me-2"></i> Riwayat Pembelian Token
                    </h6>
                    <p class="text-sm mb-0 text-secondary">Berikut daftar transaksi token terakhir</p>
                </div>
                <button class="btn btn-sm bg-gradient-primary" id="refreshHistory">
                    <i class="fas fa-sync-alt me-1"></i> Refresh
                </button>
            </div>

            <div class="card-body px-4 pb-3">
                <div class="table-responsive">
                    <table id="tokenHistoryTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">#</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Jumlah</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Kategori</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Total</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">Status</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Catatan</th>
                            </tr>
                        </thead>
                        <tbody id="historyBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function () {
    // === Update total harga ===
    function updateTotal() {
        let amount = parseInt($('#amount').val()) || 0;
        let category = $('#category').val();
        let price = 0;
        if (category === 'standard') price = 100;
        else if (category === 'premium') price = 250;
        else if (category === 'enterprise') price = 500;
        $('#totalEstimate').text('Rp ' + (amount * price).toLocaleString('id-ID'));
    }
    $('#amount, #category').on('input change', updateTotal);

    // === Form Submit ===
    $('#tokenOrderForm').on('submit', function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url: '/token/order',
            method: 'POST',
            data: formData,
            beforeSend: () => Swal.fire({title:'Memproses...',text:'Mohon tunggu sebentar.',allowOutsideClick:false,didOpen:()=>Swal.showLoading()}),
            success: (res) => {
                Swal.fire({icon:'success',title:'Berhasil!',text:res.message||'Token berhasil dipesan.'});
                $('#tokenOrderForm')[0].reset();
                $('#totalEstimate').text('Rp 0');
            },
            error: (xhr) => {
                Swal.fire({icon:'error',title:'Gagal!',text:xhr.responseJSON?.message || 'Terjadi kesalahan.'});
            }
        });
    });

    // === History Dummy ===
    const dummyHistory = [
        {id:1,date:'2025-10-10 13:24:11',amount:1000,category:'standard',total:100000,status:'Selesai',note:'Pembelian untuk WA Gateway'},
        {id:2,date:'2025-10-12 09:40:55',amount:500,category:'premium',total:125000,status:'Menunggu',note:'Untuk API test project'},
        {id:3,date:'2025-10-15 15:22:33',amount:250,category:'enterprise',total:125000,status:'Dibatalkan',note:'Saldo tidak mencukupi'},
    ];

    function renderHistory(){
        let tbody=$('#historyBody').empty();
        dummyHistory.forEach((item,i)=>{
            let cls='bg-gradient-success';
            if(item.status==='Menunggu')cls='bg-gradient-warning';
            else if(item.status==='Dibatalkan')cls='bg-gradient-danger';
            tbody.append(`
                <tr>
                    <td class="text-center text-sm">${i+1}</td>
                    <td class="text-sm">${item.date}</td>
                    <td class="text-sm">${item.amount.toLocaleString('id-ID')} token</td>
                    <td class="text-sm text-capitalize">${item.category}</td>
                    <td class="text-sm">Rp ${item.total.toLocaleString('id-ID')}</td>
                    <td class="text-center"><span class="badge ${cls} text-xs">${item.status}</span></td>
                    <td class="text-sm">${item.note}</td>
                </tr>`);
        });
    }
    $('#refreshHistory').click(()=>{renderHistory();Swal.fire({icon:'success',title:'Data Diperbarui!',timer:1200,showConfirmButton:false});});
    renderHistory();

});
</script>
@endpush
