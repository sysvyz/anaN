<?php namespace AnaN\Tree\Parser;


use AnaN\Tree\ConstantNode;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\VariableNode;

class XmlSaxParser
{

	private $stack = [];


	// Called to this function when tags are opened
	private function startElements()
	{
		return function ($parser, $name, $attrs) {

			if (!in_array($name,[ 'NODE','BASE','EXPONENT'])) {
				$this->stack[] = ['attrs' => $attrs, 'name' => $name, 'children' => []];
			}
		};

	}

	// Called to this function when tags are closed
	private function endElements()
	{
		return function ($parser, $name) {

			if (!in_array($name,[ 'NODE','BASE','EXPONENT'])) {
				$data = array_pop($this->stack);
				switch ($name) {
					case 'VARIABLE':
						$this->_appendToParent(new VariableNode($data['attrs']['VALUE']));
						break;
					case 'CONSTANT':
						$this->_appendToParent(new ConstantNode($data['attrs']['VALUE']));
						break;
					case 'ADDITION':
						$this->_appendToParent(new AdditionNode(... $data['children']));
						break;
					case 'MULTIPLICATION':
						$this->_appendToParent(new ArrayMultiplicationNode(... $data['children']));
						break;
					case 'POWER':
						$this->_appendToParent(new PowerNode(... $data['children']));
						break;

					default:
						break;
				}


			}
		};
	}

// Called on the text between the start and end of the tags
	private function characterData()
	{
		return function ($parser, $data) {

		};
	}

	public function parse($string)
	{
// Creates a new XML parser and returns a resource handle referencing it to be used by the other XML functions.
		$parser = xml_parser_create();

		xml_set_element_handler($parser, $this->startElements(), $this->endElements());
		xml_set_character_data_handler($parser, $this->characterData());


		xml_parse($parser, $string);  // start parsing an xml document


		xml_parser_free($parser); // deletes the parser

		return $this->stack[0]['children'][0];

	}

	private function _appendToParent($param)
	{

		$this->stack[max(count($this->stack) - 1,0)]['children'][] = $param;
	}
}