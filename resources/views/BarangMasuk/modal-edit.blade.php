<!-- Modal Edit Data Masuk -->
<div class="modal fade" id="editBarangMasuk{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editBarangMasukLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBarangMasukLabel">Edit Data Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('barang-masuk.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mandatory">
                        <label class="form-label" for="nama_barang">Nama Barang</label>
                        <select class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="data_barang_id">
                            <option value="">-- Pilih Nama Barang --</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->id }} {{ $item->id == $item->data_barang_id ? 'selected' : '' }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mandatory">
                        <label class="form-label" for="jumlah">Jumlah</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah_masuk" value="{{ $item->jumlah_masuk }}">
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mandatory">
                        <label class="form-label" for="data_suplier_id">Suplier</label>
                        <select class="form-control @error('data_suplier_id') is-invalid @enderror" id="data_suplier_id" name="data_suplier_id">
                            <option value="">-- Pilih Suplier --</option>
                            @foreach ($suplier as $item)
                                <option value="{{ $item->id }} {{ $item->id == $item->data_suplier_id ? 'selected' : '' }}">{{ $item->nama_suplier }}</option>
                            @endforeach
                        </select>
                        @error('data_suplier_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mandatory">
                        <label class="form-label" for="tanggal_masuk">Tanggal Masuk</label>
                        <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" id="tanggal_masuk" name="tanggal_masuk" value="{{ $item->tanggal_masuk }}">
                        @error('tanggal_masuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>