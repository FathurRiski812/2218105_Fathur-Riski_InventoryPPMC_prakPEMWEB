@extends('partials.main')
@section('content')
<button type="button" class="btn btn-tambah">
					<a href="/obat/tambah">Tambah Data</a>
				</button>
<table class="table-data">
				<thead>
					<tr>
						<th scope="col" style="width: 20%">Photo</th>
						<th>Nama Obat</th>
						<th scope="col" style="width: 30%">Deskripsi</th>
						<th scope="col" style="width: 15%">Harga</th>
						<th scope="col" style="width: 20%">Aksi</th>
					</tr>
				</thead>
				<tbody>
                @forelse ($obat as $obats)
                    <tr>
                    <td><img src="{{asset('img_categories/'. $obats->photo)}}" alt="" width="300px"></td>
                    <td>{{ $obats->nama_obat }}</td>
                    <td>{{ $obats->deskripsi }}</td>
                    <td>Rp. {{ number_format($obats->harga, 0, ',', '.') }}</td>
                    <td>
                        <a class='btn-edit' href="/obat/edit/{{ $obats->id }}">Edit</a>
                        |
                        <a class='btn-delete' href="/obat/hapus/{{ $obats->id }}">Hapus</a>
                    </td>
                    </tr>
                    @empty
                    <tr>
                    <td colspan="5" align="center">Tidak ada data</td>
                    </tr>
                    @endforelse
				</tbody>
			</table>
@endsection