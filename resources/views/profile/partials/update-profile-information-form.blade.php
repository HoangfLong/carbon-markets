<section class="container mt-5">
    <header class="mb-4">
        <h2 class="h3 text-primary">Update Profile Information</h2>
        <p class="text-muted">Update your account's profile information and email address.</p>
    </header>
    <!-- Nút điều hướng về Dashboard -->
    <div class="mt-4">
        <a href="{{ route('dashboard') }}" >
            <button class="btn btn-secondary">Go to Dashboard</button>
        </a>
    </div>
    <form method="post" action="{{ route('user.profile.update') }}" class="form-horizontal">
        @csrf
        @method('patch')
        <!-- Trường Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Trường Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="email">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Trường Phone -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input id="phone" name="phone" type="text" class="form-control" value="{{ old('phone', $user->phone) }}" required autocomplete="tel">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Trường Address -->
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input id="address" name="address" type="text" class="form-control" value="{{ old('address', $user->address) }}" required autocomplete="address">
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Trường Country -->
        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <input id="country" name="country" type="text" class="form-control" value="{{ old('country', $user->country) }}" required autocomplete="country">
            @error('country')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Trường Company -->
        <div class="mb-3">
            <label for="company" class="form-label">Company</label>
            <input id="company" name="company" type="text" class="form-control" value="{{ old('company', $user->company) }}" required autocomplete="company">
            @error('company')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nút Lưu -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>

        <!-- Thông Báo Thành Công -->
        @if (session('status') === 'profile-updated')
            <div class="mt-3 alert alert-success">
                <strong>Saved!</strong> Your profile information has been updated.
            </div>
        @endif
    </form>
</section>
