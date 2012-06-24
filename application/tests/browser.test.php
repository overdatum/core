<?php

class WebTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://test.getlayla.com');
    }
 
    public function testReadPagesTitle()
    {
        $this->url('manage/pages');
        $this->assertEquals('| Layla', $this->title());
    }

    public function testReadAccountsTitle()
    {
        $this->url('manage/accounts');
        $this->assertEquals('| Layla', $this->title());
    }

    public function testReadAccountsView()
    {
        $this->url('manage/accounts');
        $element = $this->byCssSelector('ul.items li a');
        $this->assertEquals('Administrator - admin@admin.com', $element->text());
    }
}