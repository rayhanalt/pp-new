@extends('app')
@section('content')
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Tambah Data Customer
                <hr>
            </h3>
            <div class="card-body">
                <form action="/pegawai" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">NIP</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="nip" type="text" placeholder="Type here" value="{{ old('nip') }}"
                            class="input-bordered input w-full max-w-full" />
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
                            <span class="label-text">Password</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="password" type="text" placeholder="" value="12345"
                            class="input-bordered input w-full max-w-full" readonly />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                You can change it by your self when loged in
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Jabatan</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <select class="select-bordered select" name="jabatan">
                            <option disabled selected>Pick one</option>
                            <option value="admin">Admin</option>
                            <option value="manajer">Manajer</option>
                            <option value="staff">Staff</option>

                        </select>
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('jabatan')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Bidang</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <select class="select-bordered select" name="kode_bidang">
                            <option disabled selected>Pick one</option>
                            @foreach ($getBidang as $bidang)
                                <option value="{{ $bidang->kode_bidang }}"
                                    {{ old('kode_bidang') == $bidang->kode_bidang ? 'selected' : '' }}>
                                    {{ $bidang->nama_bidang }} | {{ $bidang->kode_bidang }}</option>
                            @endforeach
                        </select>
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('kode_bidang')
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
