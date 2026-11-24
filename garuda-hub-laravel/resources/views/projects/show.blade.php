<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Proyek - {{ $project->title }}</title>
</head>
<body>
    <h1>{{ $project->title }}</h1>
    <a href="{{ route('projects.index') }}">Kembali</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p><strong>Pemilik:</strong> {{ $project->owner->name ?? '-' }}</p>
    <p><strong>Budget:</strong> Rp {{ number_format($project->budget, 0, ',', '.') }}</p>
    <p><strong>Status:</strong> {{ $project->status }}</p>
    <p><strong>Deskripsi:</strong><br>{{ $project->description }}</p>

    <hr>
    <h2>Daftar Penawaran (Bids)</h2>
    <ul>
        @forelse($project->bids as $bid)
            <li>
                <strong>{{ $bid->bidder->name ?? '-' }}</strong>
                | Tawaran: Rp {{ number_format($bid->amount, 0, ',', '.') }}
                | Status: {{ $bid->status }}
                @if($bid->proposal)
                    <br>Proposal: {{ $bid->proposal }}
                @endif
                <form action="{{ route('bids.destroy', $bid) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus Bid</button>
                </form>
            </li>
        @empty
            <li>Belum ada penawaran.</li>
        @endforelse
    </ul>

    <h3>Ajukan Penawaran</h3>
    <form action="{{ route('bids.store', $project) }}" method="POST">
        @csrf
        <p>
            <label>Penawar (User)</label><br>
            <select name="user_id" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </p>
        <p>
            <label>Nominal Tawaran (Rp)</label><br>
            <input type="number" step="0.01" name="amount" required>
        </p>
        <p>
            <label>Proposal</label><br>
            <textarea name="proposal" rows="3"></textarea>
        </p>
        <button type="submit">Kirim Bid</button>
    </form>
</body>
</html>