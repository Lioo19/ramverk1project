<?php

namespace Lioo19\Me;

use Lioo19\Me\MeMock;

/**
 * Class for mocking GeoController
 * Class only contain methods for checking
 *
 */

class MeControllerMock extends MeController
{

    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize(): void
    {

        $info = new MeMock();

        $this->data = $info->getUserInfo("linn");
    }

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexAction(): object
    {
        $page = $this->di->get("page");

        if (!$this->data["username"]) {
            $page->add("me/noaccess");
            return $page->render([
                "title" => "No Access",
            ]);
        }

        $page->add("me/me", [
            "content" => $this->data,
        ]);

        return $page->render([
            "title" => $this->data["username"],
        ]);
    }
}
