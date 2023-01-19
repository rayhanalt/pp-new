@extends('app')
@section('content')
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Ubah Data Mobil
                <hr>
            </h3>
            <div class="card-body">
                <form action="/mobil/{{ $item->kode_mobil }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Nopol</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="nopol" type="text" placeholder="Type here"
                            value="{{ old('nopol', $item->nopol) }}" class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('nopol')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Merk</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="merk" type="text" placeholder="Type here" value="{{ old('merk', $item->merk) }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('merk')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Model</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="model" type="text" placeholder="click here"
                            value="{{ old('model', $item->model) }}" class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('model')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Tahun</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="tahun" type="date" placeholder="Type here"
                            value="{{ old('tahun', $item->tahun) }}"
                            class="datepicker input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('tahun')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Warna</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="warna" type="text" placeholder="Type here"
                            value="{{ old('warna', $item->warna) }}" class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('warna')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Harga Sewa</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="harga_sewa" id="harga_sewa" type="text" placeholder="Type here"
                            value="{{ old('harga_sewa', $item->harga_sewa) }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('harga_sewa')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Gambar</span>
                            <span class="label-text-alt"><img
                                    src="@if ($item->gambar) {{ asset('gambar/' . $item->gambar) }} @else # @endif"
                                    alt="Preview Gambar" id="preview-gambar" width="100px"></span>
                        </label>
                        <input name="gambar" type="file" value="{{ old('gambar') }}" id="gambar" accept="image/*"
                            class="file-input-bordered file-input w-full max-w-full" />

                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-500">
                                @error('gambar')
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
