<?php
/**
 * ProfileController
 * @package api-profile
 * @version 0.0.1
 */

namespace ApiProfile\Controller;

use LibFormatter\Library\Formatter;

use Profile\Model\Profile;

class ProfileController extends \Api\Controller
{
    public function indexAction(){
        if(!$this->app->isAuthorized())
            return $this->resp(401);

        list($page, $rpp) = $this->req->getPager();

        $cond = $this->req->getCond(['q']);

        $profiles = Profile::get($cond, $rpp, $page, ['id'=>false]) ?? [];
        if($profiles)
            $profiles = Formatter::formatMany('profile', $profiles);

        $this->resp(0, $profiles, null, [
            'meta' => [
                'total' => Profile::count($cond),
                'page'  => $page,
                'rpp'   => $rpp
            ]
        ]);
    }

    public function singleAction(){
        if(!$this->app->isAuthorized())
            return $this->resp(401);

        $identity = $this->req->param->identity;

        $profile = Profile::getOne(['id'=>$identity]);
        if(!$profile)
            $profile = Profile::getOne(['name'=>$identity]);

        if(!$profile)
            return $this->resp(404);

        $profile = Formatter::format('profile', $profile);

        $this->resp(0, $profile);
    }
}