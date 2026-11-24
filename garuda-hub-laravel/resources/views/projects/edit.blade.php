<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Proyek</title>
</head>
<body>
    <h1>Edit Proyek</h1>
    <a href="{{ route('projects.index') }}">Kembali</a>

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')
        <p>
            <label>Pemilik Proyek (User)</label><br>
            <select name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $project->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label>Judul Proyek</label><br>
            <input type="text" name="title" value="{{ old('title', $project->title) }}" required>
        </p>
        <p>
            <label>Deskripsi</label><br>
            <textarea name="description" rows="4" required>{{ old('description', $project->description) }}</textarea>
        </p>
        <p>
            <label>Budget (Rp)</label><br>
            <input type="number" step="0.01" name="budget" value="{{ old('budget', $project->budget) }}" required>
        </p>
        <p>
            <label>Status</label><br>
            <select name="status">
                <option value="open" {{ old('status', $project->status) == 'open' ? 'selected' : '' }}>open</option>
                <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }}>in_progress</option>
                <option value="closed" {{ old('status', $project->status) == 'closed' ? 'selected' : '' }}>closed</option>
            </select>
        </p>
        <button type="submit">Update</button>
    </form>
</body>
</html>