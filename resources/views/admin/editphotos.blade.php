<form action="{{ route('editphotos.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Description:</label>
    <input type="text" name="description" value="{{ $data->description }}" required>

    <label>User:</label>
    <select name="user_id" required>
        <option value="" disabled>Select User</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ $data->user_id == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>

    <label>Photos:</label>
    <input type="file" name="photos[]" multiple>

    <button type="submit">Update</button>
</form>
