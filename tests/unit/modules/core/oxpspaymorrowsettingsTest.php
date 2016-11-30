<?php
/**
 * This file is part of the OXID module for Paymorrow payment.
 *
 * The OXID module for Paymorrow payment is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.
 *
 * The OXID eShop module for Paymorrow payment is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General
 * Public License for more details.
 *
 * Linking this library statically or dynamically with other modules is making a
 * combined work based on this library. Thus, the terms and conditions of the GNU
 * General Public License cover the whole combination.
 * As a special exception, the copyright holders of this library give you
 * permission to link this library with independent modules to produce an
 * executable, regardless of the license terms of these independent modules, and
 * to copy and distribute the resulting executable under terms of your choice,
 * provided that you also meet, for each linked independent module, the terms and
 * conditions of the license of that module. An independent module is a module
 * which is not derived from or based on this library. If you modify this library,
 * you may extend this exception to your version of the library, but you are not
 * obliged to do so. If you do not wish to do so, delete this exception statement
 * from your version.
 *
 * You should have received a copy of the GNU General Public License along with
 * the OXID module for Paymorrow payment. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Class Unit_Module_Controllers_OxpsPaymorrowSettingsTest
 *
 * @see OxpsPaymorrowSettings
 */
class Unit_Module_Controllers_OxpsPaymorrowSettingsTest extends OxidTestCase
{

    /**
     * @var OxpsPaymorrowSettings
     */
    protected $SUT;


    /**
     * Set initial objects state.
     *
     * @return null|void
     */
    public function setUp()
    {
        parent::setUp();

        // SUT mock
        $this->SUT = $this->getMock( 'OxpsPaymorrowSettings', array('__construct') );
    }


    /**
     * Mocking Proxy Class to test Protected methods
     *
     * IDE - might underline methods with RED color, PLEASE IGNORE
     *
     * @param array $aParams
     *
     * @return oxpspaymorrowsettings
     */
    protected function _getProxySUT( array $aParams = array() )
    {
        return $this->getProxyClass( 'OxpsPaymorrowSettings', $aParams );
    }


    public function testGetMerchantID_nothingSet_returnEmptyString()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', '' );
        modConfig::getInstance()->setConfigParam( 'paymorrowMerchantId', '' );
        modConfig::getInstance()->setConfigParam( 'paymorrowMerchantIdTest', '' );

