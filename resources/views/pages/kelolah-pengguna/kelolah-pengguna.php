<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
       use WithPagination;
 
    // State modal
    public bool $modalTambah   = false;
    public bool $modalEdit     = false;
    public bool $modalHapus    = false;
    public bool $modalReset    = false;
 
    // Form fields
    public string $name     = '';
    public string $email    = '';
    public string $password = '';
    public string $role     = 'admin';
 
    // Target user
    public ?int $userId    = null;
    public string $userName = '';
 
    // Search & filter
    public string $search   = '';
    public string $filterRole = '';
 
    // Notifikasi — ditangani via Alpine event (notify-success)
 
    protected function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', Rule::unique('users', 'email')->ignore($this->userId)],
            'password' => $this->modalTambah ? ['required', 'min:8'] : ['nullable', 'min:8'],
            'role'     => ['required', 'in:superadmin,admin'],
        ];
    }
 
    protected array $messages = [
        'name.required'     => 'Nama wajib diisi.',
        'email.required'    => 'Email wajib diisi.',
        'email.email'       => 'Format email tidak valid.',
        'email.unique'      => 'Email sudah digunakan.',
        'password.required' => 'Password wajib diisi untuk user baru.',
        'password.min'      => 'Password minimal 8 karakter.',
        'role.required'     => 'Role wajib dipilih.',
    ];
 
    public function updatingSearch(): void
    {
        $this->resetPage();
    }
 
    public function updatingFilterRole(): void
    {
        $this->resetPage();
    }
 
    // ── TAMBAH ──────────────────────────────────────────
    public function bukaTambah(): void
    {
        $this->resetForm();
        $this->modalTambah = true;
    }
 
    public function simpanTambah(): void
    {
        $this->validate();
        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'role'     => $this->role,
        ]);



 
        $this->modalTambah = false;
        $this->resetForm();
        $this->dispatch('notify-success', message: 'Pengguna berhasil ditambahkan.');
    }
 
    // ── EDIT ─────────────────────────────────────────────
    public function bukaEdit(int $id): void
    {
        $user           = User::findOrFail($id);
        $this->userId   = $user->id;
        $this->name     = $user->name;
        $this->email    = $user->email;
        $this->role     = $user->role;
        $this->password = '';
        $this->modalEdit = true;
    }
 
    public function simpanEdit(): void
    {
        $this->validate();

        // dd($this->role);
 
        $user = User::findOrFail($this->userId);
        $data = [
            'name'  => $this->name,
            'email' => $this->email,
            'role'  => $this->role,
        ];
 
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }
 
        $user->update($data);
 
        $this->modalEdit = false;
        $this->resetForm();
        $this->dispatch('notify-success', message: 'Data pengguna berhasil diperbarui.');
    }
 
    // ── HAPUS ─────────────────────────────────────────────
    public function bukaHapus(int $id): void
    {
        $user           = User::findOrFail($id);
        $this->userId   = $user->id;
        $this->userName = $user->name;
        $this->modalHapus = true;
    }
 
    public function hapus(): void
    {
        // Jangan hapus diri sendiri
        if ($this->userId === auth()->id()) {
            $this->modalHapus     = false;
            $this->successMessage = null;
            session()->flash('error', 'Tidak dapat menghapus akun Anda sendiri.');
            return;
        }
 
        User::findOrFail($this->userId)->delete();
 
        $this->modalHapus = false;
        $this->resetForm();
        $this->dispatch('notify-success', message: "Pengguna \"{$this->userName}\" berhasil dihapus.");
    }
 
    // ── RESET PASSWORD ────────────────────────────────────
    public function bukaReset(int $id): void
    {
        $user           = User::findOrFail($id);
        $this->userId   = $user->id;
        $this->userName = $user->name;
        $this->modalReset = true;
    }
 
    public function kirimReset(): void
    {
        $user = User::findOrFail($this->userId);
        Password::sendResetLink(['email' => $user->email]);
 
        $this->modalReset = false;
        $this->dispatch('notify-success', message: "Link reset password telah dikirim ke email \"{$this->userName}\".");
    }
 
    // ── HELPERS ───────────────────────────────────────────
    private function resetForm(): void
    {
        $this->userId   = null;
        $this->name     = '';
        $this->email    = '';
        $this->password = '';
        $this->role     = 'admin';
        $this->userName = '';
        $this->resetValidation();
    }
 
    public function tutupModal(): void
    {
        $this->modalTambah = false;
        $this->modalEdit   = false;
        $this->modalHapus  = false;
        $this->modalReset  = false;
        $this->resetForm();
    }
 
    public function render()
    {
        // Hanya superadmin yang boleh akses
        abort_unless(auth()->user()->isSuperAdmin(), 403);
 
        $users = User::query()
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%")
            )
            ->when($this->filterRole, fn($q) =>
                $q->where('role', $this->filterRole)
            )
            ->latest()
            ->paginate(10);
 
        return view('pages::kelolah-pengguna.kelolah-pengguna', compact('users'));
    }

};
