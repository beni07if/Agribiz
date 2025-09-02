<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Role (disabled) -->
        <div>
            <x-input-label for="role" :value="__('Role')" />
            <x-text-input id="role" name="role" type="text" class="mt-1 block w-full"
                value="{{ old('role', $user->role) }}" disabled />
            <input type="hidden" name="role" value="{{ $user->role }}" />
            <x-input-error class="mt-2" :messages="$errors->get('role')" />
        </div>

        <!-- Level (disabled) -->
        <div>
            <x-input-label for="level" :value="__('Level')" />
            <x-text-input id="level" name="level" type="text" class="mt-1 block w-full"
                value="{{ old('level', $user->level) }}" disabled />
            <input type="hidden" name="level" value="{{ $user->level }}" />
            <x-input-error class="mt-2" :messages="$errors->get('level')" />
        </div>

        <!-- Photo -->
        <div>
            <x-input-label for="photo" :value="__('Profile Photo')" />
            <input id="photo" name="photo" type="file" class="mt-1 block w-full" accept="image/*" />
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />

            @if($user->photo)
                <img src="{{ asset('storage/profile/' . $user->photo) }}" alt="Profile Photo"
                    class="mt-2 h-20 w-20 object-cover rounded-full">
            @endif
        </div>

        <!-- Submit -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

</section>