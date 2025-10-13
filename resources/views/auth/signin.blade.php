@extends('layouts.app')

@section('title', 'Sign up')

@section('content')
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-40 text-center text-3xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="{{ route('signin') }}" method="POST">
        @csrf
      <div>
        <label for="email" class="block text-xl font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          <input type="email" placeholder="e.g. johndoe@gmail.com (required)" name="email" id="email" autocomplete="email" required class="custom-input block w-full rounded-xl bg-white px-6 py-4 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-xl font-medium text-gray-900">Password</label>
        </div>
        <div class="mt-2">
          <input type="password" placeholder="minimum 8 characters required" name="password" id="password" autocomplete="current-password" required class="custom-input block w-full rounded-xl bg-white px-6 py-4 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-xl bg-black px-5 py-3.5 text-l font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
      </div>
    </form>


    <p class="mt-5 text-center text-l text-black">
      Still don't have an account?
      <a href="{{ route('signup') }}" class="font-semibold text-gray-900 hover:text-indigo-500">Sign up here</a>
    </p>

    <div class="text-l text-center mt-5">
            <a href="#" class="font-semibold text-center text-black hover:text-indigo-500">Forgot password?</a>
          </div>
  </div>
</div>
@endsection