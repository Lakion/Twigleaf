<?php

/*
 * This file is part of the Twigleaf package.
 *
 * (c) Lakion
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Behat\Behat\Context\BehatContext;
use Behat\Gherkin\Node\PyStringNode;
use Lakion\Twigleaf\Action;
use Lakion\Twigleaf\Loader;
use Lakion\Twigleaf\Override;
use Lakion\Twigleaf\Processor;
use Lakion\Twigleaf\Registry;
use Symfony\Component\Filesystem\Filesystem;
use \Twig_Environment;
use \Twig_Loader_Array;

class TwigleafContext extends BehatContext
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var RegistryInterface
     */
    private $registry;

    /**
     * @var Twig_Loader_Array
     */
    private $loader;

    /**
     * Currently edited override.
     *
     * @var OverrideInterface
     */
    private $override = null;

    /**
     * @BeforeScenario
     */
    public function createEnvironment()
    {
        $this->templates = new Twig_Loader_Array(array());

        $this->registry = new Registry();
        $loader = new Loader($this->templates, new Processor($this->registry));

        $this->twig = new Twig_Environment($loader);
    }

    /**
     * @Given /^the template file "([^"]*)" contains:$/
     */
    public function theTemplateFileContains($template, PyStringNode $string)
    {
        $this->templates->setTemplate($template, $string->getRaw());
    }

    /**
     * @When /^I define new override for "([^"]*)"$/
     */
    public function iDefineNewOverrideFor($template)
    {
        $this->override = new Override($template);
    }

    /**
     * @Given /^it removes elements matching "([^"]*)"$/
     */
    public function itRemovesElementsMatching($selector)
    {
        $this->assertOverrideIsDefined();

        $this->override->addAction(new Action\Remove($selector));
    }

    /**
     * @Given /^it replaces "([^""]*)" with \'([^\']*)\'$/
     */
    public function itReplacesWith($selector, $text)
    {
        $this->assertOverrideIsDefined();

        $this->override->addAction(new Action\Replace($selector, $text));
    }

    /**
     * @Given /^it inserts \'([^\']*)\' before "([^""]*)"$/
     */
    public function itInsertsBefore($text, $selector)
    {
        $this->assertOverrideIsDefined();

        $this->override->addAction(new Action\InsertBefore($selector, $text));
    }

    /**
     * @Given /^it inserts \'([^\']*)\' after "([^""]*)"$/
     */
    public function itInsertsAfter($text, $selector)
    {
        $this->assertOverrideIsDefined();

        $this->override->addAction(new Action\InsertAfter($selector, $text));
    }

   /**
     * @Given /^it sets "([^"]*)" attribute "([^"]*)" to "([^"]*)"$/
     */
    public function itSetsAttributeTo($selector, $attribute, $value)
    {
        $this->assertOverrideIsDefined();

        $this->override->addAction(new Action\AlterAttributes($selector, array($attribute => $value)));
    }

    /**
     * @Given /^it sets "([^"]*)" css attribute "([^"]*)" to "([^"]*)"$/
     */
    public function itSetsCssAttributeTo($selector, $attribute, $value)
    {
        $this->assertOverrideIsDefined();

        $this->override->addAction(new Action\AlterCssAttributes($selector, array($attribute => $value)));
    }

    /**
     * @Given /^it adds class "([^"]*)" to "([^"]*)"$/
     */
    public function itAddsClassTo($class, $selector)
    {
        $this->assertOverrideIsDefined();

        $this->override->addAction(new Action\AlterClasses($selector, array($class => true)));
    }

    /**
     * @Given /^it toggles class "([^"]*)" to "([^"]*)"$/
     */
    public function itTogglesClassTo($class, $selector)
    {
        $this->assertOverrideIsDefined();

        $this->override->addAction(new Action\ToggleClass($selector, $class));
    }

    /**
     * @Given /^it prepends "([^"]*)" with \'([^\']*)\'$/
     */
    public function itPrependsWith($selector, $element)
    {
        $this->assertOverrideIsDefined();

        $this->override->addAction(new Action\Prepend($selector, $element));
    }

    /**
     * @Given /^it appends \'([^\']*)\' to "([^"]*)"$/
     */
    public function itAppendsTo($element, $selector)
    {
        $this->assertOverrideIsDefined();

        $this->override->addAction(new Action\Append($selector, $element));
    }

    /**
     * @Given /^it unwraps "([^"]*)"$/
     */
    public function itUnwrapsFrom($selector)
    {
        $this->assertOverrideIsDefined();

        $this->override->addAction(new Action\Unwrap($selector));
    }

    /**
     * @Given /^it wraps "([^"]*)" with \'([^\']*)\'$/
     */
    public function itWrapsWith($selector, $element)
    {
        $this->assertOverrideIsDefined();

        $this->override->addAction(new Action\Wrap($selector, $element));
    }


    /**
     * @Then /^final source of template "([^"]*)" should be:$/
     */
    public function finalSourceOfTemplateShouldBe($template, PyStringNode $expected)
    {
        if (null !== $this->override) {
            $this->registry->add($this->override);
        }

        $actual = preg_replace("/\r|\n/", "", $this->twig->getLoader()->getSource($template));
        $expected = preg_replace("/\r|\n/", "", $expected->getRaw());

        $actual = preg_replace('~>\s+<~m', '><', $actual);
        $expected = preg_replace('~>\s+<~m', '><', $expected);


        if ($expected !== $actual) {
            $actual   = explode(PHP_EOL, (string) $actual);
            $expected = explode(PHP_EOL, (string) $expected);

            $diff = new \Diff($expected, $actual, array());

            $renderer = new \Diff_Renderer_Text_Unified;
            $text = $diff->render($renderer);

            throw new \Exception(sprintf("Output does not match expected template. \n\n %s", $text));
        }

    }

    /**
     * Assert that override has been initialized.
     *
     * @throws \LogicException
     */
    private function assertOverrideIsDefined()
    {
        if (null === $this->override) {
            throw new \LogicException('Override has to be defined before edition.');
        }
    }
}
