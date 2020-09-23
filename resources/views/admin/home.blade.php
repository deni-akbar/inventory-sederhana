@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Master Tabel</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                          <h2 class="text-center"><b>Tabel User</b><br><a href="" class="btn btn-success" data-toggle="modal" data-target="#tambahU">TAMBAH</a></h2>
                            
                          <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Nama User</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Jabatan</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($users as $u)  
                                <tr>
                                  <th scope="row">{{$u->id}}</th>
                                  <td>{{$u->name}}</td>
                                  <td>{{$u->email}}</td>
                                  <td>
                                    @php
                                      if($u->roles==1){
                                        echo"admin";
                                      }elseif ($u->roles==2) {
                                        echo"supplier";
                                      }else{
                                        echo"pelanggan";
                                      }
                                    @endphp
                                    
                                  </td>
                                  <td><a href="/user/edit/{{$u->id}}" class="btn btn-primary">Ubah</a>
                                  <a href="/user/hapus/{{$u->id}}" class="btn btn-danger">Hapus</a></td>
                                </tr>
                              @endforeach
                              </tbody>
                            </table>
          
                            <div class="modal" tabindex="-1" id="tambahU">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title"><b>Tambah User</b> </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                      <form method="POST" action="/user/store">
                                          @csrf
                                          <div class="form-group">
                                            <label>Nama User</label>
                                            <input type="text" class="form-control" name="name">
                                          </div>   
                                          <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email">
                                          </div>   
                                          <div class="form-group">
                                            <label>Jabatan</label>
                                              <select id="inputState" class="form-control" name="roles">
                                                <option selected disabled>-Pilih Jabatan-</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Supplier</option>
                                                <option value="3">Pelanggan</option>
                                              </select>
                                          </div>
                                          <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" id="myInput">
                                            <input type="checkbox" onclick="myFunction()"> Show Password
                                            <script>function myFunction() {
                                              var x = document.getElementById("myInput");
                                              if (x.type === "password") {
                                                x.type = "text";
                                              } else {
                                                x.type = "password";
                                              }
                                            }</script>
                                          </div>    
                                          <div class="form-group"> 
                                          <button type="submit" class="btn btn-primary">Tambah</button>
                                          </div>
                                      </form>
                                  </div>
                                </div>
                              </div>
                            </div>

                          <br><br>

                          <h2 class="text-center"><b>Tabel Supplier</b><br><a href="" class="btn btn-success" data-toggle="modal" data-target="#tambahS">TAMBAH</a></h2>
                            
                          <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Nama Supplier</th>
                                  <th scope="col">No. Telepon</th>
                                  <th scope="col">Alamat</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($supplier as $s)  
                                <tr>
                                  <th scope="row">{{$s->id_supplier}}</th>
                                  <td>{{$s->nama}}</td>
                                  <td>{{$s->no_telp}}</td>
                                  <td>{{$s->alamat}}</td>
                                  <td><a href="/supplier/edit/{{$s->id_supplier}}" class="btn btn-primary">Ubah</a>
                                  <a href="/supplier/hapus/{{$s->id_supplier}}" class="btn btn-danger">Hapus</a></td>
                                </tr>
                              @endforeach
                              </tbody>
                            </table>
          
                            <div class="modal" tabindex="-1" id="tambahS">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title"><b>Tambah Supplier</b> </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                      <form method="POST" action="/supplier/store">
                                          @csrf
                                          <div class="form-group">
                                            <label>Nama Supplier</label>
                                            <input type="text" class="form-control" name="nama">
                                          </div>   
                                          <div class="form-group">
                                            <label>No.Telepon</label>
                                            <textarea name="no_telp" class="form-control" rows="3"></textarea>
                                          </div>   
                                          <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" name="alamat">
                                          </div>   
                                          <div class="form-group"> 
                                          <button type="submit" class="btn btn-primary">Tambah</button>
                                          </div>
                                      </form>
                                  </div>
                                </div>
                              </div>
                            </div>

                          <br><br>

                            <h2 class="text-center"><b>Tabel Pelanggan</b><br><a href="" class="btn btn-success" data-toggle="modal" data-target="#tambahP">TAMBAH</a></h2>
                            
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">No. Telepon</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($pelanggan as $p)  
                                  <tr>
                                    <th scope="row">{{$p->id_pelanggan}}</th>
                                    <td>{{$p->nama}}</td>
                                    <td>{{$p->no_telp}}</td>
                                    <td>{{$p->alamat}}</td>
                                    <td><a href="/pelanggan/edit/{{$p->id_pelanggan}}" class="btn btn-primary">Ubah</a>
                                    <a href="/pelanggan/hapus/{{$p->id_pelanggan}}" class="btn btn-danger">Hapus</a></td>
                                  </tr>
                                @endforeach
                                </tbody>
                              </table>
            
                              <div class="modal" tabindex="-1" id="tambahP">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title"><b>Tambah Pelanggan</b> </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="/pelanggan/store">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nama Pelanggan</label>
                                              <input type="text" class="form-control" name="nama">
                                            </div>   
                                            <div class="form-group">
                                              <label>No.Telepon</label>
                                              <textarea name="no_telp" class="form-control" rows="3"></textarea>
                                            </div>   
                                            <div class="form-group">
                                              <label>Alamat</label>
                                              <input type="text" class="form-control" name="alamat">
                                            </div>   
                                            <div class="form-group"> 
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
            
                              <br><br>
            
                              <h2 class="text-center"><b>Tabel Barang</b><br><a href="" class="btn btn-success" data-toggle="modal" data-target="#tambah">TAMBAH</a></h2>
                            
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($barang as $b)  
                                  <tr>
                                    <th scope="row">{{$b->id_barang}}</th>
                                    <td>{{$b->nama}}</td>
                                    <td>{{$b->deskripsi}}</td>
                                    <td>{{$b->harga}}</td>
                                    <td>{{$b->stok}}</td>
                                    <td><a href="/barang/edit/{{$b->id_barang}}" class="btn btn-primary">Ubah</a>
                                    <a href="/barang/hapus/{{$b->id_barang}}" class="btn btn-danger">Hapus</a></td>
                                  </tr>
                                @endforeach
                                </tbody>
                              </table>
            
                              <div class="modal" tabindex="-1" id="tambah">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title"><b>Tambah Barang</b> </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="/barang/store">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nama Barang</label>
                                              <input type="text" class="form-control" name="nama">
                                            </div>   
                                            <div class="form-group">
                                              <label>Deskripsi Barang</label>
                                              <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                                            </div>   
                                            <div class="form-group">
                                              <label>Harga Barang</label>
                                              <input type="text" class="form-control" name="harga">
                                            </div>   
                                            <div class="form-group">
                                              <label>Stok Barang</label>
                                              <input type="text" class="form-control" name="stok">
                                            </div>  
                                            <div class="form-group"> 
                                            <button type="submit" class="btn btn-primary">Tambah</button>
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
            </div>
        </div>
    </div>
</div>
@endsection
