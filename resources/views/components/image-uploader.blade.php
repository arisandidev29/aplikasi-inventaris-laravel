{{--
    Komponen reusable image uploader untuk form Livewire.

    Cara pakai di blade Livewire:
    <x-image-uploader
        :current-image="$image_url"
        wire-model="photo"
        label="Foto Barang"
    />

    Props:
    - current-image  : URL gambar yang sudah ada (untuk mode edit)
    - wire-model     : nama property Livewire (biasanya 'photo')
    - label          : label yang ditampilkan (opsional)
--}}

@props([
    'currentImage' => null,
    'wireModel' => 'photo',
    'label' => 'Foto Barang',
])

<div x-data="{
    preview: @js($currentImage),
    hasExisting: @js(!empty($currentImage)),
    isDragging: false,
    handleFile(file) {
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => { this.preview = e.target.result; };
        reader.readAsDataURL(file);
    }
}" x-on:livewire-upload-finish="handleFile($refs.fileInput?.files[0])">
    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 px-2 italic">
        {{ $label }} <span class="text-slate-700 normal-case font-medium">(opsional, maks. 2MB)</span>
    </label>

    {{-- Drop Zone / Preview --}}
    <div class="relative w-full rounded-2xl border-2 transition-all overflow-hidden"
        :class="isDragging
            ?
            'border-blue-500 bg-blue-600/10' :
            (preview ? 'border-slate-700 bg-slate-950' :
                'border-dashed border-slate-700 bg-slate-950 hover:border-blue-600/50')"
        x-on:dragover.prevent="isDragging = true" x-on:dragleave.prevent="isDragging = false"
        x-on:drop.prevent="isDragging = false; handleFile($event.dataTransfer.files[0]); $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change'))">
        {{-- Preview gambar --}}
        <template x-if="preview">
            <div class="relative group">
                <img :src="preview" alt="Preview" class="w-full h-56 object-cover rounded-2xl">

                {{-- Overlay saat hover --}}
                <div
                    class="absolute inset-0 bg-slate-950/70 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center gap-3">
                    {{-- Tombol ganti --}}
                    <button type="button" @click="$refs.fileInput.click()"
                        class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black rounded-xl uppercase tracking-widest transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Ganti
                    </button>
                    {{-- Tombol hapus --}}
                    <button type="button"
                        @click="preview = null; hasExisting = false; $refs.fileInput.value = ''; $wire.set('{{ $wireModel }}', null); $wire.set('image_url', null)"
                        class="flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-500 text-white text-[10px] font-black rounded-xl uppercase tracking-widest transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
        </template>

        {{-- Empty state --}}
        <template x-if="!preview">
            <div class="flex flex-col items-center justify-center py-12 px-6 cursor-pointer"
                @click="$refs.fileInput.click()">
                <div
                    class="w-14 h-14 rounded-2xl bg-slate-800 flex items-center justify-center text-slate-600 mb-4 group-hover:text-blue-500 transition-colors">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-xs font-black text-slate-500 uppercase tracking-widest italic mb-1">Klik atau seret
                    gambar ke sini</p>
                <p class="text-[10px] text-slate-700 font-bold">JPG, PNG, WebP • Maks. 2MB</p>
            </div>
        </template>

        {{-- Upload progress --}}
        <div wire:loading wire:target="{{ $wireModel }}"
            class="absolute inset-0 bg-slate-950/80 rounded-2xl flex flex-col items-center justify-center gap-3">
            <svg class="w-8 h-8 text-blue-500 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Mengupload...</p>
        </div>
    </div>

    {{-- Hidden file input --}}
    <input x-ref="fileInput" type="file" wire:model="{{ $wireModel }}"
        accept="image/jpg,image/jpeg,image/png,image/webp" class="hidden" @change="handleFile($event.target.files[0])">

    {{-- Error --}}
    @error($wireModel)
        <p class="mt-2 text-xs text-red-400 font-bold px-2">{{ $message }}</p>
    @enderror
</div>
