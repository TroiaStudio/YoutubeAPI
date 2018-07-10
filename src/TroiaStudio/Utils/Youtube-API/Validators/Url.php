<?php
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 10.7.18
 * Time: 14:11
 */

namespace TroiaStudio\YoutubeAPI\Validators;


class Url
{
	public static function validate(string $url): bool
	{
		$regex = "(((https?|HTTPS?|ftp)\:)?\/\/)?"; // SCHEME
		$regex .= "([a-zA-Z0-9+!*(),;?&=\$_.-]+(\:[a-zA-Z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass
		$regex .= "([a-zA-Z0-9-.]*)\.([a-zA-Z]{2,3})"; // Host or IP
		$regex .= "(\:[0-9]{2,5})?"; // Port
		$regex .= "(\/([a-zA-Z0-9+\$_-]\.?)+)*\/?"; // Path
		$regex .= "(\?[a-zA-Z+&\$_.-][a-zA-Z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
		$regex .= '(#[a-zA-Z_.-][a-zA-Z0-9+$_.-]*)?'; // Anchor

		if (preg_match("/^$regex$/", $url)) {
			return true;
		}

		return false;
	}
}