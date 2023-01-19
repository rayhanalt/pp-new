<div>
    <div class="fixed top-[72px] bottom-2 right-2 left-2 flex flex-grow justify-between">
        <div>
            <a href="/mobil/create" class="btn-outline btn-success btn-sm btn">➕ Data</a>
        </div>
        <div>
            @include('layout.notif')
        </div>
        <div>
            <input wire:model="search" type="text" class="input-info input input-sm"
                placeholder="Search, if date: 'Y-m-d'">
        </div>
    </div>
    <table class="mt-10 table w-full">
        <!-- head -->
        <thead>
            <tr>
                <th></th>
                {{-- <th>Kode</th> --}}
                <th>Nopol</th>
                <th>Merk</th>
                <th>Model</th>
                <th>Tahun</th>
                <th>Warna</th>
                <th>Harga Sewa</th>
                <th>gambar</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th>{{ $loop->iteration + $data->FirstItem() - 1 }}</th>
                    {{-- <td>{{ $item->kode_mobil }}</td> --}}
                    <td>{{ $item->nopol }}</td>
                    <td>{{ $item->merk }}</td>
                    <td>{{ $item->model }}</td>
                    <td>{{ date('d F Y', strtotime($item->tahun)) }}</td>
                    <td>{{ $item->warna }}</td>
                    <td>{{ 'Rp. ' . number_format($item->harga_sewa, 0, ',', '.') }}</td>
                    <td><img src="{{ asset('gambar/' . $item->gambar) }}" width="70px"></td>
                    <td>
                        <a href="/mobil/{{ $item->kode_mobil }}/edit" class="btn-outline btn-accent btn-sm btn mb-1">
                            ✎
                        </a>
                        <form action="/mobil/{{ $item->kode_mobil }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn-outline btn-error btn-sm btn"
                                onclick="return confirm('yakin hapus data {{ $item->nopol }} ?')">
                                🗑
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="fixed bottom-28 left-0 right-0">
        <div class="btn-group mx-auto grid w-fit grid-cols-2">
            <button wire:click="previousPage" @if ($data->onFirstPage()) disabled @endif
                class="btn-outline btn-sm btn">previous</button>

            <button wire:click="nextPage" @if (!$data->hasMorePages()) disabled @endif
                class="btn-outline btn-sm btn">next</button>
        </div>
    </div>
</div>
