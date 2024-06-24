<!-- Modal Tambah Data JenisBarang -->
<div class="modal fade" id="tambahJenisBarang" tabindex="-1" role="dialog" aria-labelledby="tambahJenisBarangLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahJenisBarangLabel">Tambah Data JenisBarang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('jenis-barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mandatory">
                        <label class="form-label" for="jenis_barang">Jenis Barang</label>
                        <input type="text" class="form-control @error('jenis_barang') is-invalid @enderror" id="jenis_barang" name="jenis_barang" value="{{ old('jenis_barang') }}">
                        @error('jenis_barang')
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

