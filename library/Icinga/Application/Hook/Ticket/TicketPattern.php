<?php
/* Icinga Web 2 | (c) 2016 Icinga Development Team | GPLv2+ */

namespace Icinga\Application\Hook\Ticket;

use ArrayAccess;

/**
 * A ticket pattern
 *
 * This class should be used by modules which provide implementations for the Web 2 ticket hook.
 * Have a look at the GenericTTS module for a possible use case.
 */
class TicketPattern implements ArrayAccess
{
    /**
     * The result of a performed ticket match
     *
     * @var array
     */
    protected $match = array();

    /**
     * The name of the TTS integration
     *
     * @var string
     */
    protected $name;

    /**
     * The ticket pattern
     *
     * @var string
     */
    protected $pattern;

    public function offsetExists($offset): bool
    {
        return isset($this->match[$offset]);
    }

    public function offsetGet($offset): ?string
    {
        return array_key_exists($offset, $this->match) ? $this->match[$offset] : null;
    }

    public function offsetSet($offset, $value): void
    {
        if ($offset === null) {
            $this->match[] = $value;
        } else {
            $this->match[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->match[$offset]);
    }


    /**
     * Get the result of a performed ticket match
     *
     * @return  array
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set the result of a performed ticket match
     *
     * @param   array   $match
     *
     * @return  $this
     */
    public function setMatch(array $match)
    {
        $this->match = $match;
        return $this;
    }

    /**
     * Get the name of the TTS integration
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name of the TTS integration
     *
     * @param   string  $name
     *
     * @return  $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the ticket pattern
     *
     * @return  string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Set the ticket pattern
     *
     * @param   string  $pattern
     *
     * @return  $this
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * Whether the integration is properly configured, i.e. the pattern and the URL are not empty
     *
     * @return bool
     */
    public function isValid()
    {
        return ! empty($this->pattern);
    }
}
