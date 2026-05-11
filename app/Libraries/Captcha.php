<?php
namespace App\Libraries;

class Captcha {
    public function generateCaptcha() {
        $permitted_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ';

        $image = imagecreatetruecolor(200, 50);
        imageantialias($image, true);

        $colors = [];
        $red = rand(125, 175);
        $green = rand(125, 175);
        $blue = rand(125, 175);

        for ($i = 0; $i < 5; $i++) {
            $colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
        }

        imagefill($image, 0, 0, $colors[0]);

        for ($i = 0; $i < 10; $i++) {
            imagesetthickness($image, rand(2, 10));
            $line_color = $colors[rand(1, 4)];
            imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $line_color);
        }

        $black = imagecolorallocate($image, 0, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);
        $textcolors = [$black, $white];

        $fonts = [
            APPPATH.'Fonts/Acme.ttf',
            APPPATH.'Fonts/Ubuntu.ttf',
            APPPATH.'Fonts/Merriweather.ttf',
            APPPATH.'Fonts/PlayfairDisplay.ttf'
        ];

        $captcha_string = $this->generateString($permitted_chars, 6);
        session()->set('captcha_text', $captcha_string);

        for ($i = 0; $i < 6; $i++) {
            $letter_space = 170/6;
            $initial = 15;
            imagettftext(
                $image,
                24,
                rand(-15, 15),
                $initial + $i*$letter_space,
                rand(25, 45),
                $textcolors[rand(0, 1)],
                $fonts[array_rand($fonts)],
                $captcha_string[$i]
            );
        }

        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);
    }

    private function generateString($input, $strength = 10) {
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }
}
