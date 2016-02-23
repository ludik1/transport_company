<?php

namespace FRI\Media;

/**
 * Facade that encapsulates image upload and DB insertion
 */
class ImageManager extends \Nette\Object
{

	/** @var \FRI\Media\Storages\ImageStorage */
	private $imageStorage;


	public function __construct(\FRI\Media\Storages\ImageStorage $is)
	{
		$this->imageStorage = $is;
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

	public function processImage(\Nette\Http\FileUpload $uploadedImage)
	{
		$fileInfo = $this->getFileInfo($uploadedImage);
		$filename = $this->formatFilename($fileInfo);

		$imagePath = $this->imageStorage->save($uploadedImage, $filename, $fileInfo['extension']);

		return $imagePath; // returns originalPath
	}

	public function getPath($image, $imageSize)
	{
		return $this->imageStorage->get($image, $imageSize);
	}
}
