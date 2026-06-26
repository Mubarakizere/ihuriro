<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - IHURIRO</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-lg">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-[#0f2557]">IHURIRO Admin</h1>
            <p class="text-gray-500 mt-2">Sign in to manage bookings & content</p>
        </div>
        
        <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" required autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#0f2557] focus:border-[#0f2557] outline-none transition-colors">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#0f2557] focus:border-[#0f2557] outline-none transition-colors">
            </div>
            
            <button type="submit" class="w-full bg-[#0f2557] text-white py-2 rounded-md font-bold hover:bg-blue-900 transition-colors">
                Login
            </button>
        </form>
    </div>
</body>
</html>
