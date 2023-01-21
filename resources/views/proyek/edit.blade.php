@extends('app')
@section('content')
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Ubah Data Proyek
                <hr>
            </h3>
            <div class="card-body">
                <form action="/proyek/{{ $item->kode_proyek }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Nama Proyek</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="nama_proyek" type="text" placeholder="Type here"
                            value="{{ old('nama_proyek', $item->nama_proyek) }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('nama_proyek')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Penanggung Jawab</span>
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
                                @error('nik')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Tanggal Mulai</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="tgl_mulai" type="date" placeholder="Type here"
                            value="{{ old('tgl_mulai', $item->tgl_mulai) }}"
                            class="datepicker input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('tgl_mulai')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Tanggal Selesai</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="tgl_selesai" type="date" placeholder="Type here"
                            value="{{ old('tgl_selesai', $item->tgl_selesai) }}"
                            class="datepicker input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('tgl_selesai')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Tanggal Dibuat</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="tgl_dibuat" type="date" placeholder="Type here"
                            value="{{ old('tgl_dibuat', $item->tgl_dibuat) }}"
                            class="datepicker input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('tgl_dibuat')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Nama Mitra</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="nama_mitra" type="text" placeholder="Type here"
                            value="{{ old('nama_mitra', $item->nama_mitra) }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('nama_mitra')
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
