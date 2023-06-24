<?php 

namespace Scandiweb;

use Scandiweb\Exceptions\ViewNotFound;

class View
{

    public function __construct(private string $path, private array $params = [])
    {
    }

    public static function make(string $path, array $params = []): static
    {
        return new static($path, $params);
    }

    public function render(): string
    {
        if (!file_exists(VIEW_PATH . "{$this->path}.php")) {
            throw new ViewNotFound;
        }

        extract($this->params);

        ob_start();
        include VIEW_PATH . "{$this->path}.php";
        return ob_get_clean();
    }

    public function __toString(): string
    {
        return $this->render();
    }

}