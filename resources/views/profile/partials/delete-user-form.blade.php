<section class="container mt-5 space-y-6">
    <header class="mb-4">
        <h2 class="h3 text-danger">Delete Account</h2>
        <p class="text-muted">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <button 
        class="btn btn-danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        Delete Account
    </button>

    <!-- Modal Confirmation -->
    <div 
        class="modal fade" 
        id="confirm-user-deletion" 
        tabindex="-1" 
        aria-labelledby="exampleModalLabel" 
        aria-hidden="true"
        x-show="open"
    >
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete your account?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                    </p>

                    <div class="mb-3">
                        <label for="password" class="form-label sr-only">Password</label>
                        <input 
                            id="password"
                            name="password"
                            type="password"
                            class="form-control"
                            placeholder="Enter your password"
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
                        x-on:click="$dispatch('close')"
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
