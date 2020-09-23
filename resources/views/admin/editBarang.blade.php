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
                          <form method="POST" action="/barang/update">
                            @csrf
                            @foreach ($barang as $b)
                            <div class="form-group">
                              <input type="hidden" class="form-control" name="id_barang" value="{{$b->id_barang}}">
                              <label>Nama Barang</label>
                            <input type="text" class="form-control" name="nama" value="{{$b->nama}}">
                            </div>   
                            <div class="form-group">
                              <label>Deskripsi Barang</label>
                              <textarea name="deskripsi" class="form-control" rows="3" >{{$b->deskripsi}}</textarea>
                            </div>   
                            <div class="form-group">
                              <label>Harga Barang</label>
                              <input type="text" class="form-control" name="harga" value="{{$b->harga}}">
                            </div>   
                            <div class="form-group">
                              <label>Stok Barang</label>
                              <input type="text" class="form-control" name="stok" value="{{$b->stok}}">
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
