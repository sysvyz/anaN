<?php namespace AnaNTest\Tree;


use AnaN\Tree\Interfaces\NodeInterface;
use AnaN\Tree\Parser\XmlSaxParser;

class XMLParserTest extends \PHPUnit_Framework_TestCase
{

	public function testMe()
	{
		$p = new XmlSaxParser();
		$node = $p->parse(file_get_contents(__DIR__.'/../../test.xml'));
		$this->assertInstanceOf(NodeInterface::class,$node);

	}
}
