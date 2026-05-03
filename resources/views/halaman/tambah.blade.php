@extends('layouts.app')

@section('title', 'Tambah Pegawai Baru | PayTato')

@section('content')
<div class="max-w-4xl mx-auto" x-data="{ step: 1 }">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('users.index') }}" class="w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-orange-600 transition-all shadow-sm">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-xl font-black text-slate-900 uppercase italic tracking-tighter">Registrasi teknisi Baru</h1>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sistem Manajemen Bengkel PayTato</p>
        </div>
    </div>

    <div class="flex gap-4 mb-6">
        <div class="flex-1 h-2 rounded-full overflow-hidden bg-slate-200">
            <div class="h-full bg-orange-600 transition-all duration-500" :style="step === 1 ? 'width: 50%' : 'width: 100%'"></div>
        </div>
    </div>


        {{-- Notifikasi Error --}}
        @if (session('error'))
            <div class="bg-red-600 text-white p-4 rounded-2xl mb-6 font-bold text-xs uppercase tracking-widest shadow-lg shadow-red-900/20 flex items-center gap-3">
                <i class="fas fa-exclamation-triangle text-lg"></i>
                <span>❌ {{ session('error') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-2xl mb-6 font-bold text-xs uppercase tracking-widest">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div x-show="step === 1" x-transition>
            <div class="bg-white rounded-[40px] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-10">
                    <h3 class="text-[10px] font-black text-orange-600 uppercase tracking-[0.3em] italic mb-8 flex items-center gap-2">
                        <i class="fas fa-lock"></i> Step 01: Informasi Akun & Akses
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">NIP (Nomor Induk Pegawai)</label>
                            <input type="text" id="nipInput" name="nip" 
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 transition-all outline-none" 
                                placeholder="Contoh: 123456" required>
                            
                            <!-- Pesan Validasi NIP -->
                            <p id="nipStatus" class="text-[9px] font-bold uppercase tracking-widest ml-4 hidden">
                                <span id="nipIcon">⚠️</span> <span id="nipText">Minimal 6 Digit</span>
                            </p>
                        </div>

                        <div class="space-y-2">
    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Kata Sandi</label>
    <input type="password" id="passwordInput" name="kata_sandi" 
        class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 transition-all outline-none" 
        placeholder="Masukkan kata sandi">

    <!-- Container Feedback dari kamu -->
    <div id="passwordFeedback" class="mt-3 ml-2 opacity-0 transition-all duration-300 hidden">
        <ul id="passwordError" class="space-y-1">
            <li id="reqLen" class="text-[11px] text-red-500 flex items-center gap-2 transition-colors italic">
                <span>•</span> Minimal 8 karakter
            </li>
            <li id="reqUpper" class="text-[11px] text-red-500 flex items-center gap-2 transition-colors italic">
                <span>•</span> Minimal 1 huruf besar
            </li>
            <li id="reqNum" class="text-[11px] text-red-500 flex items-center gap-2 transition-colors italic">
                <span>•</span> Minimal 1 angka
            </li>
        </ul>
        <!-- Teks Valid -->
        <p id="pwValidText" class="hidden text-[11px] font-bold text-green-500 italic">✓ Password Valid</p>
    </div>
</div>

                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Alamat Email</label>
                            <input type="email" id="emailInput" name="email" 
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 transition-all outline-none" 
                                placeholder="Contoh : example@gmail.com" required>
                            
                            <!-- Pesan Validasi -->
                            <p id="emailStatus" class="text-[9px] font-bold uppercase tracking-widest ml-4 hidden">
                                <span id="statusIcon">⚠️</span> <span id="statusText">Wajib menggunakan @gmail.com</span>
                            </p>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Foto Profil Resmi</label>
                            <input type="file" id="fotoInput" name="foto" accept="image/*"
                                class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-orange-50 file:text-orange-600 hover:file:bg-orange-100 cursor-pointer">
                            
                            <p id="fotoStatus" class="text-[11px] font-bold uppercase tracking-widest ml-4 hidden">
                                <span id="fotoIcon"></span> <span id="fotoText"></span>
                            </p>
                        </div>
                    </div>

                    

                    <div class="mt-10 flex justify-end">
                        <button type="button" @click="step = 2" class="bg-slate-900 text-white px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl hover:bg-orange-600 transition-all italic flex items-center gap-3">
                            Lanjut Ke Profil <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="step === 2" x-transition>
            <div class="bg-white rounded-[40px] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-10">
                    <h3 class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em] italic mb-8 flex items-center gap-2">
                        <i class="fas fa-user-gear"></i> Step 02: Detail Profil & Pegawai
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Nama Lengkap Sesuai KTP</label>
                            <input type="text" name="nama_lengkap" 
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-black text-slate-900 focus:ring-2 focus:ring-blue-500 transition-all uppercase italic" 
                                placeholder="Contoh : Antono Antini " required>
                        </div>

                        <!-- Kolom Jenis Kelamin -->
                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Jenis Kelamin</label>
                            <select name="jenis_kelamin" 
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-black text-slate-900 focus:ring-2 focus:ring-blue-500 transition-all italic" required>
                                <option value="" disabled selected>PILIH...</option>
                                <option value="L">LAKI-LAKI</option>
                                <option value="P">PEREMPUAN</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Divisi / Departemen</label>
                            <select name="id_divisi" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 transition-all italic" required>
                                <option value="" disabled selected>-- Pilih Divisi --</option>
                                @foreach($list_divisi as $divisi)
                                    <option value="{{ $divisi->id }}">{{ $divisi->nama_divisi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Jabatan</label>
                            <input type="text" name="jabatan" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 transition-all italic" placeholder="Contoh : Senior Mechanic">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Nomor Telepon(Whatsapp)</label>
                            <input type="text" name="nomor_telepon" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Contoh : 08123456789">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Nomor NIK (Kependudukan)</label>
                            <input type="text" name="nik" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Contoh : 123*************">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Agama</label>
                            <input type="text" name="agama" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Contoh : Islam / Kristen / Katholik">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Tempat & Tanggal Lahir</label>
                            <div class="flex gap-2 bg-slate-50 rounded-2xl p-2 focus-within:ring-2 focus-within:ring-blue-500 transition-all">
                                <!-- Input Tempat -->
                                <input type="text" name="tempat_lahir" 
                                    class="flex-[2] bg-transparent border-none px-4 py-2 text-sm font-bold text-slate-800 focus:ring-0 uppercase italic" 
                                    placeholder="Contoh: BINJAI" required>
                                
                                <!-- Garis Pemisah Kecil -->
                                <div class="w-px h-8 bg-slate-200 my-auto"></div>

                                <!-- Input Tanggal -->
                                <input type="date" name="tanggal_lahir" 
                                    class="flex-1 bg-transparent border-none px-4 py-2 text-sm font-bold text-slate-800 focus:ring-0 cursor-pointer" 
                                    required>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Contoh : SMK Otomotif / S1 Manajemen /  D3 Tata Boga">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Status Kerja</label>
                            <select name="status_kerja" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 transition-all italic" required>
                                <option value="" disabled selected>-- Pilih Status --</option>
                                <option value="Tetap">Tetap</option>
                                <option value="Kontrak">Kontrak</option>
                                <option value="Magang">Magang</option>
                                <option value="PKL">PKL</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-10 flex justify-between gap-4">
                        <button type="button" @click="step = 1" class="bg-slate-100 text-slate-500 px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-200 transition-all italic flex items-center gap-3">
                            <i class="fas fa-chevron-left"></i> Kembali
                        </button>
                        
                        <button type="submit" class="flex-1 bg-orange-600 text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-orange-900/20 hover:bg-slate-900 transition-all italic flex items-center justify-center gap-3">
                            <i class="fas fa-save"></i> Simpan Data Pegawai Baru
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    window.onload = function() {
        // 1. Definisi Element Email
        const emailInput = document.getElementById('emailInput');
        const emailStatus = document.getElementById('emailStatus');
        const statusText = document.getElementById('statusText');
        const statusIcon = document.getElementById('statusIcon');

        // 2. Definisi Element Password
        const pwInput = document.getElementById('passwordInput');
        const pwFeedback = document.getElementById('passwordFeedback');
        const pwErrorList = document.getElementById('passwordError');
        const pwValidText = document.getElementById('pwValidText');
        const reqLen = document.getElementById('reqLen');
        const reqUpper = document.getElementById('reqUpper');
        const reqNum = document.getElementById('reqNum');

        // 3. Definisi Element NIP (Tadi ini yang kurang)
        const nipInput = document.getElementById('nipInput');
        const nipStatus = document.getElementById('nipStatus');
        const nipText = document.getElementById('nipText');
        const nipIcon = document.getElementById('nipIcon');

        const fotoInput = document.getElementById('fotoInput');
        const fotoStatus = document.getElementById('fotoStatus');
        const fotoText = document.getElementById('fotoText');
        const fotoIcon = document.getElementById('fotoIcon');

        fotoInput.addEventListener('change', function() {
            const file = this.files[0];
            
            if (file) {
                fotoStatus.classList.remove('hidden');
                const fileSizeMB = file.size / (1024 * 1024);

                if (fileSizeMB > 2) {
                    // JIKA GAGAL
                    fotoStatus.style.color = "#ef4444"; // Merah
                    fotoIcon.innerText = "⚠️ "; // Munculkan ikon danger
                    fotoText.innerText = "Ukuran file " + fileSizeMB.toFixed(2) + "MB (Maks 2MB)";
                    this.value = ""; 
                } else {
                    // JIKA BERHASIL
                    fotoStatus.style.color = "#22c55e"; // Hijau
                    fotoIcon.innerText = "✓"; // KOSONGKAN IKON (Sesuai request kamu)
                    fotoText.innerText = "Ukuran file sesuai!";
                }
            } else {
                fotoStatus.classList.add('hidden');
            }
        });

        // --- FUNGSI PEMBANTU PASSWORD ---
        function updateStatus(el, isValid) {
            if (isValid) {
                el.style.color = "#22c55e"; // Hijau
                el.querySelector('span').innerText = '✓';
            } else {
                el.style.color = "#ef4444"; // Merah
                el.querySelector('span').innerText = '•';
            }
        }

        // --- LOGIKA VALIDASI ---

        function validasiPassword() {
            const val = pwInput.value;
            pwFeedback.classList.remove('hidden');
            setTimeout(() => pwFeedback.classList.add('opacity-100'), 10);

            const isLenOk = val.length >= 8;
            const isUpperOk = /[A-Z]/.test(val);
            const isNumOk = /[0-9]/.test(val);

            updateStatus(reqLen, isLenOk);
            updateStatus(reqUpper, isUpperOk);
            updateStatus(reqNum, isNumOk);

            if (isLenOk && isUpperOk && isNumOk) {
                pwErrorList.classList.add('hidden');
                pwValidText.classList.remove('hidden');
                pwInput.style.boxShadow = "0 0 0 2px #22c55e";
            } else {
                pwErrorList.classList.remove('hidden');
                pwValidText.classList.add('hidden');
                pwInput.style.boxShadow = "0 0 0 2px #ef4444";
            }
        }

        function validasiEmail() {
            const value = emailInput.value.toLowerCase();
            emailStatus.classList.remove('hidden');
            if (value.endsWith('@gmail.com') && value.length > 10) {
                emailStatus.style.color = "#22c55e";
                statusText.innerText = "Format Email Valid";
                statusIcon.innerText = "✓";
                emailInput.style.boxShadow = "0 0 0 2px #22c55e";
            } else {
                emailStatus.style.color = "#ef4444";
                statusText.innerText = "Wajib menggunakan @gmail.com";
                statusIcon.innerText = "⚠️";
                emailInput.style.boxShadow = "0 0 0 2px #ef4444";
            }
        }

        function validasiNip() {
            const value = nipInput.value;
            nipStatus.classList.remove('hidden');
            if (value.length >= 6) {
                nipStatus.style.color = "#22c55e"; 
                nipText.innerText = "NIP Valid";
                nipIcon.innerText = "✓";
                nipInput.style.boxShadow = "0 0 0 2px #22c55e";
            } else {
                nipStatus.style.color = "#ef4444"; 
                nipText.innerText = "NIP Minimal 6 Digit";
                nipIcon.innerText = "⚠️";
                nipInput.style.boxShadow = "0 0 0 2px #ef4444";
            }
        }

        // --- EVENT LISTENERS ---

        // Password
        pwInput.addEventListener('focus', validasiPassword);
        pwInput.addEventListener('input', validasiPassword);
        pwInput.addEventListener('blur', function() {
            if (this.value === "") {
                pwFeedback.classList.remove('opacity-100');
                pwFeedback.classList.add('opacity-0');
                setTimeout(() => pwFeedback.classList.add('hidden'), 300);
                this.style.boxShadow = "none";
            }
        });

        // Email
        emailInput.addEventListener('focus', validasiEmail);
        emailInput.addEventListener('input', validasiEmail);
        emailInput.addEventListener('blur', function() {
            if (this.value === "") {
                emailStatus.classList.add('hidden');
                this.style.boxShadow = "none";
            }
        });

        // NIP
        nipInput.addEventListener('focus', validasiNip);
        nipInput.addEventListener('input', validasiNip);
        nipInput.addEventListener('blur', function() {
            if (this.value === "") {
                nipStatus.classList.add('hidden');
                this.style.boxShadow = "none";
            }
        });
    };
</script>
@endsection