<?php namespace AnaNTest\Tree\Visitor;


use AnaN\Tree\Factory\Tree;
use AnaN\Tree\Visitor\XMLVisitor;

class XMLVisitorTest extends \PHPUnit_Framework_TestCase
{


	public function testRender()
	{

		$node = Tree::add(Tree::mult('x', 67), Tree::pow(Tree::mult('x', Tree::add(Tree::mult('x', 67), Tree::pow(Tree::mult('x', 24), 2))), 2));
		$xml = XMLVisitor::init();

		$str =  $xml->visit($node);

		echo $str;

		$xml = new \DOMDocument();

		$xml->loadXML($str);

		$this->assertTrue($xml->schemaValidate(__DIR__.'/../../../resources/tree-schema.xsd'));
	}
	public function testRender2()
	{

		$node = Tree::mult(Tree::add('x', 67), Tree::pow(Tree::mult('x',Tree::mult(4,'x'), Tree::add(Tree::mult('x', 67), Tree::pow(Tree::mult('x', 24), 2))), 2));
		$xml = XMLVisitor::init();

		$str =  $xml->visit($node);

		echo $str;

		$xml = new \DOMDocument();

		$xml->loadXML($str);

		$this->assertTrue($xml->schemaValidate(__DIR__.'/../../../resources/tree-schema.xsd'));
	}
}

