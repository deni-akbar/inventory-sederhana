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
                <div class="card-header text-center"><b>LAPORAN</b></div>

                <div class="card-body">
                    <form action="/laporan/cari" method="get">
                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input type="date" class="form-control" name="startDate">
                        </div>  
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" class="form-control" name="endDate">
                        </div> 
                        <div class="form-group">
                            <label>Barang</label>
                            <select  class="form-control" name="id_barang">
                              <option selected disabled>-Pilih barang-</option>
                              @foreach ($barang as $b)
                            <option value="{{$b->id_barang}}">{{$b->nama}}</option>
                              @endforeach
                            </select>
                        </div> 
                        <center><button class="btn btn-primary" type="submit">CETAK</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
