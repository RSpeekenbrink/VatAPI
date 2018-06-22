<?php

namespace App\Classes;

abstract class VatsimParser
{
    /** logical token that represents an error */
    protected $ERROR_TOKEN = "ERROR_ERROR_ERROR;";
    /** Comment */
    protected $COMMENT_LN = ';';

    /** source */
    private $source;
    
    /**
     * parses an entity line e.g. for a pilot, controller or server
     *
     * @param line
     */
    abstract protected function processLine($line);

    /**
     * Parses a file received from the source url and calls {$link {@link #processLine(String)} for
     * a specific entity.
     *
     * @return null
     */
    protected function parse()
    {
        if (!isset($this->source)) {
            $this->processLine($ERROR_TOKEN);
            return;
        }

        try {
            if (filter_var($this->source, FILTER_VALIDATE_URL)) {
                $fileContent = file_get_contents($this->source);

                $lines = explode("\r\n", $fileContent);

                foreach ($lines as $line) {
                    if (strlen($line) > 0) {
                        if (!substr($line, 0, strlen($this->COMMENT_LN) == $this->COMMENT_LN)) {
                            $this->processLine($line);
                        }
                    }
                }

                return;
            }
        } catch (Exception $e) {
            $this->processLine($ERROR_TOKEN);
            return;
        }
    }

    /**
     * Set source url to get the data from
     *
     * @param string source url
     * @return VatsimParser
     */
    protected function setSource($source)
    {
        $this->source = $source;
        return $this;
    }
}
