<div class="page-auth">
        <div class="page-auth-content">
            <div class="page-auth-header">
                <span class="brands">Simantra</span>
            </div>
            <div class="page-auth-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="form-control-signin">
                    <div class="icons icons-left">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-control-signin">
                    <div class="icons icons-left">
                        <i class="bi bi-lock"></i>
                    </div>
                    <input type="{{ $show_password ? 'text' : 'password' }}"
                        wire:model="password"
                        class="form-control password  @error('password') is-invalid @enderror" placeholder="Password">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="icons icons-right" wire:click="showPassword">
                        <i class="bi bi-{{ $show_password ? 'eye' : 'eye-slash' }}"></i>
                    </div>

                </div>
            </div>
            <div class="page-auth-footer">
                <button type="submit" wire:click="login">SIGN-IN</button>
            </div>
        </div>
</div>
