<?php

namespace TylerSommer\QuickLicense\Handler\Formatter;

class CStyleFormatter implements FormatterInterface
{
    /**
     * Formats the given license
     *
     * @param string $license
     *
     * @return string The formatted license
     */
    public function formatLicense($license)
    {
        $lines = explode("\n", trim($license));

        $formattedLicense = "/*\n";

        foreach ($lines as $line) {
            $formattedLicense .= $this->formatLine($line);
        }

        return rtrim($formattedLicense) . "\n */\n";
    }

    private function formatLine($line)
    {
        $formattedLine = '';
        do {
            $line = ' * ' . $line;
            $pos = strlen($line);

            if ($pos > 79) {
                $pos = 79;

                do {
                    if (' ' === $line{$pos}) {
                        break;
                    }

                    $pos--;
                } while ($pos > 0);
            }

            $formattedLine .= rtrim(substr($line, 0, $pos)) . "\n";
            $line = substr($line, $pos + 1);
        } while (strlen($line) > 0);

        return $formattedLine;
    }
}
