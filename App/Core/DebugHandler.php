<?php

declare(strict_types=1);

namespace App\Core;

use \App\Core\View;

$errorToString = [
    E_ERROR => "error",
    E_WARNING => "warning",
    E_PARSE => "parse",
    E_NOTICE => "info",
    E_CORE_ERROR => "core_error",
    E_CORE_WARNING => "core_warning",
    E_COMPILE_ERROR => "compile_error",
    E_COMPILE_WARNING => "compile_warning",
    E_USER_ERROR => "error",
    E_USER_WARNING => "warning",
    E_USER_NOTICE => "info",
    E_STRICT => "strict",
    E_RECOVERABLE_ERROR => "recoverable_error",
    E_DEPRECATED => "deprecated",
    E_USER_DEPRECATED => "user_deprecated",
    E_ALL => "all"
];

/**
 * Handles debugging information.
 * 
 * Will support:
 *  - Debug information
 *  - SQL queries
 * 
 * Error messages are automaticalle forwarded to the following 2 locations.
 * 
 * - The next web page that is rendered.
 * - A log file in `Storage/Logs/`.
 * 
 * PHP errors are redirected to here.
 */
class DebugHandler
{
    // Singleton
    public static function getInstance(): DebugHandler
    {
        static $instance = null;

        if (!isset($instance)) {
            $instance = new DebugHandler();
        }

        return $instance;
    }

    /**
     * Setup related to ErrorHandler
     * 
     * Does the following 2 things:
     * 
     * 1. Read any existing errors within the session.
     * 2. Set the php error handler to forward errors to here.
     */
    public function startup(): void
    {
        global $errorToString;
        $this->readFromSession();
        set_error_handler(function (int $errno, string $message, ?string $file = null, ?int $line = null) use ($errorToString) {
            $this->logMessage(
                $errorToString[$errno] ?? "error",
                $message,
                $file,
                $line,
            );
        });
    }

    /**
     * Log a message.
     * 
     * File and line will be automatically set to the place where this function was called from.
     * Manually passing the file and line will take precedence.
     * 
     * @param string $level the level, or severity, of the log message.
     *  `INFO`, `WARNING`, `ERROR`, etc.
     */
    public function logMessage(string $level, string $message, ?string $file = null, ?int $line = null): void
    {
        echo "lmao<br>";
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1)[0];
        $actualFile = $file ?? $backtrace["file"];
        $actualLine = $line ?? $backtrace["line"];
        array_push($this->logs, [
            "level" => $level,
            "message" => $message,
            "file" => $actualFile,
            "line" => $actualLine
        ]);

        $logFile = fopen($this->logFile, "a");

        $fileAndNumber = "";
        if (isset($actualFile)) {
            $fileAndNumber .= "\n    @ " . $actualFile;
            if (isset($actualLine)) {
                $fileAndNumber .= ":" . $actualLine;
            }
        }

        fwrite(
            $logFile,
            "[" . date("H:i:s") . "] [" . $level . "] " . $message . $fileAndNumber . "\n"
        );

        fclose($logFile);
    }

    /**
     * Return all stored log messages formatted for html.
     * 
     * The output will be wrapped in a `<ol class="debug-messages">` element.
     * 
     * @see `Components/LogMessage.php` to see what the output looks like.
     */
    public function injectDebugBar(string $message): string
    {
        $debugBar = "<ol class=\"debug-messages\">";
        foreach ($this->logs as $log) {
            $fileAndNumber = $log["file"];
            if ($fileAndNumber && $log["line"] !== null) {
                $fileAndNumber .= ":" . $log["line"];
            }

            $debugBar .= View::component("DebugMessage", [
                "file" => $log["file"],
                "level" => $log["level"],
                "message" => $log["message"],
                "fileAndNumber" => $fileAndNumber,
            ]);
        }
        $debugBar .= "</ol>\n";
        return str_replace("</body>", $debugBar . "\n</body>", $message);
    }

    /**
     * Store all logs in session.
     * 
     * Should be called just before a redirect.
     * This way the log messages can be retrieved in the following request.
     */
    public function storeInSession(): void
    {
        $_SESSION['logs'] = $this->logs;
        $this->logs = [];
    }

    // Private

    private function readFromSession(): void
    {
        $this->logs = $_SESSION['logs'] ?? [];
        $_SESSION["logs"] = [];
    }

    private function __construct()
    {
        $this->logFile = "Storage/Logs/" . date("Y_m_d") . ".log";
        if (!file_exists("Storage/Logs")) {
            mkdir("Storage/Logs", 0777, true);
        }
    }

    private $logs = [];
    private $logFile = "";
}
