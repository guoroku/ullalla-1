<?php
// upload care store files
function storeAndGetUploadCareFiles($file, $dbObject = null) {
	$imageFile = null;
	// $api = new Uploadcare\Api(config('uploadcare.public_key'), config('uploadcare.private_key'));
	if ($file) {
		if (strpos($file, '~') !== false) {
			// is multiple
			$group = app()->uploadcare->getGroup($file);
			$group->store();
			$imageFile = $group->getUrl();
		} else {
			// is single
			$file = app()->uploadcare->getFile($file);
			$file->store();
			$imageFile = $file->getUrl();
		}
	}
	return $imageFile;
}

function getSexes() {
	return ['male', 'female', 'transsexual'];
}

function getSexOrientations() {
	return ['heterosexual', 'bisexual', 'homosexual'];
}

function getAnswers() {
	return ['yes', 'no', 'occasionally'];
}

function getTypes() {
	return ['asian', 'black', 'european', 'latina', 'indian', 'arabian', 'mixed', 'other'];
}

function getFigures() {
	return ['athletic', 'chubby', 'normal', 'slim', 'other'];
}

function getBreastSizes() {
	return ['a', 'b', 'c', 'd', 'e', 'f', 'g'];
}

function getEyeColors() {
	return ['black', 'brown', 'green', 'blue', 'gray', 'other'];
}

function getHairColors() {
	return ['black', 'brunette', 'blond', 'red', 'other'];
}

function getShaveOptions() {
	return ['shaved', 'partial', 'hairy'];
}

function getPriceTypes() {
	return ['outcall', 'incall'];
}

function getFilterYears() {
	return [
		'18' => '25',
		'26' => '35',
		'36' => '60',
	];
}

function makeStringFromFilterYears($startAge, $endAge) {
	return $startAge . '-' . $endAge;
}

function getHoursList() {
	$hours = [];
	for($i=0; $i<24; $i++){
		array_push($hours, sprintf("%02d", $i));
	}
	return $hours;
}

function getMinutesList() {
	$minutes = [];
	for($i=0; $i<60; $i++){
		array_push($minutes, sprintf("%02d",$i));
	}
	return $minutes;
}

