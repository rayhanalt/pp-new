<?php

namespace App\Http\Livewire;

use App\Models\Proyek as ModelsProyek;
use Livewire\Component;
use Livewire\WithPagination;

class Proyek extends Component
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
        return view('livewire.rental', [
            'data' => $this->search === null ?
                ModelsProyek::with('getMobil', 'getCustomer')->orderBy('id', 'desc')->Paginate(3)->withQueryString() :
                ModelsProyek::with('getMobil', 'getCustomer')->orderBy('id', 'desc')
                ->where('kode_rental', 'like', '%' . $this->search . '%')
                ->orWhere('nik', 'like', '%' . $this->search . '%')
                ->orWhere('nopol', 'like', '%' . $this->search . '%')
                ->orWhere('tanggal_rental', 'like', '%' . $this->search . '%')
                ->orWhere('tanggal_kembali', 'like', '%' . $this->search . '%')
                ->orWhere('durasi', 'like', '%' . $this->search . '%')
                ->orWhere('total_harga', 'like', '%' . $this->search . '%')
                ->paginate(3)->withQueryString()
        ]);
    }
}
