@extends('app')
@section('content')
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Tambah Data Customer
                <hr>
            </h3>
            <div class="card-body">
                <form action="/customer" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Nik</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="nik" type="text" placeholder="Type here" value="{{ old('nik') }}"
                            class="input-bordered input w-full max-w-full" />
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
                            <span class="label-text">Nama</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="nama" type="text" placeholder="Type here" value="{{ old('nama') }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('nama')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Alamat</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <textarea class="textarea-bordered textarea h-24" name="alamat" cols="30" placeholder="click here" rows="10">{{ old('alamat') }}</textarea>
                        {{-- <input name="alamat" type="text" placeholder="click here" value="{{ old('alamat') }}"
                            class="input-bordered input w-full max-w-full" /> --}}
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('alamat')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">No Telp</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="no_telp" type="number" placeholder="Type here" value="{{ old('no_telp') }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('no_telp')
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
