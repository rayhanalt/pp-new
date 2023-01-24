@extends('app')
@section('content')
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Tambah Data Tim Proyek
                <hr>
            </h3>
            <div class="card-body">
                <form action="/pekerjaProyek" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Proyek</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <select class="select-bordered select" id="kode_proyek" name="kode_proyek">
                            <option disabled selected>Pick one</option>
                            @foreach ($getProyek as $proyek)
                                <option value="{{ $proyek->kode_proyek }}"
                                    {{ old('kode_proyek') == $proyek->kode_proyek ? 'selected' : '' }}>
                                    {{ $proyek->nama_proyek }} | {{ $proyek->kode_proyek }}</option>
                            @endforeach
                        </select>
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('nip')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Tim Proyek</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <select class="select-bordered select" id="nip" name="nip">
                            <option disabled selected>Pick one</option>
                            @foreach ($getPegawai as $pegawai)
                                <option value="{{ $pegawai->nip }}" {{ old('nip') == $pegawai->nip ? 'selected' : '' }}>
                                    {{ $pegawai->nama }} | {{ $pegawai->nip }}</option>
                            @endforeach
                        </select>
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('nip')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="card-actions justify-end">
                        <button type="submit" class="btn-error btn">Reset</button>
                        <button type="submit"class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
