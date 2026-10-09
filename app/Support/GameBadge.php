<?php

namespace App\Support;

use App\Models\GameParticipant;
use Illuminate\Support\Str;

class GameBadge
{
    private const W = 1080;
    private const H = 1350;
    private const NAVY = [0, 35, 77];
    private const PINK = [236, 72, 153];
    private const WHITE = [255, 255, 255];

    public static function generate(GameParticipant $participant): ?string
    {
        $im = @imagecreatetruecolor(self::W, self::H);
        if (!$im) {
            return null;
        }

        [$nr, $ng, $nb] = self::NAVY;
        [$pr, $pg, $pb] = self::PINK;
        [$wr, $wg, $wb] = self::WHITE;

        $navy = imagecolorallocate($im, $nr, $ng, $nb);
        $navyLight = imagecolorallocate($im, 8, 55, 110);
        $pink = imagecolorallocate($im, $pr, $pg, $pb);
        $white = imagecolorallocate($im, $wr, $wg, $wb);
        $muted = imagecolorallocate($im, 190, 205, 225);

        imagefill($im, 0, 0, $navy);

        // Arcs décoratifs fins (comme la maquette) : cercles partiels rose/navy clair
        self::ellipse($im, self::W - 40, 140, 520, $pink);
        self::ellipse($im, self::W + 20, 420, 300, $pink);
        self::ellipse($im, 40, self::H - 180, 560, $navyLight);
        self::ellipse($im, -20, 320, 260, $navyLight);

        // Bandeau haut rose fin
        imagefilledrectangle($im, 0, 0, self::W, 14, $pink);

        $font = public_path('assets/admin/icons/helveticaNeue/fonts/HelveticaNeue.ttf');
        $fontBold = public_path('assets/admin/icons/helveticaNeue/fonts/HelveticaNeueMed.ttf');
        $font = is_file($font) ? $font : null;
        $fontBold = is_file($fontBold) ? $fontBold : $font;

        // Logo
        $logoPath = public_path('assets/logo/desktop/logo-2.png');
        if (!is_file($logoPath)) {
            $logoPath = public_path('assets/logo/desktop/logo.png');
        }
        if (is_file($logoPath)) {
            $logo = @imagecreatefrompng($logoPath);
            if ($logo) {
                imagealphablending($logo, true);
                imagesavealpha($logo, true);
                $lw = imagesx($logo);
                $lh = imagesy($logo);
                $dw = 340;
                $dh = (int) round($lh * ($dw / $lw));
                imagecopyresampled($im, $logo, (int) ((self::W - $dw) / 2), 70, 0, 0, $dw, $dh, $lw, $lh);
                imagedestroy($logo);
            }
        }

        // "GRAND JEU" encadré de liserés roses, puis titre avec petit trait dessous
        self::text($im, $font, 30, self::W / 2, 240, 'G R A N D   J E U', $pink);
        self::dash($im, 130, 228, 170, $pink);
        self::dash($im, self::W - 300, 228, 170, $pink);
        self::text($im, $fontBold, 58, self::W / 2, 330, 'BADGE DE PARTICIPATION', $white);
        self::dash($im, self::W / 2 - 40, 360, 80, $pink);

        // Photo circulaire avec anneau rose
        $cx = self::W / 2;
        $cy = 620;
        $r = 230;

        self::circle($im, $cx, $cy, $r + 14, $pink);
        self::circle($im, $cx, $cy, $r, $navyLight);

        $photoSrc = self::loadPhoto($participant);
        if ($photoSrc) {
            self::pasteCircular($im, $photoSrc, $cx, $cy, $r - 8);
            imagedestroy($photoSrc);
        } else {
            $initials = Str::upper(Str::substr($participant->public_name, 0, 1));
            self::text($im, $fontBold, 200, $cx, $cy + 70, $initials, $white);
        }

        // Nom public + liseré, texte muted, cadeau en rose
        self::text($im, $fontBold, 64, $cx, 960, Str::limit($participant->public_name, 24), $white);
        self::dash($im, $cx - 40, 985, 80, $pink);
        self::text($im, $font, 34, $cx, 1040, 'participe au Grand Jeu Mobilier Addict', $muted);
        self::text($im, $font, 30, $cx, 1095, 'et tente de gagner : ' . Str::limit($participant->prize, 34), $pink);

        // Hashtags + liseré + baseline
        self::text($im, $fontBold, 34, $cx, 1210, '#MobilierAddict  #MatelasAddict', $white);
        self::dash($im, $cx - 40, 1235, 80, $pink);
        self::text($im, $font, 24, $cx, 1290, 'Soutenez-moi sur mobilier-addict.com', $muted);

        $filename = 'uploads/game/badges/' . $participant->slug . '-' . Str::random(6) . '.png';
        $fullPath = public_path($filename);

        if (!is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0775, true);
        }

