@extends('layouts.app')

@section('title', 'Sign up')

@section('content')
<div class="flex min-h-full flex-col justify-center px-4 sm:px-6 py-10 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-4xl">
    <h2 class="mt-10 md:mt-20 text-center text-3xl md:text-4xl font-bold tracking-tight text-gray-900">
      Sign up
    </h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-4xl">
    <form class="grid grid-cols-1 md:grid-cols-2 gap-6" action="{{ route('signup') }}" method="POST">
        @csrf
      <!-- First Name -->
      <div>
        <label for="fname" class="block text-base sm:text-xl font-medium text-gray-900">First Name</label>
        <div class="mt-2">
          <input type="text" placeholder="e.g. John (required)" name="fname" id="fname" autocomplete="given-name" required
            class="custom-input w-full rounded-xl bg-white px-6 py-4 text-sm sm:text-base text-gray-900 outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600" />
        </div>
      </div>
      @error('fname')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror

      <!-- Last Name -->
      <div>
        <label for="lname" class="block text-base sm:text-xl font-medium text-gray-900">Last Name</label>
        <div class="mt-2">
          <input type="text" placeholder="e.g. Doe (required)" name="lname" id="lname" autocomplete="family-name" required
            class="custom-input w-full rounded-xl bg-white px-6 py-4 text-sm sm:text-base text-gray-900 outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600" />
        </div>
      </div>
      @error('lname')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror


<div>
        <label for="fname" class="block text-base sm:text-xl font-medium text-gray-900">Middle Name</label>
        <div class="mt-2">
          <input type="text" placeholder="e.g. John (required)" name="mname" id="mname" autocomplete="given-name" required
            class="custom-input w-full rounded-xl bg-white px-6 py-4 text-sm sm:text-base text-gray-900 outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600" />
        </div>
      </div>
      @error('mname')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror

      <!-- Email -->
      <div>
        <label for="email" class="block text-base sm:text-xl font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          <input type="email" placeholder="e.g. johndoe@gmail.com (required)" name="email" id="email" autocomplete="email" required
            class="custom-input w-full rounded-xl bg-white px-6 py-4 text-sm sm:text-base text-gray-900 outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600" />
        </div>
      </div>
      @error('email')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror

      <!-- Age -->
      <div>
        <label for="age" class="block text-base sm:text-xl font-medium text-gray-900">Age</label>
        <div class="mt-2">
          <input type="number" placeholder="e.g. 25 (required)" name="age" id="age" autocomplete="off" required
            class="custom-input w-full rounded-xl bg-white px-6 py-4 text-sm sm:text-base text-gray-900 outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600" />
        </div>
      </div>
      @error('age')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror

      <!-- Password -->
      <div>
        <label for="password" class="block text-base sm:text-xl font-medium text-gray-900">Password</label>
        <div class="mt-2">
          <input type="password" placeholder="Minimum 8 characters required" name="password" id="password" autocomplete="new-password" required
            class="custom-input w-full rounded-xl bg-white px-6 py-4 text-sm sm:text-base text-gray-900 outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600" />
        </div>
      </div>
      @error('password')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror

      <!-- Confirm Password -->
      <div>
        <label for="cpassword" class="block text-base sm:text-xl font-medium text-gray-900">Confirm Password</label>
        <div class="mt-2">
          <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" required
            class="custom-input w-full rounded-xl bg-white px-6 py-4 text-sm sm:text-base text-gray-900 outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600" />
        </div>
      </div>
   
      <!-- Submit Button -->
      <div class="md:col-span-2">
        <button type="submit"
          class="flex w-full justify-center rounded-xl bg-black px-6 py-4 text-base sm:text-lg font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-indigo-600">
          Sign up
        </button>
      </div>
    </form>

    <!-- Footer Links -->
    <p class="mt-6 text-center text-sm sm:text-lg text-black">
      Already have an account?
      <a href="{{ route('signin') }}" class="font-semibold text-gray-900 hover:text-indigo-500">Sign in here</a>
    </p>

    <div class="text-sm sm:text-lg text-center mt-4">
      <a href="#" class="font-semibold text-black hover:text-indigo-500">Forgot password?</a>
    </div>
  </div>
</div>
@endsection
