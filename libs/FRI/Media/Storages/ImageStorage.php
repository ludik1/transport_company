<?php

namespace FRI\Media\Storages;

use Nette\Image;

class ImageStorage extends \Nette\Object
{
	/** @var string */
	private $wwwDir;
	/** @var string */
	private $path;


	public function __construct($wwwDir, $options)
	{
		$this->path = $options['path'];
		$this->wwwDir = $wwwDir;
	}

	public function save(\Nette\Http\FileUpload $file, $filename, $extension)
	{
		$image = Image::fromFile($file);

		$image->save($this->wwwDir . '/' . $this->path . '/' . $filename . '.' . $extension);

		return $this->path . '/' . $filename . '.' . $extension;
	}
}
