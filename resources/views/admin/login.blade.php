<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-slate-50 px-4">
    <div class="w-full flex justify-center">
        @include('auth._auth-panel', [
            'title' => 'Admin Login',
            'subtitle' => 'Sign in to manage your store',
            'formMethod' => 'POST',
            'formAction' => route('admin.login'),
            'submitLabel' => 'Sign in',
            'showName' => false,
            'showPasswordConfirmation' => false,
            'switchUrl' => '/',
            'switchLabel' => 'Back to site',
            'bottomText' => null,
        ])
    </div>
</body>

</html>
