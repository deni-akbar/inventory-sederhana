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
                <div class="card-header text-center">
                  <h1><b>LAPORAN STOK</b></h1><br>
                  @foreach ($barang as $b)
                  Barang :{{$b->id_barang}}({{$b->nama}})
                  @endforeach <br>
                  Periode :{{$date1}} - {{$date2}}
                </div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Kode Transaksi</th>
                        <th scope="col">Masuk</th>
                        <th scope="col">Keluar</th>
                        <th scope="col">Stok Akhir</th>
                      </tr>
                    </thead>
                    <tbody>
                    <tr><td colspan="4"></td><td>Stok Awal:</td><td>{{$stokawal}}</td></tr>
                    @php $x=1; $akumulasi=$stokawal; @endphp
                    @foreach ($pembelian as $p)  
                      <tr>
                        <th scope="row">{{$x++}}</th>
                        <td>{{$p->tgl_beli}}</td>
                        <td>{{$p->id_beli}}</td>
                        <td>{{$p->jumlah}}</td>
                        <td>0</td>
                        @php
                           $akumulasi=$stokawal+=$p->jumlah;
                        @endphp
                        <td>{{$akumulasi}}</td>
                      </tr>
                    @endforeach
                    @foreach ($penjualan as $p)  
                    <tr>
                      <th scope="row">{{$x++}}</th>
                      <td>{{$p->tgl_jual}}</td>
                      <td>{{$p->id_jual}}</td>
                      <td>0</td>
                      <td>{{$p->jumlah}}</td>
                      @php
                           $akumulasi=$akumulasi-=$p->jumlah;
                      @endphp
                      <td>{{$akumulasi}}</td>
                    </tr>
                  @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
