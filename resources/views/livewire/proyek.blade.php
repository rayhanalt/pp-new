<div>
    <div class="fixed top-[72px] bottom-2 right-2 left-2 flex flex-grow justify-between">
        <div>
            <a href="/rental/create" class="btn-outline btn-success btn-sm btn">➕ Data</a>
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
                <th>Kode Rental</th>
                <th>Customer</th>
                <th>Nopol Mobil</th>
                <th>Tanggal Rental</th>
                <th>Tanggal Kembali</th>
                <th>Durasi</th>
                <th>Total Harga</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th>{{ $loop->iteration + $data->FirstItem() - 1 }}</th>
                    {{-- <td>{{ $item->kode_mobil }}</td> --}}
                    <td>{{ $item->kode_rental }}</td>
                    <td>{{ $item->getCustomer->nama }}</td>
                    <td>{{ $item->nopol }}</td>
                    <td>{{ date('d F Y', strtotime($item->tanggal_rental)) }}</td>
                    <td>{{ date('d F Y', strtotime($item->tanggal_kembali)) }}</td>
                    <td>{{ $item->durasi }} Hari</td>
                    <td>{{ 'Rp. ' . number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <a href="/rental/{{ $item->kode_rental }}/edit" class="btn-outline btn-accent btn-sm btn mb-1">
                            ✎
                        </a>
                        <form action="/rental/{{ $item->kode_rental }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn-outline btn-error btn-sm btn"
                                onclick="return confirm('yakin hapus data {{ $item->kode_rental }} ?')">
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
