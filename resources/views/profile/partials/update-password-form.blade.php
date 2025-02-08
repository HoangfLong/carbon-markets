<section class="container mt-5">
    <header class="mb-4">
        <h2 class="h3 text-primary">Update Password</h2>
        <p class="text-muted">Ensure your account is using a long, random password to stay secure.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="form-horizontal">
        @csrf
        @method('put')

        <!-- Trường Mật khẩu hiện tại -->
        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
            @error('current_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Trường Mật khẩu mới -->
        <div class="mb-3">
            <label for="update_password_password" class="form-label">New Password</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Trường Xác nhận mật khẩu -->
        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
            @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nút lưu -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>

        <!-- Thông báo thành công -->
        @if (session('status') === 'password-updated')
            <div class="mt-3 alert alert-success">
                <strong>Saved!</strong> Your password has been updated successfully.
            </div>
        @endif
    </form>
</section>
