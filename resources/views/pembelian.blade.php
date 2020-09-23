@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                      <li> Data harus lengkap </li>
                    </ul>
                </div>
              @endif
              @if(session()->has('msg'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('msg') }}
                        </div>
                    @endif
                <div class="card-header text-center"><h4>Pembelian</h4> </div>

                <form action="/session/store" method="POST">
                  @csrf
                  <div class="form-inline">
                      <label>Barang&nbsp;</label>
                      <select  class="form-control" name="id_barang">
                          @foreach ($barang as $b)
                        <option value="{{$b->id_barang}}">{{$b->nama}} (Rp.{{$b->harga}})</option>
                          @endforeach
                        </select>&nbsp;
                      <input type="text" class="form-control" name="jumlah" value="" placeholder="Jumlah">
                      &nbsp;<button type="submit" class="btn btn-primary">tambah</button>
                  </div>
                  <br>
              </form>

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">subtotal</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @isset($carts)

                @forelse ($carts as $c)  
                  <tr>
                    <th scope="row">{{$c['id_barang']}}</th>
                    <td>{{$c['harga']}}</td>
                    <td>{{$c['jumlah']}}</td>
                    <td>{{number_format($c['harga'] * $c['jumlah'])}}</td>
                    <td><a href="/session/hapus/{{$c['id_barang']}}" class="btn btn-danger">X</a></td>
                  </tr>
                  @empty
                  <tr>
                      <td colspan="4">Tidak ada Barang</td>
                  </tr>
                @endforelse
                @endisset
                <tr>
                <td colspan="3">Total:</td>
                  <td colspan="4">{{number_format($subtotal)}}</td>
              </tr>
                </tbody>
              </table>

                <div class="card-body">
                    

                    <form method="POST" action="/pembelian/store">
                        @csrf
                        <div class="form-group">
                          <label>Kode supplier</label>
                          <select  class="form-control" name="id_supplier">
                            <option selected disabled>-Pilih Supplier-</option>
                            @foreach ($supplier as $s)
                          <option value="{{$s->id_supplier}}">{{$s->nama}}</option>
                            @endforeach
                          </select>
                        </div>   
                        <div class="form-group">
                          <label>Tanggal</label>
                          <input type="date" class="form-control" name="tgl_beli">
                        </div>   
                        <div class="form-group">
                          <label>Total</label>
                          <input type="text" class="form-control" name="subtotal" value="{{$subtotal}}" readonly>
                        </div>
                        <div class="form-group"> 
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>

                        
                        <br>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
