<?php 


namespace App\Classes\SessionStorage;


class SessionStorage implements StorageInterface
{
    protected $bucket;

    public function __construct(string $bucket = 'default')
    {
        if (! isset($_SESSION[$bucket])) {
            $_SESSION[$bucket] = [];
        }

        $this->bucket = $bucket;
    }

    public function get($index)
    {
        return $this->exists($index) ? $_SESSION[$this->bucket][$index] : null;
    }

    public function set($index, $value)
    {
        $_SESSION[$this->bucket][$index] = $value;
    }

    public function all()
    {
        return $_SESSION[$this->bucket];
    }

    public function exists($index)
    {
        return isset($_SESSION[$this->bucket][$index]);
    }

    public function unset($index)
    {
        if ($this->exists($index)) {
            unset($_SESSION[$this->bucket][$index]);
        }
    }

    public function clear()
    {
        unset($_SESSION[$this->bucket]);
    }

    public function count()
    {
        return count($this->all());
    }
}