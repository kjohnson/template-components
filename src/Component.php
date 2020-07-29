<?php

namespace TemplateComponents;

class Component {

    public function __construct( $name, $template ) {
        $this->name = $name;
        $this->template = $template;
    }
}