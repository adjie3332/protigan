<!-- Modal Tambah Data Barang Masuk -->
<div class="modal fade" id="tambahBarangKeluar" tabindex="-1" role="dialog" aria-labelledby="tambahBarangKeluarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBarangKeluarLabel">Tambah Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('barang-keluar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mandatory">
                        <label for="nama_barang">Nama Barang</label>
                        <select class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="data_barang_id">
                            <option value="">-- Pilih Nama Barang --</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mandatory">
                        <label class="form-label" for="jumlah">Jumlah</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah_keluar" value="{{ old('jumlah_keluar') }}">
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mandatory">
                        <label class="form-label" for="tanggal_keluar">Tanggal Keluar</label>
                        <input type="date" class="form-control @error('tanggal_keluar') is-invalid @enderror" id="tanggal_keluar" name="tanggal_keluar" value="{{ old('tanggal_keluar') }}">
                        @error('tanggal_keluar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mandatory">
                        <label class="form-label" for="deskripsi">Keterangan</label>
                        <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}">
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->