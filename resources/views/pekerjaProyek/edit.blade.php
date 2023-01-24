@extends('app')
@section('content')
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Ubah Data Pekerja Proyek
                <hr>
            </h3>
            <div class="card-body">
                <form action="/pekerjaProyek/{{ $item->kode_pekerja_proyek }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Proyek</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <select class="select-bordered select" name="kode_proyek">
                            <option disabled selected>Pick one</option>
                            @foreach ($getProyek as $proyek)
                                <option value="{{ $proyek->kode_proyek }}" @if ($proyek->kode_proyek == $item->kode_proyek) selected @endif
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
                        <select class="select-bordered select" name="nip">
                            <option disabled selected>Pick one</option>
                            @foreach ($getPegawai as $pegawai)
                                <option {{ old('nip') == $pegawai->nip ? 'selected' : '' }}
                                    @if ($pegawai->nip == $item->nip) selected @endif value="{{ $pegawai->nip }}">
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
