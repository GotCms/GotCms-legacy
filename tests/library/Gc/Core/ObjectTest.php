<?php
namespace Gc\Core;

use Gc\Registry,
    ReflectionClass;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:10.
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Gc
 */
class ObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Object
     */
    protected $_object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     * @covers Gc\Core\Object::__construct
     */
    protected function setUp()
    {
        $this->_object = $this->getMockForAbstractClass('Gc\Core\Object');
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
     * @covers Gc\Core\Object::init
     */
    public function testInit()
    {
        $this->assertNull($this->_object->init());
    }


    /**
     * @covers Gc\Core\Object::setId
     */
    public function testSetId()
    {
        $configuration = Registry::get('Configuration');
        $class = $this->_getMethod('setId');
        $class->invokeArgs($this->_object, array('id' => 1));
        $this->assertEquals(1, $this->_object->getId());
    }

    /**
     * @covers Gc\Core\Object::addData
     */
    public function testAddData()
    {
        $this->_object->addData(array('k' => 'v'));
        $this->assertEquals('v', $this->_object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::setData
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::_underscore
     */
    public function testSetData()
    {
        $this->_object->setK('v');
        $this->assertEquals('v', $this->_object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::setData
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::_underscore
     */
    public function testSetAllData()
    {
        $this->_object->setData(array('k' => 'v', 'k2' => 'v2'));
        $this->assertEquals('v', $this->_object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::unsetData
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::_underscore
     */
    public function testUnsetData()
    {
        $this->_object->setData('k', 'v');
        $this->_object->unsK();
        $this->assertNull($this->_object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::unsetData
     */
    public function testUnsetAllData()
    {
        $this->_object->setData('k', 'v');
        $this->_object->unsetData();
        $this->assertNull($this->_object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::getData
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::_underscore
     */
    public function testGetData()
    {
        $this->_object->setData('k', 'v');
        $this->assertEquals('v', $this->_object->getK());
    }

    /**
     * @covers Gc\Core\Object::__call
     */
    public function testFakeMethod()
    {
        $this->setExpectedException('Gc\Exception');
        $this->_object->fakeMethodToLaunchException();
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetDataWithIndex()
    {
        $this->_object->setData('a', array('b', 'c'));
        $this->assertEquals('b', $this->_object->getData('a', 0));
        $this->assertNull($this->_object->getData('a', 3));
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetDataWithFakeIndex()
    {
        $this->_object->setData('a', array('b', 'c'));
        $this->assertNull($this->_object->getData('a', 3));
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetDataWithIndexAndStringValue()
    {
        $this->_object->setData('a', 'b');
        $this->assertEquals('b', $this->_object->getData('a', 0));
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetDataWithIndexAndObjectValue()
    {
        $new_object = $this->getMockForAbstractClass('Gc\Core\Object');
        $new_object->setData('b', 'c');
        $this->_object->setData('a', $new_object);
        $this->assertEquals('c', $this->_object->getData('a', 'b'));
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetDataWithIndexAndDifferentObjectValue()
    {
        $new_object = new \stdClass();
        $new_object->b = 'c';
        $this->_object->setData('a', $new_object);
        $this->assertNull($this->_object->getData('a', 'b'));
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetDataWithUndefinedKeyAndIndex()
    {
        $this->assertNull($this->_object->getData('a', 'b'));
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetAllData()
    {
        $this->_object->setData('k', 'v');
        $this->assertEquals(array('k' => 'v'), $this->_object->getData());
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetArrayData()
    {
        $this->_object->setData(array('a' => array('b' => '1', 'c' => '2')));
        $this->assertEquals('1', $this->_object->getData('a/b'));
        $this->assertNull($this->_object->getData('b/c'));
        $this->assertNull($this->_object->getData('a/b/'));
    }

    /**
     * @covers Gc\Core\Object::hasData
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::_underscore
     */
    public function testHasData()
    {
        $this->_object->setData('k', 'v');
        $this->assertTrue($this->_object->hasData('k'));
        $this->assertTrue($this->_object->hasK());
    }

    /**
     * @covers Gc\Core\Object::hasData
     */
    public function testHasFakeData()
    {
        $this->assertFalse($this->_object->hasData(''));
    }

    /**
     * @covers Gc\Core\Object::toArray
     * @covers Gc\Core\Object::__toArray
     */
    public function test__toArray()
    {
        $this->_object->setData('k', 'v');
        $this->assertArrayHasKey('k', $this->_object->toArray());
    }

    /**
     * @covers Gc\Core\Object::toArray
     * @covers Gc\Core\Object::__toArray
     */
    public function test__toArrayWithParameters()
    {
        $this->_object->setData('k', 'v');
        $this->assertArrayHasKey('k2', $this->_object->toArray(array('k', 'k2')));
    }

    /**
     * @covers Gc\Core\Object::toXml
     */
    public function testToXml()
    {
        $this->_object->setData(array('k' => 'v'));
        $xml = '<?xml version="1.0" encoding="UTF-8"?><items><k><![CDATA[v]]></k></items>';
        $this->assertXmlStringEqualsXmlString($xml, $this->_object->toXml(array(), 'items', TRUE, TRUE));
    }

    /**
     * @covers Gc\Core\Object::toXml
     * @covers Gc\Core\Object::__toXml
     */
    public function testToXmlWithoutParameters()
    {
        $this->_object->setData(array('k' => 'v'));
        $this->_object->toXml(array(), 'items', TRUE, TRUE);
        $this->_object->toXml(array(), 'items', FALSE, FALSE);
        $xml = '<item><k><![CDATA[v]]></k></item>';
        $this->assertXmlStringEqualsXmlString($xml, $this->_object->toXml());
    }

    /**
     * @covers Gc\Core\Object::toJson
     * @covers Gc\Core\Object::__toJson
     */
    public function testToJson()
    {
        $this->_object->setData(array('k' => 'v'));
        $this->assertEquals(json_encode(array('k' => 'v')), $this->_object->toJson());
    }

    /**
     * @covers Gc\Core\Object::toString
     */
    public function testToString()
    {
        $this->_object->setData(array('k' => 'v'));
        $this->assertEquals('v', $this->_object->toString());
    }

    /**
     * @covers Gc\Core\Object::toString
     */
    public function testToStringWithFormat()
    {
        $this->_object->setData(array('a' => 'b', 'c' => 'd'));
        $this->assertEquals('b d', $this->_object->toString('{{a}} {{c}}'));
    }

    /**
     * @covers Gc\Core\Object::offsetSet
     */
    public function testOffsetSet()
    {
        $this->_object->offsetSet('k', 'v');
        $this->assertEquals('v', $this->_object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::offsetExists
     */
    public function testOffsetExists()
    {
        $this->_object->setData('k', 'v');
        $this->assertTrue($this->_object->OffsetExists('k'));
    }

    /**
     * @covers Gc\Core\Object::offsetUnset
     */
    public function testOffsetUnset()
    {
        $this->_object->setData('k', 'v');
        $this->_object->offsetUnset('k');
        $this->assertNull($this->_object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::offsetGet
     */
    public function testOffsetGet()
    {
        $this->_object->setData('k', 'v');
        $this->assertEquals('v', $this->_object->offsetGet('k'));
    }

    protected function _getMethod($name)
    {
        $class = new ReflectionClass('Gc\Core\Object');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}
