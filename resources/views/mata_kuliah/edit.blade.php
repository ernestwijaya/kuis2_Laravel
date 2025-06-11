@extends('main')

@section('title', 'Mata Kuliah')
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
            {{-- form tambah fakultas --}}
            <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Form Ubah Mata Kuliah</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{ route('mata_kuliah.update', $mataKuliah->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="kode_mk" class="form-label">Kode Mata Kuliah</label>
                        <input type="text" id="kode_mk" class="form-control" name="kode_mk" value="{{ old('kode_mk', $mataKuliah->kode_mk) }}">
                      </div>

                      <div class="mb-3">
                        <label for="nama" class="form-label">Nama Mata Kuliah</label>
                        <input type="text" id="nama" class="form-control" name="nama" value="{{ old('nama', $mataKuliah->nama) }}">
                      </div>

                      <div class="mb-3">
                        <label for="prodi_id" class="form-label">Program Studi</label>
                        <select id="prodi_id" name="prodi_id" class="form-control">
                          @foreach ($prodi as $item)
                            <option value="{{ $item->id }}" {{ old('prodi_id', $mataKuliah->prodi_id) == $item->id ? 'selected' : '' }}>
                              {{ $item->nama }}
                            </option>
                          @endforeach
                        </select>
                        @error('prodi_id')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <!--end::Body-->

                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Footer-->
                  </form>

                  <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Row-->
@endsection
