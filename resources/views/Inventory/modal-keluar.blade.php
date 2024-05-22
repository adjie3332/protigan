<!-- Modal Tambah Data Barang Masuk -->
<div class="modal fade" id="tambahInventoryKeluar" tabindex="-1" role="dialog" aria-labelledby="tambahInventoryKeluarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahInventoryKeluarLabel">Tambah Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('inventory.store-keluar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mandatory">
                        <label for="nama_barang">Nama Barang</label>
                        <select class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="data_inventory_id">
                            <option value="">-- Pilih Nama Barang --</option>
                            @foreach ($inventory as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mandatory">
                        <label class="form-label" for="penerima">Penerima</label>
                        <select class="form-control @error('penerima') is-invalid @enderror" id="penerima" name="data_karyawan_id">
                            <option value="">-- Pilih Penerima --</option>
                            @foreach ($karyawan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('penerima')
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
                        <label class="form-label" for="keperluan">Keperluan</label>
                        <input type="text" class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" name="keperluan" value="{{ old('keperluan') }}">
                        @error('keperluan')
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

<!-- Modal Edit Data Barang Masuk -->
{{-- <div class="modal fade" id="editInventoryKeluar" tabindex="-1" role="dialog" aria-labelledby="editInventoryKeluarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInventoryKeluarLabel">Edit Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit-inventory-keluar" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mandatory">
                        <label for="nama_barang">Nama Barang</label>
                        <select class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="data_inventory_id">
                            <option value="">-- Pilih Nama Barang --</option>
                            @foreach ($inventory as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mandatory">
                        <label class="form-label" for="penerima">Penerima</label>
                        <select class="form-control @error('penerima') is-invalid @enderror" id="penerima" name="data_karyawan_id">
                            <option value="">-- Pilih Penerima --</option>
                            @foreach ($karyawan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('penerima')
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
                        <label class="form-label" for="keperluan">Keperluan</label>
                        <input type="text" class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" name="keperluan" value="{{ old('keperluan') }}"> --}}