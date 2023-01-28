<?php

namespace App\Http\Livewire;

use App\Models\PekerjaProyek as ModelsPekerjaProyek;
use App\Models\Proyek as ModelsProyek;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PekerjaProyek extends Component
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
        $data = ModelsProyek::where(function ($query) {
            $query->where('nip', Auth::user()->nip)
                ->orWhereHas('havePekerjaProyek', function ($query) {
                    $query->where('nip', Auth::user()->nip);
                });
        })
            ->with('getPegawai')
            ->orderBy('id', 'desc');

        if ($this->search) {
            $data->where(function ($query) {
                $query->where('kode_proyek', 'like', '%' . $this->search . '%')
                    ->orWhere('nama_proyek', 'like', '%' . $this->search . '%')
                    ->orWhere('tgl_mulai', 'like', '%' . $this->search . '%')
                    ->orWhere('tgl_selesai', 'like', '%' . $this->search . '%')
                    ->orWhere('tgl_dibuat', 'like', '%' . $this->search . '%')
                    ->orWhere('nama_mitra', 'like', '%' . $this->search . '%')
                    ->orWhereHas('getPegawai', function ($query) {
                        $query->where('nama', 'like', '%' . $this->search . '%');
                    });
            });
        }

        $data = $data->paginate(3)->withQueryString();
        return view('livewire.pekerja-proyek', [
            'data' => $data
        ]);
    }
}
