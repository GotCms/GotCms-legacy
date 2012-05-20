<?php
/**
 * This source file is part of Got CMS.
 *
 * Got CMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Got CMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with Got CMS. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category Form
 * @package  Config
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Config\Form;

use Gc\Form\AbstractForm,
    Gc\User\Role\Collection as RoleCollection,
    Zend\Validator\Db,
    Zend\Validator,
    Zend\Form\Element,
    Zend\InputFilter\Factory as InputFilterFactory;

class User extends AbstractForm
{
    /**
     * Initialize User form
     * @return void
     */
    public function init()
    {
        $inputFilterFactory = new InputFilterFactory();
        $inputFilter = $inputFilterFactory->createInputFilter(array(
            'email' => array(
                'required'=> TRUE
                , 'validators' => array(
                    array('name' => 'not_empty')
                    , array('name' => 'email_address')
                )
            )
            , 'login' => array(
                'required'=> TRUE
                , 'validators' => array(
                    array('name' => 'not_empty')
                    , array(
                        'name' => 'db\\no_record_exists'
                        , 'options' => array(
                            'table' => 'user'
                            , 'field' => 'login'
                            , 'adapter' => $this->getAdapter()
                        )
                    )
                )
            )
            , 'lastname' => array(
                'required'=> TRUE
                , 'validators' => array(
                    array('name' => 'not_empty')
                )
            )
            , 'firstname' => array(
                'required'=> TRUE
                , 'validators' => array(
                    array('name' => 'not_empty')
                )
            )
            , 'user_acl_role_id' => array(
                'required'=> TRUE
                , 'validators' => array(
                    array('name' => 'not_empty')
                )
            )
            , 'password' => array()
            , 'password_confirm' => array()
        ));

        $this->setInputFilter($inputFilter);

        $role = new Element('user_acl_role_id');
        $role_collection = new RoleCollection();
        $roles_list = $role_collection->getRoles();
        $select_options = array();
        foreach($roles_list as $role_model)
        {
            $select_options[$role_model->getId()] = $role_model->getName();
        }

        $role->setAttribute('options', $select_options);

        $this->add(new Element('email'));
        $this->add(new Element('login'));
        $this->add(new Element('password'));
        $this->add(new Element('password_confirm'));
        $this->add(new Element('lastname'));
        $this->add(new Element('firstname'));
        $this->add($role);
    }

    /**
     * Set if yes or no password is required when user click on Save
     *
     * @return \Config\Form\User
     */
    public function passwordRequired()
    {
        $this->getInputfilter()->get('password')->setRequired(TRUE)->getValidatorChain()->addValidator(new Validator\NotEmpty());
        $this->getInputfilter()->get('password_confirm')->setRequired(TRUE)->getValidatorChain()->addValidator(new Validator\NotEmpty());

        return $this;
    }
}