function getDaysOfTheWeek() {
	return ['Monday', 'Thuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
}

function getWorkingTime($days, $available_24_7, $timeFrom, $timeFromM, $timeTo, $timeToM, $showAsNightEscort, $nightEscorts) {
	$workingTime = null;
    // girl availability and working hours
	if ($available_24_7) {
		$workingTime = 'Available 24/7';
		if ($showAsNightEscort) {
			$workingTime .= '&' . 'Night Escort';
		}
	} elseif ($days) {
        // loop through each day and put in array day of the week delimited (|) with time from and time to            
		foreach ($days as $key => $value) {
			if ($value) {
				$string = $value . '|' . $timeFrom[$key] . ':' . $timeFromM[$key] . ' - ' . $timeTo[$key] . ':' . $timeToM[$key];
				if (isset($nightEscorts[$key])) {
					$string .= '&' . $nightEscorts[$key];
					$workingTime[] = $string;
				} else {
					$workingTime[] = $string;
				}
			}
		}
	}

	if (!$available_24_7 && $workingTime) {
		$workingTime = array_map('utf8_encode', $workingTime);
		$workingTime = json_encode($workingTime);
	}

	return $workingTime;
}

function getBioFields() {
	return [
		'age' => 'Age',		
		'type' => 'Nationality',		
		'country_id' => 'Nationality',
		'eye_color' => 'Eyes',
		'hair_color' => 'Hair',
		'height' => 'Height',
		'weight' => 'Weight',
		'breast_size' => 'Breast Size',
		'intimate' => 'Intimate',
		'smoker' => 'Smoker',
		'alcohol' => 'Alcohol',
	];
}

function parseSingleUserData($fields, $user) {
	$html = '';
	foreach ($fields as $key => $field) {
		if ($user->$key) {
			$html .= '<tr>
			<td>' . $field . ':</td>
			<td>' . $user->$key . '</td>
			</tr>';
		}
	}

	echo $html;
}

function parseChunkedServices($user) {
	if ($user->services()->count()) {
		$user->services()->chunk(5, function ($services) {
			$html = '';
			$html .= '<tr>';
			foreach ($services as $service) {
				$html .= '<td>
				<i class="fa fa-check"></i>'
				. $service->service_name . 
				'</td>';
			}
			$html .= '</tr>';
			echo $html;
		});
	}
}

function getshowNumbers() {
	return ['9', '12', '24', '36'];
}

function getOrderBy() {
	return [
		'nickname_asc' => 'Nickname', 
		'created_at_desc' => 'Newest', 
		'created_at_asc' => 'Oldest',
		'service_price_asc' => 'Price Ascending', 
		'service_price_desc' => 'Price Descending', 
	];
}

function getOrderByParameter($str) {
	if (strpos($str, 'asc') !== false) {
		return 'asc';
	}

	return 'desc';
}

function getAfterLastChar($str, $char) {
	return substr($str, strrpos($str, $char) + 1);
}

function getBeforeLastChar($str, $char) {
	return substr($str, 0, strrpos( $str, $char));
}

function getUrlWithFilters($input, $query, $i, $inputName, $obj) {
	$value = is_object($obj) ? $obj->id : $obj;
	if ($input) {
		if (!in_array($value, $input)) {
			$ids[$i] = $value;
		} else {
			$ids = null;
			if (($key = array_search($value, $input)) !== false) {
				unset($query[$inputName][$key]);
			}
		}
	} else {
		$ids[$i] = $value;
	}

	return array_merge($query, [$inputName . '[' . $i . ']' => $ids[$i]]);

}

function getEditProfilePages() {
	return [
		'bio' => 'Bio', 
		'about_me' => 'About Me', 
		'gallery' => 'Gallery', 
		'contact' => 'Contact', 
		'services' => 'Services', 
		'workplace' => 'Workplace', 
		'working_time' => 'Working Time', 
		'prices' => 'Prices',
		'packages' => 'Packages', 
		'banners' => 'Banners'
	];
}

function parseEditProfileMenu($currentPage) {
	$html = '';
	foreach (getEditProfilePages() as $href => $pageTitle) {
		$path = url('@' . Auth::user()->username . '/' . $href);
		$active = $href == $currentPage ? 'active' : '';
		$html .= '<a href=' . $path . ' class=' . $active . '>' . $pageTitle . '</a>';
	}
	return $html;
}

function getSelectedOption($dbOption, $option) {
	return $dbOption == $option ? 'selected' : '';
}

function checkIfItemExists($itemsArray, $item) {
	return in_array($item, $itemsArray) ? $item : null;
}

function arrayHasString($array, $string) {
	foreach ($array as $key => $value) {
		if (stripos($value, $string) !== false) {
			$values = $value;
			break;
		} else {
			$values = '|:-';
		}
	}
	return $values;
}

function stringHasString($needle, $haystack) {
	if (!is_array($haystack)) {
		if (stripos($haystack, $needle) !== false) {
			return true;
		}
	}

	return false;
}

function isJson($string) {
	json_decode($string);
	return (json_last_error() == JSON_ERROR_NONE);
}

function getDaysForExpiry($package_id) {
	$days = '';
	if ($package_id == 1) {
		$days = '2';
	} else if ($package_id == 2) {
		$days = '4';
	} elseif ($package_id == 3 || $package_id == 4) {
		$days = '7';
	} elseif ($package_id == 5) {
		$days = '15';
	} elseif ($package_id == 6 || $package_id == 7) {
		$days = '30';
	}

	return $days;
}

function getPackageExpiryDate($days) {
	return date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "+" . $days . " days"));
}

function daysToAddToExpiry($package_id) {
	$days = '';
	if ($package_id == 1) {
		$days = '7';
	} else if ($package_id == 2) {
		$days = '14';
	} elseif ($package_id == 3) {
		$days = '30';
	} elseif ($package_id == 4) {
		$days = '90';
	} elseif ($package_id == 5) {
		$days = '180';
	} elseif ($package_id == 6) {
		$days = '360';
	}

	return $days;
}

?>