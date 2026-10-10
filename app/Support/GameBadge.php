<?php

namespace App\Support;

use App\Models\GameParticipant;
use Illuminate\Support\Str;

class GameBadge
{
    private const W = 1080;
    private const H = 1080;
    private const NAVY = [6, 36, 75];
    private const PINK = [250, 39, 136];
    private const SOFT_PINK = [253, 230, 241];
    private const WHITE = [255, 255, 255];

    public static function generate(GameParticipant $participant): ?string
    {
        $im = @imagecreatetruecolor(self::W, self::H);
        if (!$im) {
            return null;
        }

        [$nr, $ng, $nb] = self::NAVY;
        [$pr, $pg, $pb] = self::PINK;
        [$sr, $sg, $sb] = self::SOFT_PINK;
        [$wr, $wg, $wb] = self::WHITE;

        $navy = imagecolorallocate($im, $nr, $ng, $nb);
        $pink = imagecolorallocate($im, $pr, $pg, $pb);
        $softPink = imagecolorallocate($im, $sr, $sg, $sb);
        $white = imagecolorallocate($im, $wr, $wg, $wb);

        imagefill($im, 0, 0, $white);

        // Bandeau rose en haut
        imagefilledrectangle($im, 0, 0, self::W, 14, $pink);

        // Décorations : pastille rose pâle à gauche, anneau rose à droite,
        // disque rose cerclé de bleu nuit en bas à droite
        imagefilledellipse($im, -160, 480, 300, 520, $softPink);
        self::ring($im, 930, 151, 176, 2, $pink);
        imagefilledellipse($im, 985, 1050, 420, 420, $navy);
        imagefilledellipse($im, 985, 1050, 345, 345, $pink);

        $font = public_path('assets/admin/icons/helveticaNeue/fonts/HelveticaNeue.ttf');
        $fontBold = public_path('assets/admin/icons/helveticaNeue/fonts/HelveticaNeueMed.ttf');
        $font = is_file($font) ? $font : null;
        $fontBold = is_file($fontBold) ? $fontBold : $font;

        // Logo centré en haut
        $logoPath = public_path('assets/logo/desktop/logo.png');
        if (!is_file($logoPath)) {
            $logoPath = public_path('assets/logo/desktop/logo-2.png');
        }
        if (is_file($logoPath)) {
            $logo = @imagecreatefrompng($logoPath);
            if ($logo) {
                imagealphablending($logo, true);
                imagesavealpha($logo, true);
                $lw = imagesx($logo);
                $lh = imagesy($logo);
                $dw = 254;
                $dh = (int) round($lh * ($dw / $lw));
                $dh = min($dh, 97);
                imagecopyresampled($im, $logo, (int) ((self::W - $dw) / 2), 35, 0, 0, $dw, $dh, $lw, $lh);
                imagedestroy($logo);
            }
        }

        // Titre : ligne d'accent, PARTICIPANT (navy), MOBILIER ADDICT (pink), ligne d'accent
        self::dash($im, self::W / 2 - 49, 142, 98, $pink);
        self::text($im, $fontBold, 77, self::W / 2, 228, 'PARTICIPANT', $navy);
        self::text($im, $fontBold, 58, self::W / 2, 292, 'MOBILIER ADDICT', $pink);
        self::dash($im, self::W / 2 - 49, 312, 98, $pink);

        // Photo circulaire : anneau rose + liséré blanc
        $cx = self::W / 2;
        $cy = 560;
        $r = 235;

        self::circle($im, $cx, $cy, $r, $pink);
        self::circle($im, $cx, $cy, $r - 10, $white);
        self::circle($im, $cx, $cy, $r - 16, $softPink);

        $photoSrc = self::loadPhoto($participant);
        if ($photoSrc) {
            self::pasteCircular($im, $photoSrc, $cx, $cy, $r - 16);
            imagedestroy($photoSrc);
        } else {
            $initials = Str::upper(Str::substr($participant->public_name, 0, 1));
            self::text($im, $fontBold, 160, $cx, $cy + 55, $initials, $navy);
        }

        // Pastille bleu nuit avec le nom, chevauchant le bas de la photo
        $pillW = 680;
        $pillH = 92;
        $pillY = (int) ($cy + $r - 30);
        self::pill($im, (int) ($cx - $pillW / 2), $pillY, $pillW, $pillH, $navy);
        self::text($im, $fontBold, 44, $cx, $pillY + 65, Str::upper(Str::limit($participant->public_name, 22)), $white);

        // Footer : "Soutenez-moi sur" + pastille site web
        self::text($im, $font, 31, $cx, $pillY + $pillH + 62, 'Soutenez-moi sur', $navy);

        $siteY = $pillY + $pillH + 82;
        $siteH = 62;
        $siteW = 620;
        $siteX = (int) ($cx - $siteW / 2);
        self::pill($im, $siteX, $siteY, $siteW, $siteH, $pink);
        self::pill($im, $siteX + 3, $siteY + 3, $siteW - 6, $siteH - 6, $white);
        self::circle($im, $siteX + 48, $siteY + $siteH / 2, 20, $pink);
        self::text($im, $fontBold, 30, $cx + 16, $siteY + 42, 'www.mobilier-addict.com', $navy);

        $filename = 'uploads/game/badges/v2-' . $participant->slug . '-' . Str::random(6) . '.png';
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

    private static function ring($im, float $cx, float $cy, int $r, int $thickness, $color): void
    {
        for ($i = 0; $i < $thickness; $i++) {
            imageellipse($im, (int) $cx, (int) $cy, ($r - $i) * 2, ($r - $i) * 2, $color);
        }
    }

    private static function pill($im, int $x, int $y, int $w, int $h, $color): void
    {
        $r = (int) ($h / 2);
        imagefilledellipse($im, $x + $r, $y + $r, $h, $h, $color);
        imagefilledellipse($im, $x + $w - $r, $y + $r, $h, $h, $color);
        imagefilledrectangle($im, $x + $r, $y, $x + $w - $r, $y + $h, $color);
    }

    private static function dash($im, float $x, int $y, int $w, $color): void
    {
        imagefilledrectangle($im, (int) $x, $y, (int) ($x + $w), $y + 5, $color);
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
