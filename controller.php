<?php

namespace Application\Block\Fortune;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\LinkAbstractor;

/**
 * The controller for a random fortune.
 *
 *
 * @author James allenspach <james.allenspach@gmail.com>
 * @copyright  Copyright (c) 2003-2012 Concrete5. (http://www.concrete5.org)
 * @license    http://www.concrete5.org/license/     MIT License
 */
class Controller extends BlockController
{
    protected $btTable = 'btFortuneLocal';
    protected $btInterfaceWidth = "350";
    protected $btInterfaceHeight = "240";
    protected $btDefaultSet = "basic";

    public function getBlockTypeDescription()
    {
        return t("Return a random line of text.");
    }

    public function getBlockTypeName()
    {
        return t("Fortune");
    }

    public function getContent()
    {
	// return LinkAbstractor::translateFrom($this->content);
	return $this->content;
    }

    public function getSearchableContent()
    {
        return $this->content;
    }

    public function br2nl($str)
    {
        $str = str_replace("\r\n", "\n", $str);
        $str = str_replace("<br />\n", "\n", $str);

        return $str;
    }

    public function getImportData($blockNode, $page)
    {
        $content = $blockNode->data->record->content;
        $content = LinkAbstractor::import($content);
        $args = array('content' => $content);

        return $args;
    }

    public function export(\SimpleXMLElement $blockNode)
    {
        $data = $blockNode->addChild('data');
        $data->addAttribute('table', $this->btTable);
        $record = $data->addChild('record');
        $cnode = $record->addChild('content');
        $node = dom_import_simplexml($cnode);
        $no = $node->ownerDocument;
        $content = LinkAbstractor::export($this->content);
        $cdata = $no->createCDataSection($content);
        $node->appendChild($cdata);
    }

    public function save($args)
    {
        /*if(isset($args['content'])) {
            $args['content'] = LinkAbstractor::translateTo($args['content']);
    }*/
        parent::save($args);
    }
    public function getBlockTypeHelp() {
	    return "<p> Just type in a list of lines, and Fortune will display one random line from the text. Lines are of course delimited by Enter/Return. </p>";
    }
}
