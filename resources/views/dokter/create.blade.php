@extends('master.main')
@section('content')
<style>
    .card-body{
        font-size: 12px;
    }
    .form-group{
        margin-bottom: 10px;
    }
    input, textarea, select{
        text-transform: uppercase;
    }
</style>
<div class="container-fluid mt--6">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <h3 class="mb-0">Tambah Dokter</h3>
        </div>
        <div class="card-body">
            <form action="{{route('save_dokter')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Nama</label>
                                    <input type="text" name="nama" id="nama_dokter" class="form-control col-8" placeholder="Nama Dokter">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">NIP</label>
                                    <input type="text" name="nip" id="nip" class="form-control col-8" placeholder="NIP">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-5">
                        <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                        <button type="reset" class="btn btn-fill btn-danger btn-batal-pasien">Batal</button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
    <footer class="footer pt-0">
    <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6">
        <div class="copyright text-center text-lg-left text-muted">
            © 2019 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
        </div>
        </div>
        <div class="col-lg-6">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
            <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
            </li>
            <li class="nav-item">
            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
            <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
            <a href="https://www.creative-tim.com/license" class="nav-link" target="_blank">License</a>
            </li>
        </ul>
        </div>
    </div>
    </footer>
</div>
@endsection