<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Garuda-Hub - Daftar Proyek</title>
</head>
<body>
    <h1>Garuda-Hub — Lelang Proyek IT Mahasiswa</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('projects.create') }}">+ Tambah Proyek</a>

    <ul>
        @forelse($projects as $project)
            <li>
                <strong>{{ $project->title }}</strong>
                | Pemilik: {{ $project->owner->name ?? '-' }}
                | Budget: Rp {{ number_format($project->budget, 0, ',', '.') }}
                | Status: {{ $project->status }}
                | Total Bid: {{ $project->bids->count() }}
                <br>
                <a href="{{ route('projects.show', $project) }}">Detail & Bid</a> |
                <a href="{{ route('projects.edit', $project) }}">Edit</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus proyek ini?')">Hapus</button>
                </form>
            </li>
        @empty
            <li>Belum ada proyek.</li>
        @endforelse
    </ul>
</body>
</html>