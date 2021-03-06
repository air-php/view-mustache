<?php

namespace Air\View\Mustache;

use Air\View\ViewFactory as BaseViewFactory;
use Air\View\View;
use Air\View\ViewInterface;

class ViewFactory extends BaseViewFactory
{
    /**
     * @var string $fileExtension The file extension to use when looking for views.
     */
    protected $fileExtension = 'mustache';


    /**
     * @param string|null $cacheDir A directory to cache rendered templates into (enables caching).
     * @param string|null $partialsDir A directory where static partials are stored.
     */
    public function __construct($cacheDir = null, $partialsDir = null)
    {
        $this->cacheDir = $cacheDir;
        $this->partialsDir = $partialsDir;
    }


    /**
     * @param string $fileName The name of the file to load.
     * @return ViewInterface A view.
     */
    public function get($fileName)
    {
        return new View(new Renderer($this->cacheDir, $this->partialsDir), $this->find($fileName));
    }


    /**
     * Return a mustache raw template.
     *
     * @param string $fileName The name of the file to load.
     * @return string The unrendered template (raw).
     * @throws \Exception
     */
    public function getUnrendered($fileName)
    {
        return file_get_contents($this->find($fileName));
    }
}
