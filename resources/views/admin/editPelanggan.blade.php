@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                          <form method="POST" action="/pelanggan/update">
                            @csrf
                            @foreach ($pelanggan as $p)
                            <div class="form-group">
                              <input type="hidden" class="form-control" name="id_pelanggan" value="{{$p->id_pelanggan}}">
                              <label>Nama Barang</label>
                            <input type="text" class="form-control" name="nama" value="{{$p->nama}}">
                            </div>   
                            <div class="form-group">
                              <label>Deskripsi Barang</label>
                              <textarea name="no_telp" class="form-control" rows="3" >{{$p->no_telp}}</textarea>
                            </div>   
                            <div class="form-group">
                              <label>Harga Barang</label>
                              <input type="text" class="form-control" name="alamat" value="{{$p->alamat}}">
                            </div>   
                            <div class="form-group"> 
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            @endforeach
                            </div>
                        </form>
                        </div>
                      </div>
                  
                    
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
