<x-app-layout>
  <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-md w-full space-y-8">
          <div class="text-center">
              <div class="flex justify-center">
                  <svg class="w-12 h-12 text-purple-600" viewBox="0 0 40 40">
                      <path fill="currentColor" d="M20 3.33a16.67 16.67 0 1 0 0 33.34 16.67 16.67 0 0 0 0-33.34zm-1.67 25h3.34v-3.33h-3.34V28.33zm0-6.66h3.34V11.67h-3.34v10z"/>
                  </svg>
              </div>
              <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Set New Password</h2>
          </div>

          <form class="mt-8 space-y-6" action="{{ route('password.store') }}" method="POST">
              @csrf
              <input type="hidden" name="token" value="{{ $request->route('token') }}">
              <input type="hidden" name="email" value="{{ $request->email }}">
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
              <div class="space-y-4">
                  <div>
                      <label for="password" class="sr-only">New Password</label>
                      <input id="password" name="password" type="password" required class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="New Password">
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>

                  <div>
                      <label for="password_confirmation" class="sr-only">Confirm Password</label>
                      <input id="password_confirmation" name="password_confirmation" type="password" required class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Confirm Password">
                      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                  </div>
              </div>

              <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                  Reset Password
              </button>
          </form>
      </div>
  </div>
</x-app-layout>
