<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coffee Time</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#221518',
                        secondary: '#54372B',
                        accent: '#F7E1BC',
                    },
                    fontFamily: {
                        script: ['Dancing Script', 'cursive'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
</head>

<body class="text-accent font-serif"
      style="background: radial-gradient(circle at left, #3a241f 0%, #221518 55%, #1a0f12 100%);">
