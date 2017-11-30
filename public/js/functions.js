function getUrl(route) {
	return location.protocol + '//' + location.host + route;
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}