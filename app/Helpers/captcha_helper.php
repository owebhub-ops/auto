<?php

if (!function_exists('captcha_image')) {
    /**
     * Generate CAPTCHA image (PNG with GD fallback to SVG)
     */
    
    function captcha_image($code)
    {
        // Check if GD extension is loaded
        if (!extension_loaded('gd')) {
            return generate_svg_captcha($code);
        }

        $width = 200;
        $height = 70;

        $image = imagecreatetruecolor($width, $height);
        if (!$image) {
            return generate_svg_captcha($code);
        }

        // ✅ FIXED: Clamp RGB values to 0-255 range
        $bg_color = imagecolorallocate($image, 248, 250, 252);
        $text_color = imagecolorallocate($image, 45, 55, 72);
        $line_color = imagecolorallocate($image, 239, 68, 68);
        $noise_color = imagecolorallocate($image, 156, 163, 175);

        // Anti-aliasing
        imageantialias($image, true);

        // Fill background
        imagefill($image, 0, 0, $bg_color);

        // ✅ FIXED Gradient: Proper clamping to 0-255
        for ($i = 0; $i < $width; $i++) {
            $shade = (int) (8 * sin($i / $width * M_PI)); // Safer range: -8 to +8
            $r = min(255, max(0, 240 + $shade));    // Clamp 232-248
            $g = min(255, max(0, 245 + $shade));    // Clamp 237-253
            $b = min(255, max(0, 252 + $shade));    // Clamp 244-255
            $color = imagecolorallocate($image, $r, $g, $b);
            imageline($image, $i, 0, $i, $height, $color);
        }

        // Noise dots
        for ($i = 0; $i < 100; $i++) {
            imagesetpixel($image, rand(1, $width - 2), rand(1, $height - 2), $noise_color);
        }

        // Security lines
        for ($i = 0; $i < 6; $i++) {
            $x1 = rand(10, $width - 10);
            $y1 = rand(10, $height - 10);
            $x2 = $x1 + rand(-25, 25);
            $y2 = $y1 + rand(-15, 15);
            imageline($image, $x1, $y1, $x2, $y2, $line_color);
        }

        // Distorted text
        $font_size = 5;
        $chars = str_split($code);
        $x = 25;

        foreach ($chars as $char) {
            $y_offset = rand(-3, 3);
            $x_offset = rand(-1, 1);

            // Shadow
            imagestring($image, $font_size, $x + 1 + $x_offset, 42 + $y_offset + 1, $char, $noise_color);
            // Text
            imagestring($image, $font_size, $x + $x_offset, 42 + $y_offset, $char, $text_color);

            $x += 35;
        }

        // Output PNG
        ob_start();
        imagepng($image, null, 6);
        imagedestroy($image);
        return ob_get_clean();
    }
}

if (!function_exists('generate_svg_captcha')) {
    /**
     * SVG CAPTCHA fallback (no GD required)
     */
    function generate_svg_captcha($code)
    {
        $chars = str_split($code);
        $svg = '<?xml version="1.0" encoding="UTF-8"?>
<svg width="200" height="70" viewBox="0 0 200 70" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient id="bgGrad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#f8fafc"/>
            <stop offset="100%" stop-color="#e2e8f0"/>
        </linearGradient>
        <filter id="shadow">
            <feDropShadow dx="1" dy="1" stdDeviation="1" flood-color="#00000020"/>
        </filter>
    </defs>
    <rect x="5" y="5" width="190" height="60" rx="12" fill="url(#bgGrad)" stroke="#94a3b8" stroke-width="2" filter="url(#shadow)"/>
    
    <!-- Security lines -->
    <path d="M 20 20 Q 60 50 100 15 T 180 55" stroke="#ef4444" stroke-width="2.5" stroke-linecap="round" opacity="0.8" fill="none"/>
    <circle cx="30" cy="25" r="1.5" fill="#94a3b8" opacity="0.6"/>
    <circle cx="80" cy="40" r="1.2" fill="#64748b" opacity="0.5"/>
    
    <!-- CAPTCHA Text - Distorted positions -->
    <text x="42" y="42" font-family="monospace,sans-serif" font-size="26" font-weight="900" 
          fill="#1e40af" text-anchor="middle" letter-spacing="2" stroke="#3730a3" stroke-width="0.3">' . $chars[0] . '</text>
    <text x="85" y="44" font-family="monospace,sans-serif" font-size="27" font-weight="900" 
          fill="#1e40af" text-anchor="middle" letter-spacing="2" stroke="#3730a3" stroke-width="0.3" transform="rotate(1 85 44)">' . $chars[1] . '</text>
    <text x="130" y="41" font-family="monospace,sans-serif" font-size="26" font-weight="900" 
          fill="#1e40af" text-anchor="middle" letter-spacing="2" stroke="#3730a3" stroke-width="0.3" transform="rotate(-1 130 41)">' . $chars[2] . '</text>
    <text x="175" y="43" font-family="monospace,sans-serif" font-size="26" font-weight="900" 
          fill="#1e40af" text-anchor="middle" letter-spacing="2" stroke="#3730a3" stroke-width="0.3">' . substr($code, 3) . '</text>
</svg>';
        return $svg;
    }
}