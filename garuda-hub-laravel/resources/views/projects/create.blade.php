<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Proyek</title>
</head>
<body>
    <h1>Tambah Proyek</h1>
    <a href="{{ route('projects.index') }}">Kembali</a>

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <p>
            <label>Pemilik Proyek (User)</label><br>
            <select name="user_id" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label>Judul Proyek</label><br>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </p>
        <p>
            <label>Deskripsi</label><br>
            <textarea name="description" rows="4" required>{{ old('description') }}</textarea>
        </p>
        <p>
            <label>Budget (Rp)</label><br>
            <input type="number" step="0.01" name="budget" value="{{ old('budget') }}" required>
        </p>
        <p>
            <label>Status</label><br>
            <select name="status">
                <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>open</option>
                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>in_progress</option>
                <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>closed</option>
            </select>
        </p>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>