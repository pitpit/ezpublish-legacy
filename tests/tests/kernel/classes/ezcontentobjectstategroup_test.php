<?php
/**
 * File containing the eZContentObjectStateGroupTest class
 *
 * @copyright Copyright (C) 1999-2014 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 * @package tests
 */

class eZContentObjectStateGroupTest extends ezpDatabaseTestCase
{
    public function providerCreateWithInvalidIdentifier()
    {
        return array(
            array( 'WithUpperCaseChars' ),
            array( str_repeat( 'x', 46 ) )
        );
    }

    /**
     * @dataProvider providerCreateWithInvalidIdentifier
     */
    public function testCreateWithInvalidIdentifier( $identifier )
    {
        $row = array( 'identifier' => $identifier );
        $stateGroup = new eZContentObjectStateGroup( $row );
        $trans = $stateGroup->translationByLocale( 'eng-GB' );
        $trans->setAttribute( 'name', $identifier );
        $messages = array();
        $this->assertFalse( $stateGroup->isValid( $messages ), "Invalid state group identifier '$identifier' was accepted" );
    }

    public function providerCreateWithvalidIdentifier()
    {
        return array(
            array( 'lowercasechars' ),
            array( str_repeat( 'x', 45 ) )
        );
    }

    /**
     * @dataProvider providerCreateWithValidIdentifier
     */
    public function testCreateWithvalidIdentifier( $identifier )
    {
        $row = array( 'identifier' => $identifier );
        $stateGroup = new eZContentObjectStateGroup( $row );
        $trans = $stateGroup->translationByLocale( 'eng-GB' );
        $trans->setAttribute( 'name', $identifier );
        $messages = array();
        $this->assertTrue( $stateGroup->isValid( $messages ), "Valid state group identifier '$identifier' was refused, " . var_export( $messages, true ) );
    }

    public static function suite()
    {
        return new PHPUnit_Framework_TestSuite( "eZContentObjectStateGroupTest" );
    }
}

?>
