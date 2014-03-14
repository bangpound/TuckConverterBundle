<?php

namespace Tuck\ConverterBundle\File;

use Tuck\ConverterBundle\Exception\FileAlreadyExistsException;

/**
 * Creates temp files in the System tmp dir
 *
 * @author Ross Tuck <me@rosstuck.com>
 */
class SysTempFileFactory implements TempFileFactory
{
    /**
     * Essentially, an "improved" tempnam().
     *
     * As compared to the core tempnam, this version allows you to add a file
     * extension, returns an SplFileObject and has a short hand for priming it
     * with some content. If content is written, the file is not rewound before
     * returning.
     *
     * @param  string|null    $content
     * @param  string         $extension
     * @return \SplFileObject
     */
    public function createFile($content = null, $extension = 'tmp')
    {
        $filename = $this->generateFilename($extension);
        if (file_exists($filename)) {
            throw FileAlreadyExistsException::create($filename);
        }

        $tempFile = new \SplFileObject($filename, 'x+');
        if ($content !== null) {
            $tempFile->fwrite($content);
            $tempFile->fflush();
        }

        return $tempFile;
    }

    /**
     * Generates a reasonably unique path for a temp file
     *
     * @param  string $extension
     * @return string
     */
    protected function generateFilename($extension)
    {
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'tuck_converter_bundle_' . uniqid() . '.' . $extension;
    }
}
