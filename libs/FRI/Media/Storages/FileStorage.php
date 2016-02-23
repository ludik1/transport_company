<?php

namespace FRI\Media\Storages;

class FileStorage extends \Nette\Object
{
	/** @var string */
	private $wwwDir;
	/** @var string */
	private $path;


	public function __construct($wwwDir, $options)
	{
		$this->wwwDir = $wwwDir;
		$this->path = $options['path'];
	}

	public function save(\Nette\Http\FileUpload $file, $filename)
	{
		$file->move($this->wwwDir . '/' . $this->path . '/' . $filename);

		return $this->path . '/' . $filename;
	}
}
