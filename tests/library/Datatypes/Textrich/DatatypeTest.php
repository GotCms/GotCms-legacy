<?php
namespace Datatypes\Textrich;

use Gc\Datatype\Model as DatatypeModel,
    Gc\DocumentType\Model as DocumentTypeModel,
    Gc\Layout\Model as LayoutModel,
    Gc\Property\Model as PropertyModel,
    Gc\User\Model as UserModel,
    Gc\Tab\Model as TabModel,
    Gc\View\Model as ViewModel;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:42:12.
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Datatypes
 */
class DatatypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Datatype
     */
    protected $_object;

    /**
     * @var DatatypeModel
     */
    protected $_datatype;

    /**
     * @var PropertyModel
     */
    protected $_property;

    /**
     * @var ViewModel
     */
    protected $_view;

    /**
     * @var LayoutModel
     */
    protected $_layout;

    /**
     * @var TabModel
     */
    protected $_tab;

    /**
     * @var UserModel
     */
    protected $_user;

    /**
     * @var DocumentTypeModel
     */
     protected $_documentType;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->_view = new ViewModel();
        $this->_view->setData(array(
            'name' => 'View Name',
            'identifier' => 'View identifier',
            'description' => 'View Description',
            'content' => 'View Content'
        ));
        $this->_view->save();

        $this->_layout = new LayoutModel();
        $this->_layout->setData(array(
            'name' => 'Layout Name',
            'identifier' => 'Layout identifier',
            'description' => 'Layout Description',
            'content' => 'Layout Content'
        ));
        $this->_layout->save();

        $this->_user = new UserModel();
        $this->_user->setData(array(
            'lastname' => 'User test',
            'firstname' => 'User test',
            'email' => 'test@test.com',
            'login' => 'test',
            'user_acl_role_id' => 1,
        ));
        $this->_user->setPassword('test');
        $this->_user->save();

        $this->_documentType = new DocumentTypeModel();
        $this->_documentType->setData(array(
            'name' => 'Document Type Name',
            'description' => 'Document Type description',
            'icon_id' => 1,
            'default_view_id' => $this->_view->getId(),
            'user_id' => $this->_user->getId(),
        ));
        $this->_documentType->save();

        $this->_datatype = DatatypeModel::fromArray(array(
            'name' => 'TextrichTest',
            'prevalue_value' => '',
            'model' => 'Textrich',
        ));
        $this->_datatype->save();

        $this->_tab = TabModel::fromArray(array(
            'name' => 'TabTest',
            'description' => 'TabTest',
            'sort_order' => 1,
            'document_type_id' => $this->_documentType->getId(),
        ));
        $this->_tab->save();

        $this->_property = PropertyModel::fromArray(array(
            'name' => 'DatatypeTest',
            'identifier' => 'DatatypeTest',
            'description' => 'DatatypeTest',
            'required' => FALSE,
            'sort_order' => 1,
            'tab_id' => $this->_tab->getId(),
            'datatype_id' => $this->_datatype->getId(),
        ));
        $this->_property->save();
        $this->_object = new Datatype($this->_datatype);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->_datatype->delete();
        $this->_documentType->delete();
        $this->_layout->delete();
        $this->_property->delete();
        $this->_tab->delete();
        $this->_user->delete();
        $this->_view->delete();

        unset($this->_datatype);
        unset($this->_documentType);
        unset($this->_layout);
        unset($this->_property);
        unset($this->_tab);
        unset($this->_user);
        unset($this->_view);
        unset($this->_object);
    }

    /**
     * @covers Datatypes\Textrich\Datatype::getEditor
     */
    public function testGetEditor()
    {
        $this->assertInstanceOf('Datatypes\Textrich\Editor', $this->_object->getEditor($this->_property));
    }

    /**
     * @covers Datatypes\Textrich\Datatype::getPrevalueEditor
     */
    public function testGetPrevalueEditor()
    {
        $this->assertInstanceOf('Datatypes\Textrich\PrevalueEditor', $this->_object->getPrevalueEditor());
    }
}
