<!-- Modal Edit Data Barang -->
<div class="modal fade" id="editBarang{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editBarangLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBarangLabel">Edit Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('barang.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mandatory">
                        <label class="form-label" for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ $item->nama_barang }}">
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mandatory">
                        <label class="form-label" for="id_jenis_barang">Jenis Barang</label>
                        <select class="form-control @error('id_jenis_barang') is-invalid @enderror" id="id_jenis_barang" name="id_jenis_barang">
                            <option value="">Pilih Jenis Barang</option>
                            @foreach ($jenis_barang as $item)
                                <option value="{{ $item->id }} {{ $item->id == $item->id_jenis_barang ? 'selected' : '' }}">{{ $item->jenis_barang }}</option>
                            @endforeach
                        </select>
                        @error('id_jenis_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mandatory">
                        <label class="form-label" for="satuan">Satuan</label>
                        <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" value="{{ $item->satuan }}">
                        @error('satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>