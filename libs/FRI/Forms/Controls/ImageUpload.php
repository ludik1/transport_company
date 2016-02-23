<?php

namespace FRI\Forms\Controls;

use Nette\Forms\Controls\UploadControl,
	FRI\Application\UI\Form,
	Nette\Image;

/**
 * Image upload control
 *
 * @author Jakub Jarabica
 */
class ImageUpload extends UploadControl
{

	const DIMENSIONS_EXACT = 1;
	const DIMENSIONS_MINIMAL = 2;
	const DIMENSIONS_MAXIMAL = 3;


	/**
	 * Validates if image is filled and is really an image
	 * @param \Nette\Forms\IControl $control
	 * @return boolean
	 */
	public static function validateFilled(\Nette\Forms\IControl $control)
	{
		$fileOk = $control->value instanceof \Nette\Http\FileUpload && $control->value->isOk();
		return $fileOk && $control->value->isImage();
	}

	/**
	 * Validates mime type of image
	 * @param ImageUpload $control
	 * @param int $imageType
	 * @return boolean
	 */
	public static function validateImageType(ImageUpload $control, $imageType)
	{
		if (!$control->value->isOk())
		{ // imageUpload may be optional
			throw new \Nette\InvalidArgumentException('No uploaded file.');
		}

		$types = ['image/jpeg' => Image::JPEG, 'image/gif' => Image::GIF, 'image/png' => Image::PNG];

		return $imageType == $types[$control->value->getContentType()];
	}

	/**
	 * Validates image dimensions
	 * @param ImageUpload $control
	 * @param array $dimensions array of desired width and height
	 * @param int $operation exact|minimal|maximal
	 * @return boolean
	 */
	private static function validateDimensions(ImageUpload $control, $dimensions, $operation)
	{
		if (count($dimensions) !== 2 || count(array_filter($dimensions)) === 0)
		{
			throw new \LogicException('Image dimensions must be array containing 2 integer|NULL values!');
		}
		list($width, $height) = $dimensions;

		$image = Image::fromFile($control->value);

		switch ($operation)
		{
			case static::DIMENSIONS_EXACT:
				if ($width !== NULL && $image->getWidth() != $width)
				{
					return FALSE;
				}
				if ($height !== NULL && $image->getHeight() != $height)
				{
					return FALSE;
				}
				break;

			case static::DIMENSIONS_MINIMAL;
				if ($width !== NULL && $image->getWidth() < $width)
				{
					return FALSE;
				}
				if ($height !== NULL && $image->getHeight() < $height)
				{
					return FALSE;
				}
				break;

			case static::DIMENSIONS_MAXIMAL;
				if ($width !== NULL && $image->getWidth() > $width)
				{
					return FALSE;
				}
				if ($height !== NULL && $image->getHeight() > $height)
				{
					return FALSE;
				}
				break;
		}

		return TRUE;
	}

	/**
	 * Validates image to have exact specified dimensions
	 * @param ImageUpload $control
	 * @param array $dimensions array of desired width and height
	 * @return boolean
	 */
	public static function validateExactDimensions(ImageUpload $control, $dimensions)
	{
		return static::validateDimensions($control, $dimensions, static::DIMENSIONS_EXACT);
	}

	/**
	 * Validates image to have maximal specified dimensions
	 * @param ImageUpload $control
	 * @param array $dimensions array of desired width and height
	 * @return boolean
	 */
	public static function validateMinDimensions(ImageUpload $control, $dimensions)
	{
		return static::validateDimensions($control, $dimensions, static::DIMENSIONS_MINIMAL);
	}

	/**
	 * Validates image to have minimal specified dimensions
	 * @param ImageUpload $control
	 * @param array $dimensions array of desired width and height
	 * @return boolean
	 */
	public static function validateMaxDimensions(ImageUpload $control, $dimensions)
	{
		return static::validateDimensions($control, $dimensions, static::DIMENSIONS_MAXIMAL);
	}
}