        $ok = imagepng($im, $fullPath, 6);
        imagedestroy($im);

        return $ok ? $filename : null;
    }

    private static function loadPhoto(GameParticipant $participant)
    {
        $path = trim((string) $participant->photo);
        if ($path === '') {
            return null;
        }

        $local = Str::startsWith($path, 'storage/')
            ? storage_path('app/public/' . preg_replace('#^storage/#', '', $path))
            : public_path(ltrim($path, '/'));

        if (!is_file($local)) {
            return null;
        }

        return @imagecreatefromstring((string) @file_get_contents($local));
    }

    private static function circle($im, float $cx, float $cy, int $r, $color): void
    {
        imagefilledellipse($im, (int) $cx, (int) $cy, $r * 2, $r * 2, $color);
    }

    private static function ellipse($im, float $cx, float $cy, int $d, $color): void
    {
        imageellipse($im, (int) $cx, (int) $cy, $d, $d, $color);
    }

    private static function dash($im, float $x, int $y, int $w, $color): void
    {
        imagefilledrectangle($im, (int) $x, $y, (int) ($x + $w), $y + 3, $color);
    }

    private static function text($im, ?string $font, int $size, float $cx, int $y, string $txt, $color): void
    {
        if (!$font) {
            imagestring($im, 5, (int) ($cx - strlen($txt) * 4), $y, $txt, $color);
            return;
        }

        $box = imagettfbbox($size, 0, $font, $txt);
        $w = abs($box[4] - $box[0]);
        imagettftext($im, $size, 0, (int) round($cx - $w / 2), $y, $color, $font, $txt);
    }

    private static function pasteCircular($dst, $src, float $cx, float $cy, int $r): void
    {
        $sw = imagesx($src);
        $sh = imagesy($src);
        $side = min($sw, $sh);
        $sx = (int) (($sw - $side) / 2);
        $sy = (int) (($sh - $side) / 2);

        $d = $r * 2;
        $mask = imagecreatetruecolor($d, $d);
        $transparent = imagecolorallocatealpha($mask, 0, 0, 0, 127);
        imagefill($mask, 0, 0, $transparent);
        $black = imagecolorallocate($mask, 0, 0, 0);
        imagefilledellipse($mask, $r, $r, $d, $d, $black);

        $square = imagecreatetruecolor($d, $d);
        imagecopyresampled($square, $src, 0, 0, $sx, $sy, $d, $d, $side, $side);

        imagealphablending($square, false);
        imagesavealpha($square, true);
        for ($x = 0; $x < $d; $x++) {
            for ($y = 0; $y < $d; $y++) {
                $m = imagecolorat($mask, $x, $y);
                if (($m & 0x7F000000) >> 24 === 127) {
                    imagesetpixel($square, $x, $y, $transparent);
                }
            }
        }

        imagecopy($dst, $square, (int) ($cx - $r), (int) ($cy - $r), 0, 0, $d, $d);
        imagedestroy($mask);
        imagedestroy($square);
    }
}
