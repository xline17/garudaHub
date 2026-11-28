<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Proyek - {{ $project->title }}</title>
</head>
<body>
    {{-- NIM: 252410102074 --}}
    <h1>{{ $project->title }}</h1>
    <a href="{{ route('projects.index') }}">Kembali ke Daftar</a> |
    <a href="{{ route('projects.edit', $project) }}">Edit Proyek</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <p><strong>Pemilik:</strong> {{ $project->owner->name ?? '-' }}</p>
    <p><strong>Budget:</strong> Rp {{ number_format($project->budget, 0, ',', '.') }}</p>
    <p><strong>Status:</strong> {{ $project->status }}</p>
    <p><strong>Deskripsi:</strong><br>{{ $project->description }}</p>
    <p><em>Catatan: Silakan ajukan penawaran sesuai anggaran proyek.</em></p>

    <hr>
    <h2>Kirim Penawaran (Bid)</h2>
    <form action="{{ route('bids.store', $project) }}" method="POST">
        @csrf

        <p>
            <label>Nominal Bid (Rp)</label><br>
            <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" required>
        </p>

        <p>
            <label>Proposal</label><br>
            <textarea name="proposal" rows="3">{{ old('proposal') }}</textarea>
        </p>

        <button type="submit">Kirim Bid</button>
    </form>

    <hr>
    <h2>Daftar Bid ({{ $project->bids->count() }})</h2>
    <ul>
        @forelse($project->bids as $bid)
            <li>
                <strong>{{ $bid->bidder->name ?? '-' }}</strong>
                — Rp {{ number_format($bid->amount, 0, ',', '.') }}
                @if($bid->proposal)
                    <br>Catatan: {{ $bid->proposal }}
                @endif
                <form action="{{ route('bids.destroy', $bid) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus bid ini?')">Hapus</button>
                </form>
            </li>
        @empty
            <li>Belum ada penawaran.</li>
        @endforelse
    </ul>
</body>
</html>