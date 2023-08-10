<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Keranjang</h1>
        </div>
    </div>

    @include('admin-lte/flash')

    <div class="row">
        <div class="col-md-12 mb-4">
        <label for="tanggal_pinjam">Tanggal Pinjam</label>
        <input wire:model="tanggal_pinjam" type="date" class="form-control" id="tanggal_pinjam" value="{{ date('Y-m-d') }}">
        @error('tanggal_pinjam') <small class="text-danger">{{ $message }}</small> @enderror
</div>

    </div>

    <div class="row">
        <div class="col-md-12 mb-2">
                <strong>Tanggal Pinjam: {{ $tanggal_pinjam }}</strong>
                @if (!$pinjamClicked) <!-- Menambahkan kondisi apakah tombol sudah diklik -->
            <button wire:click="pinjam({{$keranjang->id}})" class="btn btn-sm btn-success">Pinjam</button>
                @endif
            <strong class="float-right">Kode Pinjam : {{$keranjang->kode_pinjam}}</strong>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
             <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                        <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($keranjang->detail_peminjaman as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->buku->judul}}</td>
                            <td>{{$item->buku->penulis}}</td>
                            <td>{{$item->peminjaman->tanggal_pinjam}}</td>
                            <td>{{$item->peminjaman->tanggal_kembali}}</td>
                            <td>
                                @if ($item->peminjaman->status == 1)
                                    <span class="badge  bg-indigo">Belum Dipinjam</span>
                                @elseif ($item->peminjaman->status == 2)
                                    <span class="badge bg-fuchsia">Sedang Dipinjam</span>
                                @else 
                                    <span class="badge bg-fuchsia">Sedang Dipinjam</span>
                                @endif
</td>


                            
                            <td>
                                    <button wire:click="hapus({{$keranjang->id}}, {{$item->id}})" class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                 <button wire:click="hapusMasal" class="btn btn-sm btn-danger">Hapus Masal</button>
        </div>
    </div>
</div>