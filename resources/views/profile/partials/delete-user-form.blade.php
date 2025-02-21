<section class="container mt-5">
    <header class="mb-4">
        <h2 class="h3 text-danger">Delete Account</h2>
        <p class="text-muted">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <!-- Nút mở modal -->
    <button 
        class="btn btn-danger"
        data-bs-toggle="modal"
        data-bs-target="#confirmUserDeletionModal"
    >
        Delete Account
    </button>

    <!-- Modal Bootstrap -->
    <div 
        class="modal fade" 
        id="confirmUserDeletionModal" 
        tabindex="-1" 
        aria-labelledby="deleteModalLabel" 
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <form method="POST" action="{{ route('user.profile.destroy') }}" class="modal-content">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete your account?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.
                    </p>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            id="password"
                            name="password"
                            type="password"
                            class="form-control"
                            placeholder="Enter your password"
                            required
                        />
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button 
                        type="button" 
                        class="btn btn-secondary" 
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
