@extends('layouts.app')

@section('content')

   <!-- Container Centralizado -->
    <div class="form-container">
        <h1 class="custom-font">My Profile</h1>

        <!-- Foto de Perfil -->
        @if ($user->user_photo_url)
            <div class="text-center">
                <img 
                    src="{{ asset($user->user_photo_url) }}" 
                    alt="User Photo" 
                    class="rounded-circle"
                    style="width: 150px; height: 150px; object-fit: cover; margin: 20px auto;"
                >
            </div>
        @endif

        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif

        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- First Name -->
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
            @error('first_name') <span class="error-message">{{ $message }}</span> @enderror

            <!-- Last Name -->
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
            @error('last_name') <span class="error-message">{{ $message }}</span> @enderror

            <!-- Username -->
            <label for="user_name">Username:</label>
            <input type="text" id="user_name" name="user_name" value="{{ $user->user_name }}" disabled>
            @error('user_name') <span class="error-message">{{ $message }}</span> @enderror

            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            @error('email') <span class="error-message">{{ $message }}</span> @enderror

            <!-- User Photo -->
            <label for="user_photo_url">Update Profile Photo:</label>
            <div class="custom-file-upload">
                <input type="file" id="user_photo_url" name="user_photo_url" accept="image/*" hidden>
                <label for="user_photo_url" class="btn btn-secondary">Choose File</label>
                <span id="file-chosen">No file chosen</span>
            </div>
            @error('user_photo_url') <span class="error-message">{{ $message }}</span> @enderror

            <!-- Submit Button -->
            <button type="submit">Update</button>
        </form>
    </div>
    @push('scripts')
<script>
    document.getElementById('user_photo_url').addEventListener('change', function () {
    const fileInput = this;
    const fileNameElement = document.getElementById('file-chosen');
    if (fileInput.files && fileInput.files.length > 0) {
        fileNameElement.textContent = fileInput.files[0].name; // Exibe o nome do arquivo selecionado
    } else {
        fileNameElement.textContent = 'No file chosen'; // Retorna ao estado inicial se nenhum arquivo for selecionado
    }
});
</script>
@endpush
@endsection

