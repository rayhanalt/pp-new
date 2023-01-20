<?php

namespace App\Http\Livewire;

use App\Models\PengadaanBarang;
use Livewire\Component;
use Livewire\WithPagination;

class Barang extends Component
{
    use WithPagination;
    public $search;
    public $page = 1;
    protected $updatesQueryString = [
        ['page' => ['except' => 1]],
        ['search' => ['except' => '']],
    ];
    public function render()
    {
        return view('livewire.denda', [
            'data' => $this->search === null ?
                PengadaanBarang::orderBy('id', 'desc')->Paginate(3)->withQueryString() :
                PengadaanBarang::orderBy('id', 'desc')->where('kode_denda', 'like', '%' . $this->search . '%')
                ->orWhere('kode_rental', 'like', '%' . $this->search . '%')
                ->orWhere('tanggal_denda', 'like', '%' . $this->search . '%')
                ->orWhere('jumlah_denda', 'like', '%' . $this->search . '%')
                ->paginate(3)->withQueryString()
        ]);
    }
}
