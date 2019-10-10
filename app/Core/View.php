<?php

namespace Mvcify\Core;

class View
{
    /**
     * The layout to be used. Set FALSE to disable layout.
     *
     * @var bool|string
     */
    public $layout = 'standard';

    /**
     * Used for holding the content of the view script.
     *
     * @var string
     */
    public $content = '';

    /**
     * Initializes the data array.
     *
     * @var array
     */
    public $data = array();

    /**
     * Intializes the additional JavaScripts.
     *
     * @var array
     */
    public $java_scripts = array();

    /**
     * Renders the current view.
     */
    public function renderFile($view_file)
    {
        // Render the view script and store the output in '$this->content'.
        if (file_exists($view_file)) {
            ob_start();
            include $view_file;
            $this->content = ob_get_clean();
        }

        // If the layout is enabled render the '$this->content' in our specified layout.
        if ($this->layout) {
            include APP_PATH . '/View/_layouts/' . $this->layout . '.php';
        } else {
            echo $this->content;
        }
    }

    /**
     * Send a JSON response back to a request.
     */
    public function sendJson($response, $status_code = null)
    {
        @header('Content-type: application/json; charset=utf-8');
        if (null !== $status_code) {
            $this->setStatusHeader($status_code);
        }
        echo json_encode($response);
        die;
    }

    /**
     * Set HTTP status header.
     */
    public function setStatusHeader($code, $description = '')
    {
        $code = absint($code);
        if (! $description) {
            $header_description = array(
                100 => 'Continue',
                101 => 'Switching Protocols',
                102 => 'Processing',
                103 => 'Early Hints',

                200 => 'OK',
                201 => 'Created',
                202 => 'Accepted',
                203 => 'Non-Authoritative Information',
                204 => 'No Content',
                205 => 'Reset Content',
                206 => 'Partial Content',
                207 => 'Multi-Status',
                226 => 'IM Used',

                300 => 'Multiple Choices',
                301 => 'Moved Permanently',
                302 => 'Found',
                303 => 'See Other',
                304 => 'Not Modified',
                305 => 'Use Proxy',
                306 => 'Reserved',
                307 => 'Temporary Redirect',
                308 => 'Permanent Redirect',

                400 => 'Bad Request',
                401 => 'Unauthorized',
                402 => 'Payment Required',
                403 => 'Forbidden',
                404 => 'Not Found',
                405 => 'Method Not Allowed',
                406 => 'Not Acceptable',
                407 => 'Proxy Authentication Required',
                408 => 'Request Timeout',
                409 => 'Conflict',
                410 => 'Gone',
                411 => 'Length Required',
                412 => 'Precondition Failed',
                413 => 'Request Entity Too Large',
                414 => 'Request-URI Too Long',
                415 => 'Unsupported Media Type',
                416 => 'Requested Range Not Satisfiable',
                417 => 'Expectation Failed',
                418 => 'I\'m a teapot',
                421 => 'Misdirected Request',
                422 => 'Unprocessable Entity',
                423 => 'Locked',
                424 => 'Failed Dependency',
                426 => 'Upgrade Required',
                428 => 'Precondition Required',
                429 => 'Too Many Requests',
                431 => 'Request Header Fields Too Large',
                451 => 'Unavailable For Legal Reasons',

                500 => 'Internal Server Error',
                501 => 'Not Implemented',
                502 => 'Bad Gateway',
                503 => 'Service Unavailable',
                504 => 'Gateway Timeout',
                505 => 'HTTP Version Not Supported',
                506 => 'Variant Also Negotiates',
                507 => 'Insufficient Storage',
                510 => 'Not Extended',
                511 => 'Network Authentication Required',
            );

            if (isset($header_description[ $code ])) {
                $description = $header_description[ $code ];
            }
        }

        if (empty($description)) {
            return;
        }

        $protocol = $_SERVER['SERVER_PROTOCOL'];
        if (! in_array($protocol, array( 'HTTP/1.1', 'HTTP/2', 'HTTP/2.0' ))) {
            $protocol = 'HTTP/1.0';
        }

        @header("$protocol $code $description", true, $code);
    }

    /**
     * Adds a new javascript to the header.
     *
     * @param string $script the path to the script to add
     */
    public function addJavaScript($src, $async = false, $defer = false)
    {
        $async = $async ? ' async' : '';
        $defer = $defer ? ' defer' : '';
        $this->java_scripts[] = '<script' . $async . $defer .' type="text/javascript" src="' . $src . '"></script>';
    }

    /**
     * Print the added JavaScripts
     */
    public function printJavaScripts()
    {
        echo implode(PHP_EOL, $this->java_scripts);
    }

    /**
     * Store the given data on the given key.
     *
     * @param string $key the key to store the data under
     * @param mixed $value the value to store
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Return the data if it exists, else null.
     *
     * @param string $key the data to look for
     * @return mixed the data found or null
     */
    public function __get($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        return null;
    }
}
