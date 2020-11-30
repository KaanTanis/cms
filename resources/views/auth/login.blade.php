<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('loginTitle') }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer
    ></script>
    <script src="../assets/js/init-alpine.js"></script>
</head>
<body>
<div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
    <div class="flex-1 h-full max-w-xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <div class="flex flex-col overflow-y-auto">
            <div class="flex items-center justify-center p-6 sm:p-12">
                <div class="w-full">
                    <form action="{{ route('authenticate') }}" method="post">
                        @csrf
                    <h1
                        class="text-xl font-semibold text-gray-700 dark:text-gray-200 text-center mb-8"
                    >
                        {{ __('loginTitle') }}
                    </h1>
                        @if(session()->has('info'))
                            <div class="bg-purple-600 rounded px-5 py-4 text-white mb-6">{{ session('info') }}</div>
                        @endif
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">{{ __('email') }}</span>
                        <input name="email"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder=""
                        />
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">{{ __('password') }}</span>
                        <input name="password"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="***************"
                            type="password"
                        />
                    </label>

                    <!-- You should use a button here, as the anchor is only used for the example  -->
                    <button class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border
                    border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">{{ __('loginBtn') }}</button>
                    </form>
                    {{--<p class="mt-4">
                        <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                            href="#">
                            {{ __('Forgot your password?') }}
                        </a>
                    </p>--}}
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
