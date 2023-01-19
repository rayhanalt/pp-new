<div>
    <div class="fixed top-[72px] bottom-2 right-2 left-2 flex flex-grow justify-between">
        <div>
            <a href="/denda/create" class="btn-outline btn-success btn-sm btn">➕ Data</a>
        </div>
        <div>
            @include('layout.notif')
        </div>
        <div>
            <input wire:model="search" type="text" class="input-info input input-sm"
                placeholder="Search, if date: 'Y-m-d'">
        </div>
    </div>
    <table class="table-compact mt-10 table w-full">
        <!-- head -->
        <thead>
            <tr>
                <th></th>
                {{-- <th>Kode</th> --}}
                <th>Kode Denda</th>
                <th>Data Rental</th>
                <th>Tanggal Kembali</th>
                <th>Tanggal Denda</th>
                <th>Jumlah Denda</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th>{{ $loop->iteration + $data->FirstItem() - 1 }}</th>
                    {{-- <td>{{ $item->kode_mobil }}</td> --}}
                    <td>{{ $item->kode_denda }}</td>
                    <td>
                        <ul>
                            <li>{{ $item->getRental->getMobil->nopol }}</li>
                            <li>{{ $item->getRental->getMobil->model }}</li>
                            <li>{{ $item->getRental->getCustomer->nama }}</li>
                            <li>{{ 'Rp. ' . number_format($item->getRental->getMobil->harga_sewa, 0, ',', '.') }}</li>
                        </ul>
                    </td>
                    <td>{{ date('d F Y', strtotime($item->getRental->tanggal_kembali)) }}</td>
                    <td>{{ date('d F Y', strtotime($item->tanggal_denda)) }}</td>
                    <td>{{ 'Rp. ' . number_format($item->jumlah_denda, 0, ',', '.') }}</td>
                    <td>
                        <a href="/denda/{{ $item->kode_denda }}/edit" class="btn-outline btn-accent btn-sm btn mb-1">
                            ✎
                        </a>
                        <form action="/denda/{{ $item->kode_denda }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn-outline btn-error btn-sm btn"
                                onclick="return confirm('yakin hapus data {{ $item->kode_denda }} ?')">
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
