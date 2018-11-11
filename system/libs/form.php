<?php 
class form 
{
	function config_item($item)
	{
		static $_config;

		if (empty($_config))
		{
			// references cannot be directly assigned to static variables, so we use an array
			$_config[0] =& $this->get_config();
		}

		return isset($_config[0][$item]) ? $_config[0][$item] : NULL;
	}
// ------------------------------------------------------------------------
	function html_escape($var, $double_encode = TRUE)
	{
		if (empty($var))
		{
			return $var;
		}

		if (is_array($var))
		{
			foreach (array_keys($var) as $key)
			{
				$var[$key] = html_escape($var[$key], $double_encode);
			}

			return $var;
		}

		return htmlspecialchars($var, ENT_QUOTES,$this->config_item('charset'), $double_encode);
	}


// ------------------------------------------------------------------------
// ------------------------------------------------------------------------

function _parse_form_attributes($attributes, $default)
{
	if (is_array($attributes))
	{
		foreach ($default as $key => $val)
		{
			if (isset($attributes[$key]))
			{
				$default[$key] = $attributes[$key];
				unset($attributes[$key]);
			}
		}

		if (count($attributes) > 0)
		{
			$default = array_merge($default, $attributes);
		}
	}

	$att = '';

	foreach ($default as $key => $val)
	{
		if ($key === 'value')
		{
			$val = $this->html_escape($val);
		}
		elseif ($key === 'name' && ! strlen($default['name']))
		{
			continue;
		}

		$att .= $key.'="'.$val.'" ';
	}

	return $att;
}
// ------------------------------------------------------------------------

function _attributes_to_string($attributes)
{
	if (empty($attributes))
	{
		return '';
	}

	if (is_object($attributes))
	{
		$attributes = (array) $attributes;
	}

	if (is_array($attributes))
	{
		$atts = '';

		foreach ($attributes as $key => $val)
		{
			$atts .= ' '.$key.'="'.$val.'"';
		}

		return $atts;
	}

	if (is_string($attributes))
	{
		return ' '.$attributes;
	}

	return FALSE;
}
// ------------------------------------------------------------------------
function form_open($action = '', $attributes = array(), $hidden = array())
	{
		$CI =& get_instance();

		// If no action is provided then set to the current url
		if ( ! $action)
		{
			$action = $CI->config->site_url($CI->uri->uri_string());
		}
		// If an action is not a full URL then turn it into one
		elseif (strpos($action, '://') === FALSE)
		{
			$action = $CI->config->site_url($action);
		}

		$attributes = _attributes_to_string($attributes);

		if (stripos($attributes, 'method=') === FALSE)
		{
			$attributes .= ' method="post"';
		}

		if (stripos($attributes, 'accept-charset=') === FALSE)
		{
			$attributes .= ' accept-charset="'.strtolower(config_item('charset')).'"';
		}

		$form = '<form action="'.$action.'"'.$attributes.">\n";

		if (is_array($hidden))
		{
			foreach ($hidden as $name => $value)
			{
				$form .= '<input type="hidden" name="'.$name.'" value="'.html_escape($value).'" />'."\n";
			}
		}

		// Add CSRF field if enabled, but leave it out for GET requests and requests to external websites
		if ($CI->config->item('csrf_protection') === TRUE && strpos($action, $CI->config->base_url()) !== FALSE && ! stripos($form, 'method="get"'))
		{
			// Prepend/append random-length "white noise" around the CSRF
			// token input, as a form of protection against BREACH attacks
			if (FALSE !== ($noise = $CI->security->get_random_bytes(1)))
			{
				list(, $noise) = unpack('c', $noise);
			}
			else
			{
				$noise = mt_rand(-128, 127);
			}

			// Prepend if $noise has a negative value, append if positive, do nothing for zero
			$prepend = $append = '';
			if ($noise < 0)
			{
				$prepend = str_repeat(" ", abs($noise));
			}
			elseif ($noise > 0)
			{
				$append  = str_repeat(" ", $noise);
			}

			$form .= sprintf(
				'%s<input type="hidden" name="%s" value="%s" />%s%s',
				$prepend,
				$CI->security->get_csrf_token_name(),
				$CI->security->get_csrf_hash(),
				$append,
				"\n"
			);
		}

		return $form;
	}

// ------------------------------------------------------------------------

function form_open_multipart($action = '', $attributes = array(), $hidden = array())
	{
		if (is_string($attributes))
		{
			$attributes .= ' enctype="multipart/form-data"';
		}
		else
		{
			$attributes['enctype'] = 'multipart/form-data';
		}

		return form_open($action, $attributes, $hidden);
	}

// ------------------------------------------------------------------------

function form_hidden($name, $value = '', $recursing = FALSE)
	{
		static $form;

		if ($recursing === FALSE)
		{
			$form = "\n";
		}

		if (is_array($name))
		{
			foreach ($name as $key => $val)
			{
				form_hidden($key, $val, TRUE);
			}

			return $form;
		}

		if ( ! is_array($value))
		{
			$form .= '<input type="hidden" name="'.$name.'" value="'.html_escape($value)."\" />\n";
		}
		else
		{
			foreach ($value as $k => $v)
			{
				$k = is_int($k) ? '' : $k;
				form_hidden($name.'['.$k.']', $v, TRUE);
			}
		}

		return $form;
	}

// ------------------------------------------------------------------------

function form_input($data = '', $value = '', $extra = '')
{
	$defaults = array(
		'type' => 'text',
		'name' => is_array($data) ? '' : $data,
		'value' => $value
	);

	return '<input '.$this->_parse_form_attributes($data, $defaults).$this->_attributes_to_string($extra)." />\n";
}

// ------------------------------------------------------------------------

function form_password($data = '', $value = '', $extra = '')
	{
		is_array($data) OR $data = array('name' => $data);
		$data['type'] = 'password';
		return form_input($data, $value, $extra);
	}

// ------------------------------------------------------------------------

function form_upload($data = '', $value = '', $extra = '')
{
	$defaults = array('type' => 'file', 'name' => '');
	is_array($data) OR $data = array('name' => $data);
	$data['type'] = 'file';

	return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
}

// ------------------------------------------------------------------------


function form_textarea($data = '', $value = '', $extra = '')
{
	$defaults = array(
		'name' => is_array($data) ? '' : $data,
		'cols' => '40',
		'rows' => '10'
	);

	if ( ! is_array($data) OR ! isset($data['value']))
	{
		$val = $value;
	}
	else
	{
		$val = $data['value'];
		unset($data['value']); // textareas don't use the value attribute
	}

	return '<textarea '._parse_form_attributes($data, $defaults)._attributes_to_string($extra).'>'
		.html_escape($val)
		."</textarea>\n";
}

// ------------------------------------------------------------------------

function form_multiselect($name = '', $options = array(), $selected = array(), $extra = '')
{
	$extra = _attributes_to_string($extra);
	if (stripos($extra, 'multiple') === FALSE)
	{
		$extra .= ' multiple="multiple"';
	}

	return form_dropdown($name, $options, $selected, $extra);
}

// --------------------------------------------------------------------

function form_dropdown($data = '', $options = array(), $selected = array(), $extra = '')
{
	$defaults = array();

	if (is_array($data))
	{
		if (isset($data['selected']))
		{
			$selected = $data['selected'];
			unset($data['selected']); // select tags don't have a selected attribute
		}

		if (isset($data['options']))
		{
			$options = $data['options'];
			unset($data['options']); // select tags don't use an options attribute
		}
	}
	else
	{
		$defaults = array('name' => $data);
	}

	is_array($selected) OR $selected = array($selected);
	is_array($options) OR $options = array($options);

	// If no selected state was submitted we will attempt to set it automatically
	if (empty($selected))
	{
		if (is_array($data))
		{
			if (isset($data['name'], $_POST[$data['name']]))
			{
				$selected = array($_POST[$data['name']]);
			}
		}
		elseif (isset($_POST[$data]))
		{
			$selected = array($_POST[$data]);
		}
	}

	$extra = _attributes_to_string($extra);

	$multiple = (count($selected) > 1 && stripos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

	$form = '<select '.rtrim(_parse_form_attributes($data, $defaults)).$extra.$multiple.">\n";

	foreach ($options as $key => $val)
	{
		$key = (string) $key;

		if (is_array($val))
		{
			if (empty($val))
			{
				continue;
			}

			$form .= '<optgroup label="'.$key."\">\n";

			foreach ($val as $optgroup_key => $optgroup_val)
			{
				$sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
				$form .= '<option value="'.html_escape($optgroup_key).'"'.$sel.'>'
					.(string) $optgroup_val."</option>\n";
			}

			$form .= "</optgroup>\n";
		}
		else
		{
			$form .= '<option value="'.html_escape($key).'"'
				.(in_array($key, $selected) ? ' selected="selected"' : '').'>'
				.(string) $val."</option>\n";
		}
	}

	return $form."</select>\n";
}

// ------------------------------------------------------------------------

function form_checkbox($data = '', $value = '', $checked = FALSE, $extra = '')
{
	$defaults = array('type' => 'checkbox', 'name' => ( ! is_array($data) ? $data : ''), 'value' => $value);

	if (is_array($data) && array_key_exists('checked', $data))
	{
		$checked = $data['checked'];

		if ($checked == FALSE)
		{
			unset($data['checked']);
		}
		else
		{
			$data['checked'] = 'checked';
		}
	}

	if ($checked == TRUE)
	{
		$defaults['checked'] = 'checked';
	}
	else
	{
		unset($defaults['checked']);
	}

	return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
}

// ------------------------------------------------------------------------
function form_radio($data = '', $value = '', $checked = FALSE, $extra = '')
{
	is_array($data) OR $data = array('name' => $data);
	$data['type'] = 'radio';

	return form_checkbox($data, $value, $checked, $extra);
}

// ------------------------------------------------------------------------
function form_submit($data = '', $value = '', $extra = '')
{
	$defaults = array(
		'type' => 'submit',
		'name' => is_array($data) ? '' : $data,
		'value' => $value
	);

	return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
}
// ------------------------------------------------------------------------

function form_reset($data = '', $value = '', $extra = '')
{
	$defaults = array(
		'type' => 'reset',
		'name' => is_array($data) ? '' : $data,
		'value' => $value
	);

	return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
}

// ------------------------------------------------------------------------

function form_button($data = '', $content = '', $extra = '')
{
	$defaults = array(
		'name' => is_array($data) ? '' : $data,
		'type' => 'button'
	);

	if (is_array($data) && isset($data['content']))
	{
		$content = $data['content'];
		unset($data['content']); // content is not an attribute
	}

	return '<button '._parse_form_attributes($data, $defaults)._attributes_to_string($extra).'>'
		.$content
		."</button>\n";
}
// ------------------------------------------------------------------------

function form_label($label_text = '', $id = '', $attributes = array())
{

	$label = '<label';

	if ($id !== '')
	{
		$label .= ' for="'.$id.'"';
	}

	$label .= _attributes_to_string($attributes);

	return $label.'>'.$label_text.'</label>';
}

// ------------------------------------------------------------------------

function form_fieldset($legend_text = '', $attributes = array())
{
	$fieldset = '<fieldset'._attributes_to_string($attributes).">\n";
	if ($legend_text !== '')
	{
		return $fieldset.'<legend>'.$legend_text."</legend>\n";
	}

	return $fieldset;
}

// ------------------------------------------------------------------------
function form_fieldset_close($extra = '')
{
	return '</fieldset>'.$extra;
}

// ------------------------------------------------------------------------

function form_close($extra = '')
{
	return '</form>'.$extra;
}
// ------------------------------------------------------------------------
function form_prep($str)
{
	return html_escape($str, TRUE);
}

// ------------------------------------------------------------------------

function set_value($field, $default = '', $html_escape = TRUE)
{
	$CI =& get_instance();

	$value = (isset($CI->form_validation) && is_object($CI->form_validation) && $CI->form_validation->has_rule($field))
		? $CI->form_validation->set_value($field, $default)
		: $CI->input->post($field, FALSE);

	isset($value) OR $value = $default;
	return ($html_escape) ? html_escape($value) : $value;
}

// ------------------------------------------------------------------------

function set_select($field, $value = '', $default = FALSE)
{
	$CI =& get_instance();

	if (isset($CI->form_validation) && is_object($CI->form_validation) && $CI->form_validation->has_rule($field))
	{
		return $CI->form_validation->set_select($field, $value, $default);
	}
	elseif (($input = $CI->input->post($field, FALSE)) === NULL)
	{
		return ($default === TRUE) ? ' selected="selected"' : '';
	}

	$value = (string) $value;
	if (is_array($input))
	{
		// Note: in_array('', array(0)) returns TRUE, do not use it
		foreach ($input as &$v)
		{
			if ($value === $v)
			{
				return ' selected="selected"';
			}
		}

		return '';
	}

	return ($input === $value) ? ' selected="selected"' : '';
}

// ------------------------------------------------------------------------

function set_checkbox($field, $value = '', $default = FALSE)
{
	$CI =& get_instance();

	if (isset($CI->form_validation) && is_object($CI->form_validation) && $CI->form_validation->has_rule($field))
	{
		return $CI->form_validation->set_checkbox($field, $value, $default);
	}

	// Form inputs are always strings ...
	$value = (string) $value;
	$input = $CI->input->post($field, FALSE);

	if (is_array($input))
	{
		// Note: in_array('', array(0)) returns TRUE, do not use it
		foreach ($input as &$v)
		{
			if ($value === $v)
			{
				return ' checked="checked"';
			}
		}

		return '';
	}

	// Unchecked checkbox and radio inputs are not even submitted by browsers ...
	if ($CI->input->method() === 'post')
	{
		return ($input === $value) ? ' checked="checked"' : '';
	}

	return ($default === TRUE) ? ' checked="checked"' : '';
}

// ------------------------------------------------------------------------

function set_radio($field, $value = '', $default = FALSE)
{
	$CI =& get_instance();

	if (isset($CI->form_validation) && is_object($CI->form_validation) && $CI->form_validation->has_rule($field))
	{
		return $CI->form_validation->set_radio($field, $value, $default);
	}

	// Form inputs are always strings ...
	$value = (string) $value;
	$input = $CI->input->post($field, FALSE);

	if (is_array($input))
	{
		// Note: in_array('', array(0)) returns TRUE, do not use it
		foreach ($input as &$v)
		{
			if ($value === $v)
			{
				return ' checked="checked"';
			}
		}

		return '';
	}

	// Unchecked checkbox and radio inputs are not even submitted by browsers ...
	if ($CI->input->method() === 'post')
	{
		return ($input === $value) ? ' checked="checked"' : '';
	}

	return ($default === TRUE) ? ' checked="checked"' : '';
}

// ------------------------------------------------------------------------


function form_error($field = '', $prefix = '', $suffix = '')
{
	if (FALSE === ($OBJ =& _get_validation_object()))
	{
		return '';
	}

	return $OBJ->error($field, $prefix, $suffix);
}

// ------------------------------------------------------------------------
function validation_errors($prefix = '', $suffix = '')
{
	if (FALSE === ($OBJ =& _get_validation_object()))
	{
		return '';
	}

	return $OBJ->error_string($prefix, $suffix);
}
// // ------------------------------------------------------------------------

// // ------------------------------------------------------------------------

function &_get_validation_object()
{
	$CI =& get_instance();

	// We set this as a variable since we're returning by reference.
	$return = FALSE;

	if (FALSE !== ($object = $CI->load->is_loaded('Form_validation')))
	{
		if ( ! isset($CI->$object) OR ! is_object($CI->$object))
		{
			return $return;
		}

		return $CI->$object;
	}

	return $return;
}

// ------------------------------------------------------------------------

	function is_php($version)
	{
		static $_is_php;
		$version = (string) $version;

		if ( ! isset($_is_php[$version]))
		{
			$_is_php[$version] = version_compare(PHP_VERSION, $version, '>=');
		}

		return $_is_php[$version];
	}

// ------------------------------------------------------------------------


	function is_really_writable($file)
	{
		// If we're on a Unix server with safe_mode off we call is_writable
		if (DIRECTORY_SEPARATOR === '/' && (is_php('5.4') OR ! ini_get('safe_mode')))
		{
			return is_writable($file);
		}

		/* For Windows servers and safe_mode "on" installations we'll actually
		 * write a file then read it. Bah...
		 */
		if (is_dir($file))
		{
			$file = rtrim($file, '/').'/'.md5(mt_rand());
			if (($fp = @fopen($file, 'ab')) === FALSE)
			{
				return FALSE;
			}

			fclose($fp);
			@chmod($file, 0777);
			@unlink($file);
			return TRUE;
		}
		elseif ( ! is_file($file) OR ($fp = @fopen($file, 'ab')) === FALSE)
		{
			return FALSE;
		}

		fclose($fp);
		return TRUE;
	}


// ------------------------------------------------------------------------

	function &load_class($class, $directory = 'libraries', $param = NULL)
	{
		static $_classes = array();

		// Does the class exist? If so, we're done...
		if (isset($_classes[$class]))
		{
			return $_classes[$class];
		}

		$name = FALSE;

		// Look for the class first in the local application/libraries folder
		// then in the native system/libraries folder
		foreach (array(APPPATH, BASEPATH) as $path)
		{
			if (file_exists($path.$directory.'/'.$class.'.php'))
			{
				$name = 'CI_'.$class;

				if (class_exists($name, FALSE) === FALSE)
				{
					require_once($path.$directory.'/'.$class.'.php');
				}

				break;
			}
		}

		// Is the request a class extension? If so we load it too
		if (file_exists(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php'))
		{
			$name = config_item('subclass_prefix').$class;

			if (class_exists($name, FALSE) === FALSE)
			{
				require_once(APPPATH.$directory.'/'.$name.'.php');
			}
		}

		// Did we find the class?
		if ($name === FALSE)
		{
			// Note: We use exit() rather than show_error() in order to avoid a
			// self-referencing loop with the Exceptions class
			set_status_header(503);
			echo 'Unable to locate the specified class: '.$class.'.php';
			exit(5); // EXIT_UNK_CLASS
		}

		// Keep track of what we just loaded
		is_loaded($class);

		$_classes[$class] = isset($param)
			? new $name($param)
			: new $name();
		return $_classes[$class];
	}


// --------------------------------------------------------------------


	function &is_loaded($class = '')
	{
		static $_is_loaded = array();

		if ($class !== '')
		{
			$_is_loaded[strtolower($class)] = $class;
		}

		return $_is_loaded;
	}


// ------------------------------------------------------------------------

	function &get_config(Array $replace = array())
	{
		static $config;

		if (empty($config))
		{
			$file_path = APPPATH.'config/config.php';
			$found = FALSE;
			if (file_exists($file_path))
			{
				$found = TRUE;
				require($file_path);
			}

			// Is the config file in the environment folder?
			if (file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/config.php'))
			{
				require($file_path);
			}
			elseif ( ! $found)
			{
				set_status_header(503);
				echo 'The configuration file does not exist.';
				exit(3); // EXIT_CONFIG
			}

			// Does the $config array exist in the file?
			if ( ! isset($config) OR ! is_array($config))
			{
				set_status_header(503);
				echo 'Your config file does not appear to be formatted correctly.';
				exit(3); // EXIT_CONFIG
			}
		}

		// Are any values being dynamically added or replaced?
		foreach ($replace as $key => $val)
		{
			$config[$key] = $val;
		}

		return $config;
	}


// ------------------------------------------------------------------------
	


// ------------------------------------------------------------------------


	function &get_mimes()
	{
		static $_mimes;

		if (empty($_mimes))
		{
			$_mimes = file_exists(APPPATH.'config/mimes.php')
				? include(APPPATH.'config/mimes.php')
				: array();

			if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/mimes.php'))
			{
				$_mimes = array_merge($_mimes, include(APPPATH.'config/'.ENVIRONMENT.'/mimes.php'));
			}
		}

		return $_mimes;
	}


// ------------------------------------------------------------------------


	function is_https()
	{
		if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
		{
			return TRUE;
		}
		elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')
		{
			return TRUE;
		}
		elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')
		{
			return TRUE;
		}

		return FALSE;
	}


// ------------------------------------------------------------------------

	function is_cli()
	{
		return (PHP_SAPI === 'cli' OR defined('STDIN'));
	}


// ------------------------------------------------------------------------


	function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered')
	{
		$status_code = abs($status_code);
		if ($status_code < 100)
		{
			$exit_status = $status_code + 9; // 9 is EXIT__AUTO_MIN
			$status_code = 500;
		}
		else
		{
			$exit_status = 1; // EXIT_ERROR
		}

		$_error =& load_class('Exceptions', 'core');
		echo $_error->show_error($heading, $message, 'error_general', $status_code);
		exit($exit_status);
	}


// ------------------------------------------------------------------------

	function show_404($page = '', $log_error = TRUE)
	{
		$_error =& load_class('Exceptions', 'core');
		$_error->show_404($page, $log_error);
		exit(4); // EXIT_UNKNOWN_FILE
	}

// ------------------------------------------------------------------------


	function log_message($level, $message)
	{
		static $_log;

		if ($_log === NULL)
		{
			// references cannot be directly assigned to static variables, so we use an array
			$_log[0] =& load_class('Log', 'core');
		}

		$_log[0]->write_log($level, $message);
	}


// ------------------------------------------------------------------------

	function set_status_header($code = 200, $text = '')
	{
		if (is_cli())
		{
			return;
		}

		if (empty($code) OR ! is_numeric($code))
		{
			show_error('Status codes must be numeric', 500);
		}

		if (empty($text))
		{
			is_int($code) OR $code = (int) $code;
			$stati = array(
				100	=> 'Continue',
				101	=> 'Switching Protocols',

				200	=> 'OK',
				201	=> 'Created',
				202	=> 'Accepted',
				203	=> 'Non-Authoritative Information',
				204	=> 'No Content',
				205	=> 'Reset Content',
				206	=> 'Partial Content',

				300	=> 'Multiple Choices',
				301	=> 'Moved Permanently',
				302	=> 'Found',
				303	=> 'See Other',
				304	=> 'Not Modified',
				305	=> 'Use Proxy',
				307	=> 'Temporary Redirect',

				400	=> 'Bad Request',
				401	=> 'Unauthorized',
				402	=> 'Payment Required',
				403	=> 'Forbidden',
				404	=> 'Not Found',
				405	=> 'Method Not Allowed',
				406	=> 'Not Acceptable',
				407	=> 'Proxy Authentication Required',
				408	=> 'Request Timeout',
				409	=> 'Conflict',
				410	=> 'Gone',
				411	=> 'Length Required',
				412	=> 'Precondition Failed',
				413	=> 'Request Entity Too Large',
				414	=> 'Request-URI Too Long',
				415	=> 'Unsupported Media Type',
				416	=> 'Requested Range Not Satisfiable',
				417	=> 'Expectation Failed',
				422	=> 'Unprocessable Entity',
				426	=> 'Upgrade Required',
				428	=> 'Precondition Required',
				429	=> 'Too Many Requests',
				431	=> 'Request Header Fields Too Large',

				500	=> 'Internal Server Error',
				501	=> 'Not Implemented',
				502	=> 'Bad Gateway',
				503	=> 'Service Unavailable',
				504	=> 'Gateway Timeout',
				505	=> 'HTTP Version Not Supported',
				511	=> 'Network Authentication Required',
			);

			if (isset($stati[$code]))
			{
				$text = $stati[$code];
			}
			else
			{
				show_error('No status text available. Please check your status code number or supply your own message text.', 500);
			}
		}

		if (strpos(PHP_SAPI, 'cgi') === 0)
		{
			header('Status: '.$code.' '.$text, TRUE);
			return;
		}

		$server_protocol = (isset($_SERVER['SERVER_PROTOCOL']) && in_array($_SERVER['SERVER_PROTOCOL'], array('HTTP/1.0', 'HTTP/1.1', 'HTTP/2'), TRUE))
			? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
		header($server_protocol.' '.$code.' '.$text, TRUE, $code);
	}


// --------------------------------------------------------------------


	function _error_handler($severity, $message, $filepath, $line)
	{
		$is_error = (((E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR | E_USER_ERROR) & $severity) === $severity);

		// When an error occurred, set the status header to '500 Internal Server Error'
		// to indicate to the client something went wrong.
		// This can't be done within the $_error->show_php_error method because
		// it is only called when the display_errors flag is set (which isn't usually
		// the case in a production environment) or when errors are ignored because
		// they are above the error_reporting threshold.
		if ($is_error)
		{
			set_status_header(500);
		}

		// Should we ignore the error? We'll get the current error_reporting
		// level and add its bits with the severity bits to find out.
		if (($severity & error_reporting()) !== $severity)
		{
			return;
		}

		$_error =& load_class('Exceptions', 'core');
		$_error->log_exception($severity, $message, $filepath, $line);

		// Should we display the error?
		if (str_ireplace(array('off', 'none', 'no', 'false', 'null'), '', ini_get('display_errors')))
		{
			$_error->show_php_error($severity, $message, $filepath, $line);
		}

		// If the error is fatal, the execution of the script should be stopped because
		// errors can't be recovered from. Halting the script conforms with PHP's
		// default error handling. See http://www.php.net/manual/en/errorfunc.constants.php
		if ($is_error)
		{
			exit(1); // EXIT_ERROR
		}
	}


// ------------------------------------------------------------------------

	function _exception_handler($exception)
	{
		$_error =& load_class('Exceptions', 'core');
		$_error->log_exception('error', 'Exception: '.$exception->getMessage(), $exception->getFile(), $exception->getLine());

		is_cli() OR set_status_header(500);
		// Should we display the error?
		if (str_ireplace(array('off', 'none', 'no', 'false', 'null'), '', ini_get('display_errors')))
		{
			$_error->show_exception($exception);
		}

		exit(1); // EXIT_ERROR
	}


// ------------------------------------------------------------------------


	function _shutdown_handler()
	{
		$last_error = error_get_last();
		if (isset($last_error) &&
			($last_error['type'] & (E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING)))
		{
			_error_handler($last_error['type'], $last_error['message'], $last_error['file'], $last_error['line']);
		}
	}


// --------------------------------------------------------------------


	function remove_invisible_characters($str, $url_encoded = TRUE)
	{
		$non_displayables = array();

		// every control character except newline (dec 10),
		// carriage return (dec 13) and horizontal tab (dec 09)
		if ($url_encoded)
		{
			$non_displayables[] = '/%0[0-8bcef]/i';	// url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/i';	// url encoded 16-31
			$non_displayables[] = '/%7f/i';	// url encoded 127
		}

		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

		do
		{
			$str = preg_replace($non_displayables, '', $str, -1, $count);
		}
		while ($count);

		return $str;
	}


// ------------------------------------------------------------------------

	


// ------------------------------------------------------------------------


	function _stringify_attributes($attributes, $js = FALSE)
	{
		$atts = NULL;

		if (empty($attributes))
		{
			return $atts;
		}

		if (is_string($attributes))
		{
			return ' '.$attributes;
		}

		$attributes = (array) $attributes;

		foreach ($attributes as $key => $val)
		{
			$atts .= ($js) ? $key.'='.$val.',' : ' '.$key.'="'.$val.'"';
		}

		return rtrim($atts, ',');
	}


// ------------------------------------------------------------------------


	function function_usable($function_name)
	{
		static $_suhosin_func_blacklist;

		if (function_exists($function_name))
		{
			if ( ! isset($_suhosin_func_blacklist))
			{
				$_suhosin_func_blacklist = extension_loaded('suhosin')
					? explode(',', trim(ini_get('suhosin.executor.func.blacklist')))
					: array();
			}

			return ! in_array($function_name, $_suhosin_func_blacklist, TRUE);
		}

		return FALSE;
	}



}// ket thuc form 

?>
