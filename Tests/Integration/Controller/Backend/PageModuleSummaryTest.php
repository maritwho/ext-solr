<?php
namespace ApacheSolrForTypo3\Solr\Tests\Integration\Controller\Backend;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010-2017 Timo Hund <timo.schmidt@dkd.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use ApacheSolrForTypo3\Solr\Controller\Backend\PageModuleSummary;
use ApacheSolrForTypo3\Solr\Tests\Integration\IntegrationTest;

/**
 * EXT:solr offers a summary in the backend module that summarizes the extension
 * configuration. This testcase checks if the SummaryController produces the expected output.
 *
 * @author Timo Hund <timo.hund@dkd.de>
 */
class PageModuleSummaryTest extends IntegrationTest
{

    /**
     * @test
     */
    public function canGetSummary() {
        $flexFormData = $this->getFixtureContent('fakeFlexform.xml');

        $fakeRow = ['pi_flexform' => $flexFormData];
        $data = ['row' => $fakeRow];
        $summary = new PageModuleSummary();
        $result = $summary->getSummary($data);

        $this->assertContains('<td>filter:filter</td>', $result, 'Summary did not contain filter');
        $this->assertContains('<td>sorting</td>', $result, 'Summary did not contain sorting');
        $this->assertContains('<td>boostFunction</td>', $result, 'Summary did not contain boostFunction');
        $this->assertContains('<td>boostQuery</td>', $result, 'Summary did not contain boostQuery');
        $this->assertContains('<td>10</td>', $result, 'Summary did not contain resultsPerPage');
    }

}