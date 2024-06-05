@extends('partials.main')
@section('content')
	<div class="home-content">
	   <h3>Hapus Obat</h3>
         <div class="form-login">
            <h4>Ingin Menghapus Data ?</h4>
            <form
              action="/obat/destroy/{{$obat->id}}"
              method="post"
              enctype="multipart/form-data"
            >
			@method('DELETE')
			@csrf
              <button type="submit" class="btn" name="hapus" style="margin-top: 50px;">
			Yes
		  </button>
		  <button type="submit" class="btn" name="tidak">
			No
		  </button>
            </form>
          </div>
	</div>
	@endsection