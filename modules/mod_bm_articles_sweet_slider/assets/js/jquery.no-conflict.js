if (typeof jQuery === 'undefined') {
	alert('Has no jQuery loaded for the module!');
}
else
{
	var jqbm = jQuery.noConflict(true);
	jQuery = jqbm;
}
