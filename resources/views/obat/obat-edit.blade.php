@extends('partials.main')
@section('content')
<h3>Input Obat</h3>
         <div class="form-login">
            <form action="/obat/update/{{$obat->id}}" method="POST" enctype="multipart/form-data">
               @method('PUT')
               @csrf
               <label for="obat">Obat</label>
               <input class="input" type="text" name="nama" id="obat" placeholder="obat" value="{{ $obat->nama_obat }}" />
               @error('nama')
               <p style="font-size: 10px; color: red">{{ $message }}</p>
               @enderror

               <label for="harga">Harga</label>
               <input class="input" type="text" name="harga" id="harga" placeholder="Harga" value="{{ $obat->harga }}" />
               @error('harga')
               <p style="font-size: 10px; color: red">{{ $message }}</p>
               @enderror

               <label for="deskripsi">Deskripsi</label>
               <textarea class="input" name="deskripsi" id="deskripsi" placeholder="Deskripsi">{{ $obat->deskripsi }}</textarea>
               @error('deskripsi')
               <p style="font-size: 10px; color: red">{{ $message }}</p>
               @enderror

               <label for="photo">Photo</label>
               <input type="file" name="photo" id="photo" />
               @error('photo')
               <p style="font-size: 10px; color: red">{{ $message }}</p>
               @enderror

               <button type="submit" class="btn btn-simpan" name="simpan" style="margin-top: 50px">
                  Simpan
               </button>
            </form>

         </div>
@endsection