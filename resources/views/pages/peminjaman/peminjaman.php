<?php

use App\Models\items;
use App\Models\Loan;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    //
    use WithPagination;

    // ── Tab aktif: 'form' | 'riwayat'
    public string $activeTab = 'form';

    // ── Form tambah peminjaman
    public ?int    $item_id                  = null;
    public string  $nama_peminjam            = '';
    public int     $jumlah                   = 1;
    public string  $tanggal_pinjam           = '';
    public string  $tanggal_kembali_rencana  = '';
    public string  $keterangan               = '';

    // ── Pencarian barang di select
    public string  $searchItem               = '';

    // ── Info barang terpilih
    public ?array  $selectedItem             = null;

    // ── Pengembalian (modal)
    public bool    $showReturnModal          = false;
    public ?int    $returningLoanId          = null;
    public string  $tanggal_kembali_realisasi = '';
    public string  $returnKondisi            = '';

    // ── Filter riwayat
    public string  $filterStatus             = '';
    public string  $searchRiwayat            = '';

    // ────────────────────────────────────────
    // VALIDASI
    // ────────────────────────────────────────
    protected function rules(): array
    {
        return [
            'item_id'                 => 'required|exists:items,id',
            'nama_peminjam'           => 'required|string|max:150',
            'jumlah'                  => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    if ($this->selectedItem && $value > $this->selectedItem['stok']) {
                        $fail('Jumlah melebihi stok tersedia (' . $this->selectedItem['stok'] . ' unit).');
                    }
                },
            ],
            'tanggal_pinjam'          => 'required|date',
            'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
        ];
    }

    protected array $messages = [
        'item_id.required'                  => 'Pilih barang terlebih dahulu.',
        'nama_peminjam.required'            => 'Nama peminjam wajib diisi.',
        'jumlah.required'                   => 'Jumlah wajib diisi.',
        'jumlah.min'                        => 'Jumlah minimal 1.',
        'tanggal_pinjam.required'           => 'Tanggal pinjam wajib diisi.',
        'tanggal_kembali_rencana.required'  => 'Tanggal rencana kembali wajib diisi.',
        'tanggal_kembali_rencana.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
    ];

    protected function returnRules(): array
    {
        return [
            'tanggal_kembali_realisasi' => 'required|date',
        ];
    }

    // ────────────────────────────────────────
    // LIFECYCLE
    // ────────────────────────────────────────
    public function mount(): void
    {
        $this->tanggal_pinjam          = now()->format('Y-m-d');
        $this->tanggal_kembali_rencana = now()->addDays(7)->format('Y-m-d');
        $this->tanggal_kembali_realisasi = now()->format('Y-m-d');
    }

    public function updatedItemId($value): void
    {
        if ($value) {
            $item = items::with('category')->find($value);
            $this->selectedItem = $item ? [
                'id'          => $item->id,
                'nama_barang' => $item->nama_barang,
                'kode_barang' => $item->kode_barang,
                'stok'        => $item->stok,
                'kondisi'     => $item->kondisi,
                'kategori'    => $item->category?->name ?? '-',
            ] : null;
        } else {
            $this->selectedItem = null;
        }
        $this->resetValidation('jumlah');
    }
 
    // ────────────────────────────────────────
    // ACTIONS
    // ────────────────────────────────────────

    /** Simpan peminjaman baru */
    public function save(): void
    {
        // Refresh stok terbaru sebelum validasi
        if ($this->item_id) {
            $item = items::find($this->item_id);
            if ($item && $this->selectedItem) {
                $this->selectedItem['stok'] = $item->stok;
            }
        }

        $this->validate();

        Loan::create([
            'item_id'                 => $this->item_id,
            'nama_peminjam'           => $this->nama_peminjam,
            'jumlah'                  => $this->jumlah,
            'tanggal_pinjam'          => $this->tanggal_pinjam,
            'tanggal_kembali_rencana' => $this->tanggal_kembali_rencana,
            'status'                  => 'dipinjam',
        ]);

        // Kurangi stok
        items::find($this->item_id)->decrement('stok', $this->jumlah);

        session()->flash('success', 'Peminjaman berhasil dicatat. Stok telah dikurangi.');

        $this->resetForm();
        $this->activeTab = 'riwayat';
        $this->resetPage();
    }

    /** Buka modal pengembalian */
    public function openReturnModal(int $loanId): void
    {
        $this->returningLoanId          = $loanId;
        $this->tanggal_kembali_realisasi = now()->format('Y-m-d');
        $this->returnKondisi            = '';
        $this->showReturnModal          = true;
    }

    /** Tutup modal */
    public function closeReturnModal(): void
    {
        $this->showReturnModal = false;
        $this->returningLoanId = null;
        $this->resetValidation();
    }

    /** Konfirmasi pengembalian */
    public function confirmReturn(): void
    {
        $this->validateOnly('tanggal_kembali_realisasi', $this->returnRules());

        $loan = Loan::with('item')->findOrFail($this->returningLoanId);

        $loan->update([
            'tanggal_kembali_realisasi' => $this->tanggal_kembali_realisasi,
            'status'                    => 'kembali',
        ]);

        // Kembalikan stok
        $loan->item->increment('stok', $loan->jumlah);

        session()->flash('success', 'Pengembalian berhasil dicatat. Stok telah ditambahkan kembali.');

        $this->closeReturnModal();
    }

    /** Reset form input */
    private function resetForm(): void
    {
        $this->reset([
            'item_id',
            'nama_peminjam',
            'jumlah',
            'keterangan',
            'selectedItem',
            'searchItem',
        ]);
        $this->tanggal_pinjam          = now()->format('Y-m-d');
        $this->tanggal_kembali_rencana = now()->addDays(7)->format('Y-m-d');
        $this->resetValidation();
    }

    // ────────────────────────────────────────
    // RENDER
    // ────────────────────────────────────────
    public function render()
    {
        // Daftar barang untuk select (stok > 0 diprioritaskan)
        $itemList = items::with('category')
            ->when(trim($this->searchItem), fn($q) => $q
                ->where('nama_barang', 'like', '%' . $this->searchItem . '%')
                ->orWhere('kode_barang', 'like', '%' . $this->searchItem . '%'))
            ->orderByRaw('stok = 0 ASC')
            ->orderBy('nama_barang')
            ->get();

        // Riwayat peminjaman dengan filter
        $riwayat = Loan::with('item.category')
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->when(trim($this->searchRiwayat), fn($q) => $q
                ->where('nama_peminjam', 'like', '%' . $this->searchRiwayat . '%')
                ->orWhereHas('item', fn($q2) => $q2
                    ->where('nama_barang', 'like', '%' . $this->searchRiwayat . '%')))
            ->latest('tanggal_pinjam')
            ->paginate(8);

        // Statistik
        $totalDipinjam    = Loan::where('status', 'dipinjam')->count();
        $totalDikembalikan = Loan::where('status', 'kembali')->count();
        $terlambat        = Loan::where('status', 'dipinjam')
            ->where('tanggal_kembali_rencana', '<', today())
            ->count();

        // Peminjaman aktif terbaru (sidebar)
        $peminjamanAktif = Loan::with('item')
            ->where('status', 'dipinjam')
            ->latest('tanggal_pinjam')
            ->take(5)
            ->get();

        return view('pages::peminjaman.peminjaman', compact(
            'itemList',
            'riwayat',
            'totalDipinjam',
            'totalDikembalikan',
            'terlambat',
            'peminjamanAktif',
        ));
    }
};
