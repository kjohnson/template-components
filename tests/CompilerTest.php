<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TemplateComponents\Component;
use TemplateComponents\Compiler;

final class CompilerTest extends TestCase
{
    public function testCompilesAComponent(): void
    {
        $compiler = new Compiler(
            new Component( 'foo', '<div>foo</div>' )
        );

        $this->assertEquals(
            $compiler->compile( '<x-foo></x-foo>' ),
            '<div>foo</div>'
        );
    }

    public function testCompilesAComponentWithContents(): void
    {
        $compiler = new Compiler(
            new Component( 'foo', '<div>{{ slot }}</div>' )
        );

        $this->assertEquals(
            $compiler->compile( '<x-foo>foo</x-foo>' ),
            '<div>foo</div>'
        );
    }

    public function testCompilesAComponentFromTemplateFile(): void
    {
        $template = file_get_contents( dirname(__FILE__) . '/templates/static.html' );

        $compiler = new Compiler(
            new Component( 'foo', $template )
        );

        $this->assertEquals(
            $compiler->compile( '<x-foo></x-foo>' ),
            '<div></div>'
        );
    }

    public function testCompilesMultipleComponents(): void
    {
        $compiler = new Compiler(
            new Component( 'foo', '<div>foo</div>' ),
            new Component( 'bar', '<span>bar</span>' )
        );

        $this->assertEquals(
            $compiler->compile( '<x-foo></x-foo><x-bar></x-bar>' ),
            '<div>foo</div><span>bar</span>'
        );
    }

    public function testCompilesNestedComponents(): void
    {
        $compiler = new Compiler(
            new Component( 'foo', '<div>{{ slot }}</div>' ),
            new Component( 'bar', '<span>bar</span>' )
        );

        $this->assertEquals(
            $compiler->compile( '<x-foo><x-bar></x-bar></x-foo>' ),
            '<div><span>bar</span></div>'
        );
    }
}