<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Flash');
        $this->loadComponent('Recaptcha.Recaptcha', [
            'enable' => true,     // true/false
            'sitekey' => '6LfBH_0qAAAAADnTvjG-2PhxzPyJKpBd0S8RJ1wI',
            'secret' => '6LfBH_0qAAAAAKQzA7ZGxuhEdfjLEihMbOxSOaSW',
            'type' => 'image',  // image/audio
            'theme' => 'light', // light/dark
            'lang' => 'en', // default 'en'
            'size' => 'normal',  // normal/compact
            'callback' => null, // `callback` data attribute for the recaptcha div, default `null`
            'scriptBlock' => true // Value for `block` option for HtmlHelper::script() call
        ]);

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        $this->loadComponent('FormProtection');
    }

    /**
     * @param \Cake\Event\EventInterface $event
     * @return \Cake\Http\Response|null|void
     */
    public function beforeFilter(EventInterface $event)
    {
        if (!$this->Authentication->getIdentity()) {
            $contactMessagesTable = $this->fetchTable('ContactMessages');
            // Create and pass an empty entity
            $this->set('contactMessage', $contactMessagesTable->newEmptyEntity());
        }

        return parent::beforeFilter($event);
    }
}
