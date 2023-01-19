<?php

namespace App\Http\Livewire;

use App\Models\Mobil as ModelsMobil;
use Livewire\Component;
use Livewire\WithPagination;

class Mobil extends Component
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
        return view('livewire.mobil', [
            'data' => $this->search === null ?
                ModelsMobil::orderBy('id', 'desc')->Paginate(3)->withQueryString() :
                ModelsMobil::orderBy('id', 'desc')->where('nopol', 'like', '%' . $this->search . '%')
                ->orWhere('merk', 'like', '%' . $this->search . '%')
                ->orWhere('model', 'like', '%' . $this->search . '%')
                ->orWhere('tahun', 'like', '%' . $this->search . '%')
                ->orWhere('warna', 'like', '%' . $this->search . '%')
                ->orWhere('harga_sewa', 'like', '%' . $this->search . '%')
                ->paginate(3)->withQueryString()
        ]);
    }
}
