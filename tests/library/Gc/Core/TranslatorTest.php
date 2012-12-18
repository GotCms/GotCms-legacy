<?php
namespace Gc\Core;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:11.
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Gc
 */
class TranslatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Translator
     */
    protected $_object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->_object = new Translator;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->_object);
    }

    /**
     * @covers Gc\Core\Translator::getInstance
     */
    public function testGetInstance()
    {
        $this->assertInstanceOf('Gc\Core\Translator', Translator::getInstance());
    }

    /**
     * @covers Gc\Core\Translator::getValue
     */
    public function testGetValue()
    {
        $this->_object->setValue('key', array(
            array(
                'locale' => 'fr_FR',
                'value' => 'clé',
            )
        ));
        $this->assertInstanceOf('ArrayObject', $this->_object->getValue('key', 'fr_FR'));
    }

    /**
     * @covers Gc\Core\Translator::getValues
     */
    public function testGetValues()
    {
        $data = $this->_object->getValues('fr_FR');
        $this->assertArrayHasKey(0, $data);
    }

    /**
     * @covers Gc\Core\Translator::getValues
     */
    public function testGetValuesWithLimit()
    {
        $data = $this->_object->getValues('fr_FR', 1);
        $this->assertArrayHasKey(0, $data);
    }

    /**
     * @covers Gc\Core\Translator::setValue
     */
    public function testSetValue()
    {
        $result = $this->_object->setValue('parameters', array(
            array(
                'locale' => 'fr_FR',
                'value' => 'paramètres',
            ), array(
                'locale' => '', //Missing locale
                'value' => 'parametri',
            )
        ));
        $this->assertTrue($result);
    }

    /**
     * @covers Gc\Core\Translator::setValue
     */
    public function testSetValueWithDestinationId()
    {
        $this->_object->setValue('parameters', array(
            array(
                'd' => 'fr_FR',
                'locale' => 'fr_FR',
                'value' => 'paramètres',
            )
        ));
        $data = $this->_object->getValue('parameters', 'fr_FR');
        $result = $this->_object->setValue('parameters', array(
            array(
                'dst_id' => $data->dst_id,
                'locale' => 'it_IT',
                'value' => 'parametri',
            )
        ));

        $this->assertTrue($result);
    }

    /**
     * @covers Gc\Core\Translator::setValue
     */
    public function testSetValueWithSourceId()
    {
        $this->_object->setValue('parameters', array(
            array(
                'locale' => 'fr_FR',
                'value' => 'paramètres',
            )
        ));
        $data = $this->_object->getValue('parameters', 'fr_FR');
        $result = $this->_object->setValue($data->src_id, array(
            array(
                'locale' => 'it_IT',
                'value' => 'parametri',
            )
        ));

        $this->assertTrue($result);
    }

    /**
     * @covers Gc\Core\Translator::setValue
     */
    public function testSetValueWithUndefinedSourceId()
    {
        $this->assertFalse($this->_object->setValue(40000000, array()));
    }
}
