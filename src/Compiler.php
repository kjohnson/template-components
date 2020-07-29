<?php

namespace TemplateComponents;

class Compiler {
    public function __construct( Component ...$components ) {
        foreach( $components as $component ) {
            $this->components[ $component->name ] = $component;
        }
    }

    public function compile( $html ) {

        $html = $this->prepare( $html );

        $components = [];
        preg_match("~<x-(\w*)>.*<\/x-(\w*)>~i", $html, $components );

        $raw = array_shift( $components );

        return array_reduce( $components, function( $html, $componentName ) use ( $raw ) {
            $component = $this->components[ $componentName ];

            $compiled = $this->compileComponent( $component, $raw );
            return preg_replace( "~<x-{$component->name}>(.*)</x-{$component->name}>~i", $compiled, $html );
        }, $html);
    }

    protected function prepare( $html ) {
        return str_replace(array("\n", "\r"), '', $html );
    }

    protected function compileComponent( Component $component, $raw ) {
        $match = [];
        preg_match("~<x-{$component->name}>(.*)</x-{$component->name}>~i", $raw, $match );

        list( $raw, $contents ) = $match;
        $compiledContents = $this->compile( $contents );
        return preg_replace( '/{{\s*slot\s*}}/', $compiledContents, $component->template );
    }
}