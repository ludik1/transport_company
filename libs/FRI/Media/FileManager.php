<?php

namespace FRI\Media;

/**
 * Facade that encapsulates image upload and DB insertion
 */
class FileManager extends \Nette\Object
{
	/**
	 *
	 * @var type \FRI\Media\Storages\FileStorage
	 */
	private $fileStorage;


	public function __construct(\FRI\Media\Storages\FileStorage $fs)
	{
		$this->fileStorage = $fs;
	}

	private function getFileInfo(\Nette\Http\FileUpload $file)
	{
		$extension = ltrim(strstr($file->sanitizedName, '.'), '.');
		$filename = substr($file->sanitizedName, 0, strpos($file->sanitizedName, $extension) - 1);

		return [
			'filename' => $filename,
			'extension' => $extension,
		];
	}

	private function formatFilename($fileInfo)
	{
		return time() . '-' . $fileInfo['filename'];
	}

	public function processFile(\Nette\Http\FileUpload $uploadedFile)
	{
		$fileInfo = $this->getFileInfo($uploadedFile);
		$filename = $this->formatFilename($fileInfo);

		$filePath = $this->fileStorage->save($uploadedFile, $filename . '.' . $fileInfo['extension']);

		return $filePath;
	}
}
