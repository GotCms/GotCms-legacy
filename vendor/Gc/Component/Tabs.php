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
 * @category    Gc
 * @package     Library
 * @subpackage  Component
 * @author      Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license     GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link        http://www.got-cms.com
 */

namespace Gc\Component;

class Tabs
{
    private $_data;

    /**
     * @param array $array
     */
    public function __construct(Array $array)
    {
        $this->_data = $array;
    }

    /**
     * @param array $tabs contains objects
     * @return string
     */
    public function render(Array $tabs = NULL)
    {
        $i = 0;
        $html = '<ul>';
        if($tabs === NULL)
        {
            $tabs = $this->_data;
        }

        $i = 1;
        foreach($tabs as $iterator)
        {
            if(!$iterator instanceof \Gc\Component\IterableInterface)
            {
                $html .= '<li><a href="#tabs-'.$i.'">'.$iterator.'</a></li>';
            }
            else
            {
                $html .= '<li><a href="#tabs-'.$iterator->getId().'">'.$iterator->getName().'</a></li>';
            }

            $i++;
        }

        $html .= '</ul>';

        return $html;
    }

    /**
     * @return string|FALSE
     */
    public function __toString()
    {
        if(empty($this->_data))
        {
            return FALSE;
        }

        return $this->render();
    }
}