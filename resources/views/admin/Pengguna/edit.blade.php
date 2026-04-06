<x-app-layout>
    <div class="max-w-2xl mx-auto py-12 px-4">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tighter">
                Edit Pengguna
            </h1>
            <p class="text-gray-400 text-xs font-bold uppercase tracking-[0.2em] mt-1">
                Update system access details
            </p>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm p-8 rounded-[2rem]">

            <form action="{{ route('admin.pengguna.update', $pengguna->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 mb-2 ml-1">
                        Nama
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $pengguna->name) }}"
                        class="w-full bg-gray-50 border rounded-2xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none transition-all {{ $errors->has('name') ? 'border-red-500' : 'border-gray-200' }}"
                        required
                    >

                    @error('name')
                        <span class="text-red-500 text-xs font-bold mt-1 block">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 mb-2 ml-1">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $pengguna->email) }}"
                        class="w-full bg-gray-50 border rounded-2xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none transition-all {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }}"
                        required
                    >

                    @error('email')
                        <span class="text-red-500 text-xs font-bold mt-1 block">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 mb-2 ml-1">
                        Password (Kosongkan jika tidak diubah)
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        class="w-full bg-gray-50 border rounded-2xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none transition-all {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200' }}"
                    >

                    @error('password')
                        <span class="text-red-500 text-xs font-bold mt-1 block">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 mb-2 ml-1">
                        Role
                    </label>

                    <select
                        name="role"
                        class="w-full bg-gray-50 border rounded-2xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none transition-all {{ $errors->has('role') ? 'border-red-500' : 'border-gray-200' }}"
                        required
                    >
                        <option value="user" {{ old('role', $pengguna->role) == 'user' ? 'selected' : '' }}>User</option>
                        <option value="operator" {{ old('role', $pengguna->role) == 'operator' ? 'selected' : '' }}>Operator</option>
                        <option value="admin" {{ old('role', $pengguna->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>

                    @error('role')
                        <span class="text-red-500 text-xs font-bold mt-1 block">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex gap-4 pt-4">

                    <a href="{{ route('admin.pengguna.index') }}"
                       class="flex-1 text-center px-6 py-3 bg-gray-100 text-gray-600 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-gray-200 transition">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="flex-1 px-6 py-3 bg-emerald-600 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-emerald-700 transition shadow-lg shadow-emerald-600/20 active:scale-95">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>
</x-app-layout>