        $this->assertSame( '', $this->SUT->getMerchantId() );
    }

    public function testGetMerchantID_sandboxModeIsOff_returnLiveMerchantId()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', 0 );
        modConfig::getInstance()->setConfigParam( 'paymorrowMerchantId', 'Merch1-Live' );
        modConfig::getInstance()->setConfigParam( 'paymorrowMerchantIdTest', 'Merch1-Test' );

        $this->assertSame( 'Merch1-Live', $this->SUT->getMerchantId() );
    }

    public function testGetMerchantID_sandboxModeIsOn_returnLiveMerchantId()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', 1 );
        modConfig::getInstance()->setConfigParam( 'paymorrowMerchantId', 'Merch1-Live' );
        modConfig::getInstance()->setConfigParam( 'paymorrowMerchantIdTest', 'Merch1-Test' );

        $this->assertSame( 'Merch1-Test', $this->SUT->getMerchantId() );
    }


    public function testGetPrivateKey_nothingSet_returnEmptyString()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', '' );
        modConfig::getInstance()->setConfigParam( 'paymorrowPrivateKey', '' );
        modConfig::getInstance()->setConfigParam( 'paymorrowPrivateKeyTest', '' );

        $this->assertSame( '', $this->SUT->getPrivateKey() );
    }

    public function testGetPrivateKey_sandboxModeIsOff_returnPrivateKeyForLiveMode()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', 0 );
        modConfig::getInstance()->setConfigParam( 'paymorrowPrivateKey', 'TElWRS1LRVk=' );
        modConfig::getInstance()->setConfigParam( 'paymorrowPrivateKeyTest', 'VEVTVC1LRVk=' );

        $this->assertSame( 'LIVE-KEY', $this->SUT->getPrivateKey() );
    }

    public function testGetPrivateKey_sandboxModeIsOn_returnPrivateKeyForTestMode()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', 1 );
        modConfig::getInstance()->setConfigParam( 'paymorrowPrivateKey', 'TElWRS1LRVk=' );
        modConfig::getInstance()->setConfigParam( 'paymorrowPrivateKeyTest', 'VEVTVC1LRVk=' );

        $this->assertSame( 'TEST-KEY', $this->SUT->getPrivateKey() );
    }


    public function testGetPublicKey_nothingSet_returnEmptyString()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', '' );
        modConfig::getInstance()->setConfigParam( 'paymorrowPublicKey', '' );
        modConfig::getInstance()->setConfigParam( 'paymorrowPublicKeyTest', '' );

        $this->assertSame( '', $this->SUT->getPublicKey() );
    }

    public function testGetPublicKey_sandboxModeIsOff_returnPublicKeyForLiveMode()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', 0 );
        modConfig::getInstance()->setConfigParam( 'paymorrowPublicKey', 'TElWRS1DRVJU' );
        modConfig::getInstance()->setConfigParam( 'paymorrowPublicKeyTest', 'VEVTVC1DRVJU' );

        $this->assertSame( 'LIVE-CERT', $this->SUT->getPublicKey() );
    }

    public function testGetPublicKey_sandboxModeIsOn_returnPublicKeyForTestMode()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', 1 );
        modConfig::getInstance()->setConfigParam( 'paymorrowPublicKey', 'TElWRS1DRVJU' );
        modConfig::getInstance()->setConfigParam( 'paymorrowPublicKeyTest', 'VEVTVC1DRVJU' );

        $this->assertSame( 'TEST-CERT', $this->SUT->getPublicKey() );
    }


    public function testGetPaymorrowKey_nothingSet_returnEmptyString()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', '' );
        modConfig::getInstance()->setConfigParam( 'paymorrowPaymorrowKey', '' );
        modConfig::getInstance()->setConfigParam( 'paymorrowPaymorrowKeyTest', '' );

        $this->assertSame( '', $this->SUT->getPaymorrowKey() );
    }

    public function testGetPaymorrowKey_sandboxModeIsOff_returnPaymorrowPublicKeyForLiveMode()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', 0 );
        modConfig::getInstance()->setConfigParam( 'paymorrowPaymorrowKey', 'TElWRS1QTQ==' );
        modConfig::getInstance()->setConfigParam( 'paymorrowPaymorrowKeyTest', 'VEVTVC1QTQ==' );

        $this->assertSame( 'LIVE-PM', $this->SUT->getPaymorrowKey() );
    }

    public function testGetPaymorrowKey_sandboxModeIsOn_returnPaymorrowPublicKeyForTestMode()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', 1 );
        modConfig::getInstance()->setConfigParam( 'paymorrowPaymorrowKey', 'TElWRS1QTQ==' );
        modConfig::getInstance()->setConfigParam( 'paymorrowPaymorrowKeyTest', 'VEVTVC1QTQ==' );

        $this->assertSame( 'TEST-PM', $this->SUT->getPaymorrowKey() );
    }


    public function test_getSetEndpointUrl_shouldReturnSetEndPointProductionUrl()
    {
        $sEndPointUrl = 'end_point_test_url3';

        modConfig::getInstance()->setConfigParam( 'paymorrowEndpointUrlProd', $sEndPointUrl );

        $this->assertEquals( $sEndPointUrl, $this->SUT->getProductionEndPointURL() );
    }


    public function testGetTestEndPointURL_returnSetTestEndpointUrlSettingValue()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowEndpointUrlTest', 'http://example.com/resource.asp?v=22' );

        $this->assertEquals( 'http://example.com/resource.asp?v=22', $this->SUT->getTestEndPointURL() );
    }


    public function testIsLoggingEnabled_loggingSettingDisabled_returnFalse()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowLoggingEnabled', 0 );

        $this->assertFalse( $this->SUT->isLoggingEnabled() );
    }

    public function testIsLoggingEnabled_loggingSettingEnabled_returnTrue()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowLoggingEnabled', true );

        $this->assertTrue( $this->SUT->isLoggingEnabled() );
    }


    public function test_ifIsSandboxMode_shouldReturnFalse()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', '0' );

        $this->assertFalse( $this->SUT->isSandboxMode() );
    }


    public function test_ifIsSanboxMode_shouldReturnTrue()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', '1' );

        $this->assertTrue( $this->SUT->isSandboxMode() );
    }


    public function test_getValidSettings_shouldReturnSameArray()
    {
        $aSettings = array(
            'SandboxMode',
            'MerchantId',
            'MerchantIdTest',
            'PrivateKey',
            'PrivateKeyTest',
            'PublicKey',
            'PublicKeyTest',
            'PaymorrowKey',
            'PaymorrowKeyTest',
            'EndpointUrlTest',
            'EndpointUrlProd',
            'LoggingEnabled',
            'ResourcePath',
            'ResourcePathTest',
            'OperationMode',
            'OperationModeTest',
            'UpdateAddresses',
            'UpdatePhones',
        );

        $this->assertSame( $aSettings, $this->SUT->getValidSettings() );
    }


    public function test_getEndPointURL_shouldReturnProductionUrlWhenSandboxModeIsOff()
    {
        $sSetting = 'this_is_production_url_the_end';

        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', '0' );
        modConfig::getInstance()->setConfigParam( 'paymorrowEndpointUrlProd', $sSetting );

        $this->assertEquals( $sSetting, $this->SUT->getEndPointURL() );
    }


    public function testGetPaymorrowResourcePath_liveModeIsOn_returnLiveResourcePath()
    {
        $sPath = 'test-path_kafjefaseahrd33';
        modConfig::getInstance()->setConfigParam( 'paymorrowResourcePath', $sPath );
        modConfig::getInstance()->setConfigParam( 'paymorrowResourcePathTest', $sPath . 'Test' );
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', '0' );

        $this->assertSame( $sPath, $this->SUT->getPaymorrowResourcePath() );
    }

    public function testGetPaymorrowResourcePath_testModeIsOn_returnTestResourcePath()
    {
        $sPath = 'test-path_kafjefaseahrd33';
        modConfig::getInstance()->setConfigParam( 'paymorrowResourcePath', $sPath );
        modConfig::getInstance()->setConfigParam( 'paymorrowResourcePathTest', $sPath . 'Test' );
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', '1' );

        $this->assertSame( $sPath . 'Test', $this->SUT->getPaymorrowResourcePath() );
    }

    public function testGetPaymorrowOperationMode_liveModeIsOn_returnLiveOperationMode()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowOperationMode', 'VALIDATE' );
        modConfig::getInstance()->setConfigParam( 'paymorrowOperationModeTest', 'RISK_CHECK' );
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', '0' );

        $this->assertSame( 'VALIDATE', $this->SUT->getPaymorrowOperationMode() );
    }

    public function testGetPaymorrowOperationMode_testModeIsOn_returnTestOperationMode()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowOperationMode', 'VALIDATE' );
        modConfig::getInstance()->setConfigParam( 'paymorrowOperationModeTest', 'RISK_CHECK' );
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', '1' );

        $this->assertSame( 'RISK_CHECK', $this->SUT->getPaymorrowOperationMode() );
    }


    public function test_getEndPointURL_shouldReturnTestUrlWhenSandboxModeIsOn()
    {
        $sSetting = 'this_is_test_environment_url_the_end';

        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', '1' );
        modConfig::getInstance()->setConfigParam( 'paymorrowEndpointUrlTest', $sSetting );

        $this->assertEquals( $sSetting, $this->SUT->getEndPointURL() );
    }


    public function testIsAddressesUpdateEnabled_falseLikeValueSet_returnFalse()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowUpdateAddresses', '' );

        $this->assertFalse( $this->SUT->isAddressesUpdateEnabled() );
    }

    public function testIsAddressesUpdateEnabled_trueLikeValueSet_returnTrue()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowUpdateAddresses', '1' );

        $this->assertTrue( $this->SUT->isAddressesUpdateEnabled() );
    }


    public function testIsPhonesUpdateEnabled_falseLikeValueSet_returnFalse()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowUpdatePhones', '0' );

        $this->assertFalse( $this->SUT->isPhonesUpdateEnabled() );
    }

    public function testIsPhonesUpdateEnabled_trueLikeValueSet_returnTrue()
    {
        modConfig::getInstance()->setConfigParam( 'paymorrowUpdatePhones', 'true' );

        $this->assertTrue( $this->SUT->isPhonesUpdateEnabled() );
    }


    public function test_getSetting_shouldReturnNullBecauseRequestedSettingIsNotValid()
    {
        $this->assertNull( $this->SUT->getSetting( 'requesting_invalid_settings' ) );
    }


    public function test_getMpiSignature_shouldReturnConstructedMpiSignature()
    {
        $sStartsWith = 'Oxid-' . $this->SUT->getConfig()->getVersion();

        $this->assertStringStartsWith( $sStartsWith, $this->SUT->getMpiSignature() );
    }


    public function test_getSettings_shouldReturnSetSettingsAsArray()
    {
        $sMerchantID        = 'Mock_setting_MerchantID';
        $sMerchantIDTest    = 'Mock_setting_MerchantIDTest';
        $sPrivateKey        = 'RSA KEY';
        $sPrivateKeyTest    = 'RSA KEY test';
        $sPublicKey         = 'CERTIFICATE';
        $sPublicKeyTest     = 'CERTIFICATE test';
        $sPaymorrowKey      = 'PM CERTIFICATE test';
        $sPaymorrowKeyTest  = 'PM CERTIFICATE test';
        $sEndPointUrlTest   = 'Mock_setting_EndPointUrl - Test';
        $sEndPointUrlProd   = 'Mock_setting_EndPointUrl - Production';
        $sSandboxMode       = '1';
        $sLoggingEnabled    = '1';
        $sResourcePath      = 'awfiawf';
        $sResourcePathTest  = 'test.awfiawf';
        $sOperationMode     = 'RISK_CHECK';
        $sOperationModeTest = 'RISK_PRECHECK';
        $blUpdateAddresses  = true;
        $blUpdatePhones     = false;

        modConfig::getInstance()->setConfigParam( 'paymorrowMerchantId', $sMerchantID );
        modConfig::getInstance()->setConfigParam( 'paymorrowMerchantIdTest', $sMerchantIDTest );
        modConfig::getInstance()->setConfigParam( 'paymorrowPrivateKey', $sPrivateKey );
        modConfig::getInstance()->setConfigParam( 'paymorrowPrivateKeyTest', $sPrivateKeyTest );
        modConfig::getInstance()->setConfigParam( 'paymorrowPublicKey', $sPublicKey );
        modConfig::getInstance()->setConfigParam( 'paymorrowPublicKeyTest', $sPublicKeyTest );
        modConfig::getInstance()->setConfigParam( 'paymorrowPaymorrowKey', $sPaymorrowKey );
        modConfig::getInstance()->setConfigParam( 'paymorrowPaymorrowKeyTest', $sPaymorrowKeyTest );
        modConfig::getInstance()->setConfigParam( 'paymorrowEndpointUrlTest', $sEndPointUrlTest );
        modConfig::getInstance()->setConfigParam( 'paymorrowEndpointUrlProd', $sEndPointUrlProd );
        modConfig::getInstance()->setConfigParam( 'paymorrowSandboxMode', $sSandboxMode );
        modConfig::getInstance()->setConfigParam( 'paymorrowLoggingEnabled', $sLoggingEnabled );
        modConfig::getInstance()->setConfigParam( 'paymorrowResourcePath', $sResourcePath );
        modConfig::getInstance()->setConfigParam( 'paymorrowResourcePathTest', $sResourcePathTest );
        modConfig::getInstance()->setConfigParam( 'paymorrowOperationMode', $sOperationMode );
        modConfig::getInstance()->setConfigParam( 'paymorrowOperationModeTest', $sOperationModeTest );
        modConfig::getInstance()->setConfigParam( 'paymorrowUpdateAddresses', $blUpdateAddresses );
        modConfig::getInstance()->setConfigParam( 'paymorrowUpdatePhones', $blUpdatePhones );

        $aArrayToCompare = array(
            'SandboxMode'       => $sSandboxMode,
            'MerchantId'        => $sMerchantID,
            'MerchantIdTest'    => $sMerchantIDTest,
            'PrivateKey'        => $sPrivateKey,
            'PrivateKeyTest'    => $sPrivateKeyTest,
            'PublicKey'         => $sPublicKey,
            'PublicKeyTest'     => $sPublicKeyTest,
            'PaymorrowKey'      => $sPaymorrowKey,
            'PaymorrowKeyTest'  => $sPaymorrowKeyTest,
            'EndpointUrlTest'   => $sEndPointUrlTest,
            'EndpointUrlProd'   => $sEndPointUrlProd,
            'LoggingEnabled'    => $sLoggingEnabled,
            'ResourcePath'      => $sResourcePath,
            'ResourcePathTest'  => $sResourcePathTest,
            'OperationMode'     => $sOperationMode,
            'OperationModeTest' => $sOperationModeTest,
            'UpdateAddresses'   => $blUpdateAddresses,
            'UpdatePhones'      => $blUpdatePhones,
        );

        $this->assertSame( $aArrayToCompare, $this->SUT->getSettings() );
    }
}
