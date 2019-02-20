<?php declare(strict_types = 1);

namespace App\Components;

interface CommentFormControlFactory
{
	/**
	 * @param callable $successCallback
	 *
	 * @return CommentFormControl
	 */
	public function create(callable $successCallback);
}