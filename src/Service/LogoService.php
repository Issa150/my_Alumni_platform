<?php
namespace App\Service;

use Symfony\Component\Finder\Finder;

class LogoService
{
    private $uploadsDir;
    private $uploadsPublicDir;

    public function __construct(string $uploadsDir, string $uploadsPublicDir)
    {
        $this->uploadsDir = $uploadsDir;
        $this->uploadsPublicDir = $uploadsPublicDir;
    }

    public function getExistingLogos(): array
    {
        $finder = new Finder();
        $finder->files()->in($this->uploadsDir);

        $logos = [];
        foreach ($finder as $file) {
            $logos[$file->getFilename()] = $this->uploadsPublicDir . '/' . $file->getFilename();
        }

        return $logos;
    }
}
