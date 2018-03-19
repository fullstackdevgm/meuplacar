<?php
/**
 * Copyright (c) 2016 Planeta del Este .
 *
 * ModalController.php is part of PlanetaDelEste.Widgets.
 *
 *     PlanetaDelEste.Widgets is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     PlanetaDelEste.Widgets is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with PlanetaDelEste.Widgets.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace PlanetaDelEste\Widgets\Behaviors;

    use Backend\Classes\ControllerBehavior;

    class ModalController extends ControllerBehavior
    {

        /**
         * Behavior ModalController constructor.
         *
         * @param \Backend\Classes\Controller $controller
         */
        public function __construct($controller)
        {
            parent::__construct($controller);

            if(method_exists($this->controller, 'overrideAddAssets')){
                $this->controller->overrideAddAssets();
            } else {
                $this->addAssets();
            }
        }

        /**
         * Add js modal asset
         */
        public function addAssets()
        {
            $this->addJs('js/modal.js');
        }

        /**
         * Make the modal form for create record
         *
         * @return mixed
         * @throws \SystemException
         */
        public function index_onCreateForm()
        {
            $this->controller->asExtension('FormController')->create();
            $this->vars['title'] = trans($this->getTransString('create_title'));

            if(method_exists($this->controller, 'overrideOnCreateFormPartial')){
                return $this->controller->overrideOnCreateFormPartial();
            }

            return $this->makePartial('create_form');
        }


        /**
         * After create record, refresh the index list
         *
         * @return mixed
         */
        public function index_onCreate()
        {
            $this->controller->asExtension('FormController')->create_onSave();

            return $this->controller->listRefresh();
        }

        /**
         * Make the modal form for update record
         *
         * @return mixed
         * @throws \SystemException
         */
        public function index_onUpdateForm()
        {
            $this->controller->asExtension('FormController')->update(post('record_id'));
            $this->vars['recordId'] = post('record_id');
            $this->vars['title'] = trans($this->getTransString('update_title'));

            if(method_exists($this->controller, 'overrideOnUpdateFormPartial')){
                return $this->controller->overrideOnUpdateFormPartial();
            }

            return $this->makePartial('update_form');
        }

        /**
         * After update record, refresh the index list
         *
         * @return mixed
         */
        public function index_onUpdate()
        {
            $this->controller->asExtension('FormController')->update_onSave(post('record_id'));

            return $this->controller->listRefresh();
        }

        /**
         * @param null|string $trans
         * @return string
         */
        protected function getTransString( $trans = null ) {
            if(method_exists($this->controller, 'overrideGetTransString')){
                return $this->controller->overrideGetTransString($trans);
            }

            list($author, $plugin, $page, $controller) = explode('\\', get_class($this->controller) );
            $string = strtolower(join('.', [$author, $plugin]) . '::lang.' . strtolower( str_singular($controller) ));

            if(is_string($trans)) {
                $string .= '.' . trim(strtolower($trans));
            }

            return $string;
        }
    }