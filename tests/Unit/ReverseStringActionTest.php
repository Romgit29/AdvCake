<?php

namespace Tests\Unit;

use App\Actions\ReverseStringAction;
use PHPUnit\Framework\TestCase;

class ReverseStringActionTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_basic(): void
    {
        $reverseStringAction = new ReverseStringAction();

        $result = $reverseStringAction->execute('Cat');
        $this->assertEquals('Tac', $result);
        $result = $reverseStringAction->execute('Мышь');
        $this->assertEquals('Ьшым', $result);
        $result = $reverseStringAction->execute('houSe');
        $this->assertEquals('esuOh', $result);
        $result = $reverseStringAction->execute('домИК');
        $this->assertEquals('кимОД', $result);
        $result = $reverseStringAction->execute('elEpHant');
        $this->assertEquals('tnAhPele', $result);
        $result = $reverseStringAction->execute('cat');
        $this->assertEquals('tac', $result);
        $result = $reverseStringAction->execute('Зима');
        $this->assertEquals('Амиз', $result);
    }

    public function test_quotes(): void
    {
        $reverseStringAction = new ReverseStringAction();

        $result = $reverseStringAction->execute("is 'cold' now");
        $this->assertEquals("si 'dloc' won", $result);
        $result = $reverseStringAction->execute('это «Так» "просто"');
        $this->assertEquals('отэ «Кат» "отсорп"', $result);
    }

    public function test_dash(): void
    {
        $reverseStringAction = new ReverseStringAction();

        $result = $reverseStringAction->execute('third-part');
        $this->assertEquals('driht-trap', $result);
    }

    public function test_apostrophe(): void
    {
        $reverseStringAction = new ReverseStringAction();

        $result = $reverseStringAction->execute('can`t');
        $this->assertEquals('nac`t', $result);
    }
}
