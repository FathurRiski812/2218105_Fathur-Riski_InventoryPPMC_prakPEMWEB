<button type="button" class="btn btn-tambah">
					<a href="/obat/tambah">Tambah Data</a>
				</button>
<table class="table-data" border="1">
				<thead>
					<tr>
						<th>Nama Obat</th>
						<th scope="col" style="width: 30%">Deskripsi</th>
						<th scope="col" style="width: 15%">Harga</th>
					</tr>
				</thead>
				<tbody>
                @forelse ($obat as $obats)
                    <tr>
                    <td>{{ $obats->nama_obat }}</td>
                    <td>{{ $obats->deskripsi }}</td>
                    <td>Rp. {{ number_format($obats->harga, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                    <td colspan="5" align="center">Tidak ada data</td>
                    </tr>
                    @endforelse
				</tbody>
			</table>
