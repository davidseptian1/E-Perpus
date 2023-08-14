<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Detail Baca Buku</h1>
        </div>
    </div>

    @include('admin-lte/flash')

    <div class="row">
        <div class="col-md-12 mb-4">
        <label for="tanggal_pinjam">Tanggal Baca</label>
        <input wire:model="tanggal_pinjam" type="date" class="form-control" id="tanggal_pinjam" value="{{ date('Y-m-d') }}">
        @error('tanggal_pinjam') <small class="text-danger">{{ $message }}</small> @enderror
</div>

    </div>

    <div class="row">
        <div class="col-md-12 mb-2">
                <strong>Tanggal Baca: {{ $tanggal_pinjam }}</strong>
                @if (!$pinjamClicked) <!-- Menambahkan kondisi apakah tombol sudah diklik -->
            <button wire:click="pinjam({{$keranjang->id}})" class="btn btn-sm btn-success">Baca</button>
            <br>
            <p  >Note : sebelum melakukan baca buku, di mohon untuk melakukan pengisian Tanggal Pembaca</p>
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
                    <th>Tanggal Baca</th>
                    <th>Tanggal Expired</th>
                    <th>Status</th>
                    <th>Baca</th>
                    <th>Hapus</th>
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
                                    <span class="badge  bg-indigo">Belum Dibaca</span>
                                @elseif ($item->peminjaman->status == 2)
                                    <span class="badge bg-fuchsia">Sedang Dibaca</span>
                                @else 
                                    <span class="badge bg-fuchsia">Belum Daftar</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->peminjaman->status == 1)
                                    <span class="badge bg-fuchsia">Belum Dikembalikan</span>
                                @elseif ($item->peminjaman->status == 2)
                                    <a href="{{$item->buku->pdf}}" target="_blank" style="width:100px; height:30px; margin-top:0px;padding-top:5px" class="btn btn-primary">Lihat PDF</a>
                                @elseif ($item->peminjaman->status == 3)
                                    <span class="badge bg-fuchsia">Sudah Dikembalikan</span>
                                @else 
                                    <span class="badge bg-fuchsia">Belum diajukan</span>
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